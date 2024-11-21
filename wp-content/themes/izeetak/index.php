<?php get_header(); ?>

<div id="content-wrap" class="izeetak-container">
    <div id="site-content" class="site-content clearfix">
        <div id="inner-content" class="inner-content-wrap">
			<?php 
            if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'templates/entry-content' );
				endwhile;

                izeetak_pagination();
			endif;
            ?>
        </div><!-- /#inner-content -->
    </div><!-- /#site-content -->
    
    <?php get_sidebar(); ?>
</div><!-- /#content-wrap -->

<?php get_footer(); ?>