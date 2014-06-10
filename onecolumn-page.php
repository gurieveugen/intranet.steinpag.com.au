<?php
/**
 * Template Name: One column, no sidebar
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

$pid = $post->ID;
if ($post->post_parent > 0) { $pid = $post->post_parent; }

get_header(); ?>

<div id="content" class="content-one-column" role="main">
	<div id="scroll-content" class="scroll-content">
			
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="entry-content" id="page-content<?php the_ID(); ?>">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<?php endwhile; // end of the loop. ?>

			<?php
			$psubpages = new WP_Query("post_type=page&post_parent=".$pid."&posts_per_page=-1&orderby=menu_order&order=ASC");
			while($psubpages->have_posts()) : $psubpages->the_post(); ?>
			<div class="entry-content" id="page-content<?php the_ID(); ?>" style="display:none;">
				<?php the_content(); ?>
			</div>
			<?php endwhile; ?>
	</div>
</div><!-- #content -->

<?php get_footer(); ?>

