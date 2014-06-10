jQuery(document).ready(function() {
	jQuery(".niceCheck").mousedown(function() {
		changeCheck(jQuery(this));
	});

	jQuery(".niceCheck").each(function() {
		changeCheckStart(jQuery(this));
	});
	hslider_total = jQuery('#slidertop img').length;
	if (hslider_total > 0) { hslider_top_nmb = hslider_total; hslider_go(); }
	
	jQuery('#sidebar-subpages li a').click(function(){
		var showpg = true;
		var liclass = jQuery(this).parent().attr('class');
		var lidnmb = get_id_from_liclass(liclass);
		var lcarr = liclass.split(' ');
		for (var lc=0; lc<lcarr.length; lc++) {
			if (lcarr[lc] == 'noclick') { showpg = false; }
		}
		jQuery(this).parent().find('ul').animate({height: 'show'}, 500);

		if (showpg) {
			show_page(lidnmb);
		}
		jQuery('#sidebar-subpages li').removeClass('current_page_item');
		jQuery(this).parent().addClass('current_page_item').parent().parent().addClass('current_page_item');
		jQuery(".page-item-"+cpnmb).addClass('current_page_item');
		return false;
	});

	/*------------------*/
	/*
	jQuery('#sidebar-subpages li.page-item-723').addClass('current_page_item');
	jQuery('#page-content723').slideDown(500);
	jQuery("#scroll-content").animate({left: "0px"}, 1200);*/
	/*------------------*/
	
	if (jQuery("#content #scroll-content").length > 0)
	{
		jQuery("#scroll-content").animate({left: "0px"}, 1200);
	}
	
	jQuery("li.noclick > a").click(function(){
		return false;
	});
	jQuery('#content img').removeAttr('title');
	
	jQuery('#nav ul li').hover(function(){
			
		var third_lvl_menu = jQuery(this).find('>ul');
		var position = third_lvl_menu.offset();
		var height = third_lvl_menu.outerHeight();
		
		var window_height = jQuery(window).height();
		
		if(position){
			var bottom_menu = position.top + height;
			
			if(bottom_menu > window_height){
				var h = bottom_menu - window_height;
				third_lvl_menu.css({'top':-h-5});
				//console.log('Top:' + position.top + 'Height:' + height)
			}
		}
	});
});

// home slider
var hslider_top_nmb = 0;
var hslider_total = 0;
var hslider_nmb = 1;
var hslider_prev = 1;
var hslider_speed = 8000;
var hslider_timeout = false;

function hslider_go() {
	if (hslider_top_nmb == hslider_total) {
	    jQuery("#hslide-text-1").css({color: "#009BFD"});
	}
	if (hslider_top_nmb == 0) {
		hslider_start();
	} else {
		var tpos = (hslider_top_nmb * 38) - 38;
		jQuery("#hslide-text-"+hslider_top_nmb).animate({top: tpos+"px"}, 800);
		setTimeout("hslider_go()", 900);
		hslider_top_nmb--;
	}

}
function hslider_start() {
    hslider_timeout = setTimeout("hslider_next()", hslider_speed);
}
function hslider_next() {
	hslider_nmb++;
	if (hslider_nmb > hslider_total) { hslider_nmb = 1; }
    hslider_change();
}
function hslider_dot(dnmb) {
    clearTimeout(hslider_timeout);
    hslider_nmb = dnmb;
    hslider_change();
}
function hslider_change() {
    jQuery("#hslide-img-"+hslider_prev).fadeOut(2000);
    jQuery("#hslide-text-"+hslider_prev).animate({color: "#FFFFFF"}, 1000);

    jQuery("#hslide-img-"+hslider_nmb).fadeIn(3000);
    jQuery("#hslide-text-"+hslider_nmb).animate({color: "#009BFD"}, 1000);
	hslider_prev = hslider_nmb;
	hslider_start();
}

// ajax pages
var cpnmb = '';
function show_page(nmb) {
	if (cpnmb == '') {
		var cpiclass = jQuery('#sidebar-subpages li.current_page_item').attr('class');
		cpnmb = get_id_from_liclass(cpiclass);
	}
	if (cpnmb != nmb) {
		jQuery("#scroll-content").animate({left: "1500px"}, 1200, function(){
			jQuery('#scroll-content .entry-content').hide();
			jQuery('#page-content'+nmb).slideDown(500);
			jQuery("#scroll-content").animate({left: "0px"}, 1200);
		});
		cpnmb = nmb;
	}
}

function get_id_from_liclass(classes) {
	var carr = classes.split(' ');
	for (var c=0; c<carr.length; c++) {
		if (carr[c].indexOf('page-item-') > -1) {
			return carr[c].replace('page-item-', '');
		}
	}
}

function footer_newsletter_submit() {
	var n_error = "";
	var nn_value = trim(jQuery("#nname").val());
	var ne_value = trim(jQuery("#nemail").val());
	var agree_ch = jQuery("#fnf_agree").is(':checked');

	if (nn_value == '' || nn_value == 'Name') {
		n_error += "Please enter Your Name.\n";
	}
	if (ne_value == '' || ne_value == 'Email') {
		n_error += "Please enter Your Email.\n";
	} else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(ne_value)) {
		n_error += "Email address is not valid.\n";
	}
	if (!agree_ch) {
		n_error += "Please check checkbox agree with privacy policy.\n";
	}
	if (n_error == "") {
		jQuery.post(
		  js_siteurl+'index.php',
		  {
			FormAction: 'NewsletterSignup',
			nname: nn_value,
			nemail: ne_value
		  },
		  function(data) {
			document.newsletter_form.reset();
			changeCheck(jQuery('.niceCheck'));
			alert("You subscribed successfully.");
		  }
		);
	} else {
		alert(n_error);
	}
	return false;
}

function trim(str) {
	return str.replace(/^\s+|\s+$/g,"");
}