<?php
/**
 * Template Name: Intranet Template
 
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
$pid = get_root_pid($post->ID);

get_header(); ?>
<div id="main">
	<div id="content" role="main">
		<div id="scroll-content" class="scroll-content" role="main">
			<?php if (is_our_people($pid)) : ?>

				<?php include('tpl-people.php'); ?>

			<?php else : ?>

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="entry-content" id="page-content<?php the_ID(); ?>">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
				<?php endwhile; // end of the loop. ?>

				<?php
				if ($pid != $post->ID) {
					$ppage_data = get_post($pid);
					setup_postdata($ppage_data);
				?>
					<div class="entry-content" id="page-content<?php echo $pid; ?>" style="display:none;">
						<?php the_content(); ?>
					</div>
				<?php } ?>
				
				<?php
				$spages = get_pages('child_of='.$pid);
				if (count($spages) > 0) {
					foreach($spages as $spage) { setup_postdata($spage); ?>
						<div class="entry-content" id="page-content<?php echo $spage->ID; ?>" style="display:none;">
							<?php the_content(); ?>
						</div>
				<?php }} ?>
			<?php endif; ?>
		</div>
	</div><!-- #content -->
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
