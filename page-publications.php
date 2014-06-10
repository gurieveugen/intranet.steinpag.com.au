<?php
/**
 * Template Name: Publications
 */
get_header(); ?>

	<div id="content" class="content-one-column" role="main">
		<?php query_posts("post_type=newsletter&posts_per_page=1&paged=".get_query_var('paged')); ?>
		<?php get_template_part( 'loop-newsletters' ); ?>
	</div><!-- #content -->

<?php get_footer(); ?>
