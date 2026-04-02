<?php
/*
 * This is the child theme for Astra theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_styles' );
function astra_child_enqueue_styles() {
    $theme_version = wp_get_theme()->get( 'Version' );

    // Parent & Child CSS
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style'),
        $theme_version
    );

    wp_enqueue_script(
        'astra-child-animations',
        get_stylesheet_directory_uri() . '/assets/js/elementor-animations.js',
        array(),
        $theme_version,
        true
    );
}

// ✅ 1. Custom Post Type (Inquiries)
function mrx_create_post_type() {
    register_post_type('mrx_inquiry',
        array(
            'labels' => array(
                'name' => 'Inquiries',
                'singular_name' => 'Inquiry'
            ),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-email',
            'supports' => array('title'),
        )
    );
}
add_action('init', 'mrx_create_post_type');


// ✅ 2. Shortcode + Form + Insert Data
function mrx_custom_form() {
    ob_start();
?>

<div id="mrx-form-container">
    <form id="mrx-form" class="mrx-form">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="tel" name="phone" placeholder="Your Phone" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <input type="hidden" name="mrx_nonce" value="<?php echo wp_create_nonce('mrx_form_action'); ?>">
        <button type="submit" name="mrx_submit" value="Send Inquiry">Send Inquiry</button>
    </form>
    <div id="mrx-response"></div>
</div>

<script>
document.getElementById('mrx-form').addEventListener('submit', function(e) {
    e.preventDefault();

    var form = this;
    var submitBtn = form.querySelector('button[type="submit"]');
    var responseDiv = document.getElementById('mrx-response');

    // Stop multiple submits until server response is shown
    if (submitBtn.disabled) {
        return;
    }

    submitBtn.disabled = true;
    submitBtn.dataset.originalText = submitBtn.textContent;
    submitBtn.textContent = 'Sending...';
    responseDiv.innerHTML = '';

    var formData = new FormData(form);
    formData.append('action', 'mrx_handle_form');
    
    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if(!response.ok) throw new Error('Network error');
        return response.text(); // Get text first to debug
    })
    .then(text => {
        try {
            return JSON.parse(text);
        } catch(e) {
            console.error('Invalid JSON response:', text);
            throw new Error('Invalid response format');
        }
    })
    .then(data => {
        if(data.success) {
            responseDiv.innerHTML = '<p class="mrx-success">✅ ' + data.data + '</p>';
            form.reset();
        } else {
            responseDiv.innerHTML = '<p class="mrx-error">❌ ' + data.data + '</p>';
        }
    })
    .catch(error => {
        console.error('Form error:', error);
        responseDiv.innerHTML = '<p class="mrx-error">❌ Error submitting form: ' + error.message + '</p>';
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = submitBtn.dataset.originalText || 'Send Inquiry';
    });
});
</script>

<style>
.mrx-form {
  max-width: 500px;
  margin: auto;
}

.mrx-form input,
.mrx-form textarea {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  background: #151528;
  border: 1px solid #2a2a40;
  color: #fff;
  border-radius: 8px;
  outline: none;
  box-sizing: border-box;
  font-family: inherit;
}

.mrx-form input:focus,
.mrx-form textarea:focus {
  border-color: #a855f7;
  box-shadow: 0 0 10px #a855f7;
}

.mrx-form button {
  width: 100%;
  padding: 12px;
  background: #a855f7;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  box-shadow: 0 0 10px #a855f7;
  transition: 0.3s;
  font-size: 16px;
}

.mrx-form button:hover {
  background: #9333ea;
  box-shadow: 0 0 20px #a855f7;
}

.mrx-success {
  color: #4ade80;
  text-align: center;
  margin-bottom: 15px;
  padding: 12px;
  background: rgba(74, 222, 128, 0.1);
  border-radius: 8px;
}

.mrx-error {
  color: #f87171;
  text-align: center;
  margin-bottom: 15px;
  padding: 12px;
  background: rgba(248, 113, 113, 0.1);
  border-radius: 8px;
}
</style>

<?php
    return ob_get_clean();
}
add_shortcode('mrx_form', 'mrx_custom_form');


// ✅ 2B. AJAX Handler for Form Submission
function mrx_handle_form_submission() {
    // Verify nonce
    if(!isset($_POST['mrx_nonce']) || !wp_verify_nonce($_POST['mrx_nonce'], 'mrx_form_action')) {
        wp_send_json_error('Security check failed');
        die();
    }
    
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    
    if(empty($name) || empty($phone) || empty($message)) {
        wp_send_json_error('Please fill all fields');
        die();
    }
    
    // Insert Post
    $post_id = wp_insert_post(array(
        'post_title' => $name,
        'post_type' => 'mrx_inquiry',
        'post_status' => 'publish'
    ));
    
    if($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, 'phone', $phone);
        update_post_meta($post_id, 'message', $message);
        update_post_meta($post_id, 'date', current_time('mysql'));

        // Send admin notification email with inquiry details.
        $admin_email = get_option('admin_email');
        $subject = 'New Inquiry Received';
        $body = "A new inquiry has been submitted.\n\n";
        $body .= "Name: " . $name . "\n";
        $body .= "Phone: " . $phone . "\n";
        $body .= "Message: " . $message . "\n";
        $body .= "Date: " . current_time('mysql') . "\n";
        $body .= "Inquiry ID: " . $post_id . "\n";

        wp_mail($admin_email, $subject, $body);
        
        wp_send_json_success('Message Sent Successfully!');
    } else {
        wp_send_json_error('Error saving your message. Please try again.');
    }
    die();
}
add_action('wp_ajax_mrx_handle_form', 'mrx_handle_form_submission');
add_action('wp_ajax_nopriv_mrx_handle_form', 'mrx_handle_form_submission');


// ✅ 3. Meta Box (Admin View)
function mrx_add_meta_box() {
    add_meta_box(
        'mrx_details',
        'User Details',
        'mrx_meta_callback',
        'mrx_inquiry'
    );
}
add_action('add_meta_boxes', 'mrx_add_meta_box');

function mrx_meta_callback($post) {
    $phone = get_post_meta($post->ID, 'phone', true);
    $message = get_post_meta($post->ID, 'message', true);
    $date = get_post_meta($post->ID, 'date', true);

    echo '<p><strong>Phone:</strong> ' . esc_html($phone) . '</p>';
    echo '<p><strong>Message:</strong><br>' . esc_html($message) . '</p>';
    echo '<p><strong>Date:</strong> ' . esc_html($date) . '</p>';
}
