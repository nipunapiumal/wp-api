		</div><!-- /.main-content -->
		<?php 
	
		if ( izeetak_footer_style() == '1' ) {
			// Basic Footer
			get_template_part( 'templates/footer-widgets');
			get_template_part( 'templates/bottom');
		} else { 
			// Elementor Footer 
			?>
			<footer id="footer" class="izeetak-footer">
				<div class="izeetak-container">
	        		<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display(izeetak_footer_style(), false); ?>
	        	</div>
	        </footer>
		<?php } ?>

		<?php get_template_part( 'templates/scroll-top'); ?>
	</div><!-- /#page -->
</div><!-- /#wrapper -->

<?php wp_footer(); ?>

</body>
</html>