<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if (has_post_thumbnail()) { ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_thumb(get_post_thumbnail_id($post->ID), 'post-thumb'); ?>" alt="" class="feature" /></a>
			<?php } ?>
			<div class="hentry-holder">
				
				<h2 class="entry-title"><?php the_title(); ?></h2>
				
				<div class="entry-summary">
					<?php the_content(''); ?>
				</div><!-- .entry-summary -->
				<?php $post_content = get_the_content();
					if(strpos($post_content, '#more-')):
				 ?>
				<div class="btn-holder">
					<a href="<?php the_permalink(); ?>" class="btn-more">Read more</a>
				</div>
				 <?php endif; ?>
			</div>
		</div><!-- #post-## -->

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
		<div id="nav-below" class="navigation">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older newsletter', 'twentyten' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer newsletter <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
		</div><!-- #nav-below -->
<?php endif; ?>
