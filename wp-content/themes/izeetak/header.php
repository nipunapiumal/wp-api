<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="wrapper" style="<?php echo izeetak_element_bg_css( 'wrapper_background_img' ); ?>">
	<div class="search-style-fullscreen">
    	<div class="search_form_wrap">
    		<span class="search-close"></span>
        	<?php get_search_form(); ?>
        </div>
    </div><!-- /.search-style-fullscreen -->
	
    <div id="page" class="clearfix <?php echo izeetak_preloader_class(); ?>">
    	<div id="site-header-wrap">
			<?php get_template_part( 'templates/site-header' ); ?>
		</div><!-- /#site-header-wrap -->

		<?php get_template_part( 'templates/featured-title' ); ?>

        <!-- Main Content -->
        <div id="main-content" class="site-main clearfix" style="<?php echo izeetak_main_content_bg(); ?>">