<?php
$op_subpages = get_pages('child_of='.$pid.'&parent='.$pid.'&sort_column=menu_order&sort_order=asc');
if (count($op_subpages) > 0) {
?>
	<?php // OUR PEOPLE ?>
	<div class="entry-content" id="page-content<?php echo $pid; ?>"<?php if ($pid != $post->ID) { echo ' style="display:none;"'; } ?>>
	<?php
		foreach($op_subpages as $op_subpage) {
			$opsp_id = $op_subpage->ID;
			$opsp_title = $op_subpage->post_title;

			$person_subpages = get_pages('child_of='.$opsp_id.'&sort_column=menu_order&sort_order=asc');
			if (count($person_subpages) > 0) {
	?>
				<h4><strong><?php echo $linebreak; ?><?php echo $opsp_title; ?></strong></h4>
				<?php
				foreach($person_subpages as $person_subpage) {
					$psp_id = $person_subpage->ID;
					$psp_title = $person_subpage->post_title;
					$psp_url = get_permalink($psp_id);
					$psp_image = get_post_thumbnail_id($psp_id);
					if ($psp_image) {
				?>
				<div class="wp-caption alignleft">
					<a href="<?php echo $psp_url; ?>"><?php echo wp_get_attachment_image($psp_image, 'person_thumbnail_mini', false, array('title' => $psp_title)); ?></a>
					<p class="wp-caption-text"><?php echo $psp_title; ?></p>
				</div>
				<?
					} // if ($psp_image) {
				} // foreach($person_subpages as $person_subpage) {
				$linebreak = '<img class="alignnone size-full wp-image-952" src="'.get_bloginfo('url').'/wp-content/uploads/2011/09/Line-break.png" alt="" width="600" height="4" />';
			} // if (count($person_subpages) > 0) {
		} // foreach($op_subpages as $op_subpage) {
	?>
	</div><!-- .entry-content -->

	<?php // PEOPLE CATEGORY ?>
	<?php
	foreach($op_subpages as $op_subpage) {
		$opsp_id = $op_subpage->ID;
		$opsp_title = $op_subpage->post_title;

		$person_subpages = get_pages('child_of='.$opsp_id.'&sort_column=menu_order&sort_order=asc');
		if (count($person_subpages) > 0) {
	?>
		<div class="entry-content" id="page-content<?php echo $opsp_id; ?>"<?php if ($opsp_id != $post->ID) { echo ' style="display:none;"'; } ?>>
			<?php
			foreach($person_subpages as $person_subpage) {
				$psp_id = $person_subpage->ID;
				$psp_title = $person_subpage->post_title;
				$psp_url = get_permalink($psp_id);
				$psp_image = get_post_thumbnail_id($psp_id);
				if ($psp_image) {
			?>
			<div class="wp-caption alignleft">
				<a href="<?php echo $psp_url; ?>"><?php echo wp_get_attachment_image($psp_image, 'person_thumbnail_mini', false, array('title' => $psp_title)); ?></a>
				<p class="wp-caption-text"><?php echo $psp_title; ?></p>
			</div>
			<?
				} // if ($psp_image) {
			} // foreach($person_subpages as $person_subpage) {
		?>

		</div><!-- .entry-content -->
	<?php
		} // if (count($person_subpages) > 0) {
	} // foreach($op_subpages as $op_subpage) {
	?>

	<?php // PEOPLE PERSON ?>
	<?php
	foreach($op_subpages as $op_subpage) {
		$person_subpages = get_pages('child_of='.$op_subpage->ID.'&sort_column=menu_order&sort_order=asc');
		if (count($person_subpages) > 0) {
			foreach($person_subpages as $person_subpage) {
				setup_postdata($person_subpage);
				$psp_id = $person_subpage->ID;
				$person_title = get_post_meta($psp_id, 'main title', true);
				$person_position = get_post_meta($psp_id, 'position', true);
				$eduction_title = get_post_meta($psp_id, 'eduction title', true);
		?>
			<div class="entry-content" id="page-content<?php echo $psp_id; ?>"<?php if ($psp_id != $post->ID) { echo ' style="display:none;"'; } ?>>
				<?php if (strlen($person_title)) { ?>
				<h3><strong><?php echo $person_title; ?></strong> <span class="eduction_title"><?php echo $eduction_title; ?></span><br><?php echo $person_position; ?></h3>
				<?php } ?>
				<?php echo get_the_post_thumbnail($psp_id, 'person_thumbnail', array('class' => 'alignright')); ?>
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		<?php
			}
		} // if (count($person_subpages) > 0) {
	} // foreach($person_subpages as $person_subpage) {
	?>
<?php
} // if (count($op_subpages) > 0) {
?>