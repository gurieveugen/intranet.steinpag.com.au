<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes();?>>
	<head>
		<meta charset="<?php bloginfo('charset');?>" />
		<meta name="google-site-verification" content="0Vj7SUMIzRtmevE1OtTG1-BtnnX983Ya83W8dLQPnvo" />
		<meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex, nofollow">
		<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page,$paged,$post,$steinepreis_theme_options;
		wp_title('|',true,'right');
		// Add the blog name.
		bloginfo('name');
		// Add the blog description for the home/front page.
		$site_description=get_bloginfo('description','display');
		if($site_description&&(is_home()||is_front_page()))
		echo " | $site_description";
		// Add a page number if necessary:
		if($paged>=2||$page>=2)
		echo ' | '.sprintf(__('Page %s','twentyten'),max($paged,$page));
		?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url');?>" />
		<link href="<?php bloginfo('template_directory');?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/ie.css" />
		<![endif]-->
		<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
		<?php
			wp_enqueue_script("jquery");
			wp_head();
		?>
		<script type="text/javascript">var js_siteurl="<?php bloginfo('url');?>/"; var js_template_url = "<?php bloginfo('template_url');?>/";</script>
		<script src="<?php bloginfo('template_directory');?>/js/jquery.color.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.checkbox.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/theme.js"></script>
		<?php if (is_single()) {
		?>
		<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/js/lightbox.css" type="text/css" media="screen" />
		<script src="<?php bloginfo('template_directory');?>/js/prototype.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_directory');?>/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
		<script src="<?php bloginfo('template_directory');?>/js/lightbox.js" type="text/javascript"></script>
		<?php }?>
	</head>
	<body <?php body_class();?>>
		<div id="wrapper" class="hfeed">
			<div id="header">
				<div class="header-holder">
					<?php get_search_form(); ?>
					<strong class="logo"><a href="<?php bloginfo('url') ?>"><?php get_bloginfo('name');?></a></strong>
				</div>
				<div class="nav-holder">
				<?php wp_nav_menu( array( 'menu' => 'Primary Navigation','container_class'=>'nav-container','link_before'=>'<span>','link_after'=>'</span>','menu_id' =>'nav' ) ); ?>

				</div>
			</div><!-- #header -->
			<?php if (is_front_page()) {
			?>
			<?php
				$home_slides = get_pages('child_of='.get_page_id('Home Slider').'&sort_column=menu_order&sort_order=ASC');
				if (count($home_slides) > 0) {
			?>
			<div class="slidertop-holder">
				<div id="slidertop">
					<?php $hsnmb = 1; $hstp = 0;
					foreach($home_slides as $home_slide) { $slide_image = get_post_thumbnail_id($home_slide->ID);
						if ($slide_image) { ?>
						<img src="<?php echo get_thumb($slide_image, 'home-slider-image'); ?>" alt="" id="hslide-img-<?php echo $hsnmb;?>"<?php echo $hsstyle;?> />
					<?php $hsnmb++;
						$hsstyle=' style="display:none;"';
						}
					}
					?>
					<div class="mask"></div>
					<div class="titletop">
						<?php $hsnmb = 1; foreach($home_slides as $home_slide) {
						?>
						<span id="hslide-text-<?php echo $hsnmb;?>" onclick="hslider_dot(<?php echo $hsnmb;?>)"><?php echo $home_slide->post_title;?></span>
						<?php $hsnmb++;
							$hstp=$hstp+35;
							}
						?>
					</div>
					<div class="text-area">
						<ul>
							<li>Honesty and Integrity</li>
							<li>Teamwork and Respect</li>
							<li>Open Communication</li>
							<li>Quality, Solution Driven Work</li>
							<li>Know Your Client</li>
						</ul>
					</div>
				</div>
			</div>
			<?php } // if (count($home_slides) > 0) {?>
			<?php } else { // if (is_front_page()) { 833 x 200?>
			<?php
			$header_image_aid = get_post_thumbnail_id(get_page_id('Home'));
			if(is_page()) {
				$page_aid = get_post_thumbnail_id($post->ID);
				$page_title = $post->post_title;
				$root_pageid = get_root_pid($post->ID);
				if ($root_pageid > 0 && $root_pageid != $post->ID) {
					$page_aid = get_post_thumbnail_id($root_pageid);
					$page_title = get_the_title($root_pageid);
				}
				if (is_page('newsletters')) {
					$page_title = 'Newsletters';
				}
			} else if(is_blog()) {
				$page_aid = get_post_thumbnail_id(get_page_id('News'));
				if (is_category()) {
					$page_title = get_cat_name(get_query_var('cat'));
				} else {
					$page_title = 'Publications';
				}
				if(is_single() && $post->post_type == 'newsletter') {
					$page_aid = get_post_thumbnail_id(get_page_id('Publications'));
					$page_title = 'Publications';
				}
			}
			if(is_attachment()) {
				$page_aid = get_post_thumbnail_id(get_page_id('Attachment'));
				$page_title = 'Attachment';
			}
			if(strlen($page_aid)) {
				$header_image_aid = $page_aid;
			}
			?>
			<?php if(!is_single()): ?>
			<div class="slidertop-holder page-slidertop">
				<div id="slidertop">
					<img src="<?php echo get_thumb($header_image_aid, 'page-top-image'); ?>" alt="" />
					<div class="mask"></div>
					<div class="titletop page-titletop">
						<?php echo $page_title;?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php } // if (is_front_page()) {?>
