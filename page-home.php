<?php
/**
 * Template Name: Home page
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
get_header(); ?>



<div id="main">
<div id="content" role="main">
<div id="scroll-content" class="scroll-content" role="main">
<?php if (is_our_people($pid)) : ?>

<?php include('tpl-people.php'); ?>

<?php else : ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="entry-content" id="page-content<?php the_ID(); ?>" style="display:none">
<?php the_content(); ?>
</div><!-- .entry-content -->
<?php endwhile; // end of the loop. ?>

<?php
if ($pid != $post->ID) {
$ppage_data = get_post($pid);
setup_postdata($ppage_data);
?>
<div class="entry-content" id="page-content<?php echo $pid; ?>">
<?php the_content(); ?>
</div>
<?php } ?>

<?php
$spages = get_pages('child_of='.$pid);
if (count($spages) > 0) {
foreach($spages as $spage) { setup_postdata($spage); ?>
<div class="entry-content" id="page-content<?php echo $spage->ID; ?>" style="display:none;">
<?php the_content(); ?>
<? //echo do_shortcode('[ai1ec view="monthly"]'); ?>

</div>
<?php }} ?>

<?php endif; ?>
</div>
</div><!-- #content -->
<?php get_sidebar(); ?>
</div>

<div class="footer-section footer-home">
	<div class="footer-holder">
		<?php //dynamic_sidebar('footer-careers-widget-area'); ?>
		<?php /*
		$latest_news_number = $steinepreis_theme_options['latest_news_number'];
		$latest_news_category = $steinepreis_theme_options['latest_news_category'];
		if (!$latest_news_number) { $latest_news_number = 1; }
		if (!$latest_news_category) { $latest_news_category = 1; } ?>
		<div class="widgets-column">
			<div class="box latest-box">
				<div class="heading">
					<h4>INSIDE SP - WHAT’S NEWS!</h4>
				</div>
				  <?php
				  $ln_posts = get_posts('category='.$latest_news_category.'&numberposts='.$latest_news_number);
				  if (count($ln_posts) > 0) {
				  ?>	
				  <div class="holder">
					<ul>
						<?php foreach($ln_posts as $ln_post) {
						$ln_post_title = $ln_post->post_title;
						$ln_post_excerpt = $ln_post->post_excerpt;
						if (!strlen($ln_post_excerpt)) {
							$ln_post_excerpt = get_limit_content(strip_tags($ln_post->post_content), 70);
						}
						?>
						<li><a href="<?php echo get_permalink($ln_post->ID); ?>"><?php echo $ln_post_excerpt; ?></a></li>
					 <?php } ?>
					</ul>
				</div>
			<?php } ?>
			</div>
			
		</div>
	<?php */ ?>
	<?php dynamic_sidebar('footer-area'); ?>

	</div>
</div> 
<script type="text/javascript">
// make all columns equally high
jQuery(function(){
	jQuery.fn.equalHeightColumns = function() {
		var tallest = 0;
		
		jQuery(this).each(function() {
			if (jQuery(this).outerHeight(true) > tallest) {
				tallest = jQuery(this).outerHeight(true);
			}
		});
		
		jQuery(this).each(function() {
			var diff = 0;
			diff = tallest - jQuery(this).outerHeight(true);
			jQuery(this).height(jQuery(this).height() + diff);
		});
	};

	// call it like this:
	jQuery(".footer-section .box .textwidget").equalHeightColumns();
});
</script>

<?php get_footer(); ?>