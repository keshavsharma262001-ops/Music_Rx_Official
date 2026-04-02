<?php
/**
 * Dastrong functions.
 *
 *
 * @package WordPress
 * @subpackage Dastrong
 * @since Dastrong 1.0
 */

/** Theme Page */
function dastrong_add_theme_page() {
    add_theme_page(
        __( 'Dastrong Theme Guide', 'dastrong' ),       
        __( 'Dastrong Theme Guide', 'dastrong' ),       
        'edit_theme_options',            
        'dastrong-theme-page',               
        'dastrong_render_theme_page'         
    );
}
add_action( 'admin_menu', 'dastrong_add_theme_page' );

function dastrong_render_theme_page() {
    ?>
    <div class="wrap">
        <style>
            .theme-container {
                max-width: 900px;
                margin: 20px 0;
            }
            .theme-welcome-header {
                background: linear-gradient(
                    45deg,
                    #e66465,
                    #d8546c,
                    #c74672,
                    #b33b78,
                    #9c347c,
                    #b33b78,
                    #c74672,
                    #d8546c,
                    #e66465
                );
                background-size: 400% 400%;
                animation: gradient-flow 8s ease infinite;
                padding: 20px 30px;
                border-radius: 6px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);
                color: white;
                margin-bottom: 25px;
            }
            @keyframes gradient-flow {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .theme-welcome-header h1 {
                margin-top: 0;
                font-size: 2em;
                color: white;
            }
            .theme-welcome-header p {
                font-size: 16px;
                margin-bottom: 5px;
                opacity: 0.9;
            }
            .theme-content-section {
                background: white;
                padding: 25px 30px;
                border-radius: 6px;
                margin-bottom: 20px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            }
            .theme-content-section h2 {
                margin-top: 0;
                padding-bottom: 10px;
                border-bottom: 1px solid #f0f0f0;
                font-size: 1.5em;
            }
            .theme-section-title {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .theme-section-title span {
                font-size: 22px;
            }
            .theme-steps {
                margin-left: 15px;
            }
            .theme-steps li {
                margin-bottom: 12px;
                font-size: 15px;
            }
            .theme-pro-section {
                background: #f9f9f9;
                padding: 20px;
                border-radius: 6px;
                border-left: 4px solid #c74672;
                margin-top: 25px;
            }
            .theme-pro-section h3 {
                margin-top: 0;
                font-size: 1.2em;
            }
            .theme-buttons {
                margin-top: 25px;
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }
            .theme-button {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 18px;
                font-size: 14px;
                border-radius: 4px;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.2s ease;
            }
            .theme-button-primary {
                background: #c74672;
                color: white;
                border: none;
            }
            .theme-button-primary:hover {
                background: #b33b78;
                color: white;
            }
            .theme-button-secondary {
                background: white;
                color: #333;
                border: 1px solid #ddd;
            }
            .theme-button-secondary:hover {
                background: #f7f7f7;
                color: #333;
                border-color: #ccc;
            }
            .theme-features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 15px;
                margin-top: 20px;
            }
            .theme-feature-item {
                background: #f9f9f9;
                padding: 15px;
                border-radius: 4px;
                font-size: 14px;
                text-align: center;
            }
            .theme-feature-item span {
                display: block;
                font-size: 24px;
                margin-bottom: 8px;
            }
        </style>
        
        <div class="theme-container">
            <div class="theme-welcome-header">
                <h1><?php esc_html_e( 'Welcome to Dastrong Theme', 'dastrong' ); ?></h1>
                <p><?php esc_html_e( 'Thank you for choosing Dastrong! This guide will help you get started with our theme.', 'dastrong' ); ?></p>
            </div>
            
            <div class="theme-content-section">
                <div class="theme-section-title">
                    <h2><span><?php esc_html_e( '📚', 'dastrong' ); ?></span><?php esc_html_e( 'How to Use the Templates', 'dastrong' ); ?></h2>
                </div>
                <p><?php esc_html_e( 'To use the available page templates, follow these steps:', 'dastrong' ); ?></p>
                
                <ol class="theme-steps">
                    <li><?php esc_html_e( 'Go to', 'dastrong' ); ?> <strong><?php esc_html_e( 'Pages > Add New', 'dastrong' ); ?></strong> <?php esc_html_e( 'and create a new page. For example, name it "About".', 'dastrong' ); ?></li>
                    <li><?php esc_html_e( 'Click', 'dastrong' ); ?> <strong><?php esc_html_e( 'Publish', 'dastrong' ); ?></strong> <?php esc_html_e( 'to save the page.', 'dastrong' ); ?></li>
                    <li><?php esc_html_e( 'Next, go to', 'dastrong' ); ?> <strong><?php esc_html_e( 'Pages > All Pages', 'dastrong' ); ?></strong><?php esc_html_e( ', find your new page, and click', 'dastrong' ); ?> <strong><?php esc_html_e( 'Quick Edit', 'dastrong' ); ?></strong>.</li>
                    <li><?php esc_html_e( 'In the', 'dastrong' ); ?> <strong><?php esc_html_e( 'Template', 'dastrong' ); ?></strong> <?php esc_html_e( 'dropdown, select the template that matches your page — for example,', 'dastrong' ); ?> <strong><?php esc_html_e( 'About Template', 'dastrong' ); ?></strong>.</li>
                    <li><?php esc_html_e( 'Click', 'dastrong' ); ?> <strong><?php esc_html_e( 'Update', 'dastrong' ); ?></strong> <?php esc_html_e( 'to apply the template.', 'dastrong' ); ?></li>
                </ol>
                
                <div class="theme-pro-section">
                    <h3><?php esc_html_e( '🔓 Unlock All Templates', 'dastrong' ); ?></h3>
                    <p><?php esc_html_e( 'To access all exclusive templates and advanced layout options, consider upgrading to the', 'dastrong' ); ?> <strong><?php esc_html_e( 'PRO version', 'dastrong' ); ?></strong> <?php esc_html_e( 'of the Dastrong theme.', 'dastrong' ); ?></p>
                    <p><?php esc_html_e( '✨ Want to explore more premium designs? Visit our full collection at Supremacy Themes.', 'dastrong' ); ?></p>
                    
                    <div class="theme-buttons">
                        <a href="https://supremacythemes.com/demo/?url=https://supremacythemes.com/demos/dastrong/" class="theme-button theme-button-secondary" target="_blank">
                            <span class="dashicons dashicons-visibility"></span>
                            <?php esc_html_e( 'Preview PRO Version', 'dastrong' ); ?>
                        </a>
                        <a href="https://supremacythemes.com/design/dastrong/" class="theme-button theme-button-primary" target="_blank">
                            <span class="dashicons dashicons-star-filled"></span>
                            <?php esc_html_e( 'Upgrade to PRO', 'dastrong' ); ?>
                        </a>
                        <a href="https://supremacythemes.com/" class="theme-button theme-button-secondary" target="_blank">
                            <span class="dashicons dashicons-store"></span>
                            <?php esc_html_e( 'Browse Our Themes', 'dastrong' ); ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="theme-content-section">
                <div class="theme-section-title">
                    <h2><span><?php esc_html_e( '⚙️', 'dastrong' ); ?></span><?php esc_html_e( 'Theme Customization', 'dastrong' ); ?></h2>
                </div>
                <p><?php esc_html_e( 'You can easily customize your theme by going to Appearance > Customize. Here you can adjust colors, layouts, and more.', 'dastrong' ); ?></p>
                <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="theme-button theme-button-secondary">
                    <span class="dashicons dashicons-admin-customizer"></span>
                    <?php esc_html_e( 'Start Customizing', 'dastrong' ); ?>
                </a>
            </div>
        </div>
    </div>
    <?php
}

function dastrong_set_activation_transient() {
    set_transient( 'dastrong_show_welcome_notice', true, 60 );
}
add_action( 'after_switch_theme', 'dastrong_set_activation_transient' );

function dastrong_admin_welcome_notice() {
    if ( get_transient( 'dastrong_show_welcome_notice' ) ) {
        delete_transient( 'dastrong_show_welcome_notice' );

        $theme_page_url = admin_url( 'themes.php?page=dastrong-theme-page' );
        ?>
        <div class="notice notice-success is-dismissible">
            <p><strong><?php esc_html_e( 'Thank you for installing Dastrong Theme! 🎉', 'dastrong' ); ?></strong></p>
            <p><?php esc_html_e( 'Get started with our easy-to-follow guide for setting up your site.', 'dastrong' ); ?></p>
            <p>
                <a href="<?php echo esc_url( $theme_page_url ); ?>" class="button button-primary"><?php esc_html_e( 'View Theme Guide', 'dastrong' ); ?></a>
                <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button"><?php esc_html_e( 'Customize Theme', 'dastrong' ); ?></a>
            </p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'dastrong_admin_welcome_notice' );



