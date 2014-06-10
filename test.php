<?php
if (is_page()) {
	$pid = $post->ID;
	if ($post->post_parent > 0) {
		$pid = $post->post_parent;
	}
	$psubpages = get_pages('child_of='.$pid.'&sort_column=menu_order&sort_order=ASC');
	if (count($psubpages) > 0) {
		foreach($psubpages as $psubpage) {
		}
	}
}

$aop_pid = get_page_id('Areas of Practice');
$aop_subpages = get_pages('child_of='.$aop_pid.'&sort_column=menu_order&sort_order=ASC');
if (count($aop_subpages) > 0) {
	foreach($aop_subpages as $aop_subpage) {
	}
}

$ln_posts = get_posts('numberposts=2');
if (count($ln_posts) > 0) {
	foreach($ln_posts as $ln_post) {
		$post_content = get_limit_content($post_content, 70);
	}
}
?>