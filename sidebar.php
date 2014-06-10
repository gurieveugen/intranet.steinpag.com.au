 <?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<div id="sidebar">
  <?php
  $calendar_page = get_page_by_title('Calendar');
  $psubpages = array();
  if (is_page()) {
	$root_page = $post;
	$pid = get_root_pid($post->ID);
	$ptitle = get_the_title($pid);
	$home_title = 'In the news';
	$psubpages = wp_list_pages(array(
		'child_of'	=> $pid,
		'title_li'	=> false,
		'echo'		=> false
	));
	$parentsubs = get_pages('child_of='.$pid);
	if (count($parentsubs) > 0) {
		foreach($parentsubs as $parentsub) {
			$noclick = get_post_meta($parentsub->ID, 'noclick', true);						
			if ($noclick == 'true') {
				$psubpages = str_replace('page-item-'.$parentsub->ID, 'page-item-'.$parentsub->ID.' noclick', $psubpages);
			}
		}
	}
	
  }
  ?>
  <?php if (count($psubpages) > 0) { ?>
  <?php if($root_page->ID == $calendar_page->ID || $root_page->post_parent == $calendar_page->ID){
			$ul_id = '';
		}else{
			$ul_id = 'id="sidebar-subpages"';
		}
  ?>		
  <ul <?php echo $ul_id; ?> class="left-navigation">
		<?php if(!is_front_page()){?>
		<li class="page_item page-item-<?php echo $pid; if (is_page($ptitle)) { echo ' current_page_item'; } if( $noclick = get_post_meta($pid, 'noclick', true)){ echo ' noclick'; }?>">
			<a href="<?php echo get_permalink($pid); ?>"><?php echo $ptitle; ?></a>
		</li>
		<?php }?>
		<?php echo $psubpages; ?>
  </ul>
  <?php } ?>
  <?php dynamic_sidebar('sidebar-left-widget-area'); ?>
</div><!-- #primary .widget-area -->
