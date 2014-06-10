<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	<div id="content" class="content-one-column" role="main">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div id="nav-above" class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
		</div><!-- #nav-above -->

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
			<?php if (has_post_thumbnail()) { $post_image = get_post_thumbnail_id($post->ID); ?>
			<a href="<?php echo get_attach_url($post_image); ?>" title="<?php the_title(); ?>" rel="lightbox"><img src="<?php echo get_thumb($post_image, 'post-thumb'); ?>" alt="" class="feature" /></a>
			<?php } ?>
		</div><!-- #post-## -->

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->

<?php get_footer(); ?>
