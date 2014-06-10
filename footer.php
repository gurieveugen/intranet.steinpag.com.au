<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
global $steinepreis_theme_options;
?>
	<?php if(is_front_page()) echo '</div><!-- #main -->' ?>
	<div id="footer" role="contentinfo">
		<div class="footer-holder">
			  <p class="copy"><?php echo $steinepreis_theme_options['copyright_text']; ?></p>
			  <?php /* wp_nav_menu( array( 'container' => false, 'menu_class' => 'footer-nav', 'theme_location' => 'footer' ) ); */ ?>
		</div><!-- .footer-holder -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
