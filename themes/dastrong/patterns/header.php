<?php
/**
 * Title: header
 * Slug: dastrong/header
 * Inserter: no
 */
?>
<!-- wp:group {"metadata":{"name":"navbar-container"},"align":"wide","style":{"spacing":{"padding":{"bottom":"0px","top":"0px","left":"0px","right":"0px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group alignwide" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size" style="font-style:normal;font-weight:500"><?php esc_html_e('Dastrong', 'dastrong');?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"header_r","layout":{"type":"default"}} -->
<div class="wp-block-group header_r"><!-- wp:navigation {"textColor":"text-transparent-500","icon":"menu","overlayTextColor":"background-primary","align":"full","className":"menu-navbar ","style":{"spacing":{"margin":{"top":"0"},"blockGap":"40px"},"typography":{"fontStyle":"normal","fontWeight":"400","textTransform":"capitalize","fontSize":"15px"}},"layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right","orientation":"horizontal"}} -->
    <!-- wp:navigation-link {"label":"Home","url":"/","kind":"custom"} /-->

	<!-- wp:navigation-link {"label":"Blog","url":"/blog","kind":"custom"} /-->

	<!-- wp:navigation-link {"label":"About","url":"/about","kind":"custom"} /-->
          
	<!-- wp:navigation-link {"label":"Contact","url":"/contact","kind":"custom"} /-->
  
	<!-- wp:navigation-submenu {"label":"Pages"} -->
		<!-- wp:navigation-link {"label":"404","url":"/404","kind":"custom"} /-->
	<!-- /wp:navigation-submenu -->
<!-- /wp:navigation -->
</div>
<!-- /wp:group --></div>
<!-- /wp:group -->