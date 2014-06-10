<?php
function steinepreis_admin_add_options_page() {
	add_theme_page(
		'Theme Options', // meta title
		'Theme Options', // admin menu title
		8,
		'theme-options',
		'steinepreis_theme_options_page'
	);
}

function steinepreis_theme_options_page() {
	$steinepreis_action_message = '';
	$steinepreis_theme_options = get_option("steinepreis_theme_options");
	if ($_POST['steinepreis_form_submit'] == 'submit') {
		foreach($_POST as $pkey => $pval) { $_POST[$pkey] = str_replace('\"', '"', $pval); }
		foreach($_POST as $pkey => $pval) { $_POST[$pkey] = str_replace("\'", "'", $pval); }
		$steinepreis_theme_options['news_header'] = $_POST["news_header"];
		$steinepreis_theme_options['publications_header'] = $_POST["publications_header"];
		$steinepreis_theme_options['copyright_text'] = $_POST["copyright_text"];
		$steinepreis_theme_options['latest_news_number'] = $_POST["latest_news_number"];
		$steinepreis_theme_options['latest_news_category'] = $_POST["latest_news_category"];
		update_option("steinepreis_theme_options", $steinepreis_theme_options);
		$steinepreis_action_message = 'Options Saved.';
	}
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo __('Theme Options'); ?></h2><br>
		<form method="post" method="POST">
		<input type="hidden" name="steinepreis_form_submit" value="submit">
		<?php if(strlen($steinepreis_action_message)) { ?><div id="message" class="updated fade"><p><?php _e($steinepreis_action_message) ?></p></div><?php } ?>
		<table style="width:auto;">
		  <tr>
			<td>News Header:&nbsp;</td>
			<td><input type="text" name="news_header" value="<?php echo htmlspecialchars($steinepreis_theme_options['news_header']); ?>" style="width:400px;"></td>
		  </tr>
		  <tr>
			<td>Publications Header:&nbsp;</td>
			<td><input type="text" name="publications_header" value="<?php echo htmlspecialchars($steinepreis_theme_options['publications_header']); ?>" style="width:400px;"></td>
		  </tr>
		  <tr>
			<td>Home Latest News Number:&nbsp;</td>
			<td><input type="text" name="latest_news_number" value="<?php echo htmlspecialchars($steinepreis_theme_options['latest_news_number']); ?>" style="width:40px;"></td>
		  </tr>
		  <tr>
			<td>Home Latest News Category:&nbsp;</td>
			<td><select name="latest_news_category">
			<?php
			$pcategories = get_categories('hide_empty=0');
			if ($pcategories) {
				foreach($pcategories as $pcategory) { $s = ''; if ($steinepreis_theme_options['latest_news_category'] == $pcategory->term_id) { $s = ' SELECTED'; }
			?>
				<option value="<?php echo $pcategory->term_id; ?>"<?php echo $s; ?>><?php echo $pcategory->name; ?></option>
			<?php }} ?>
			</select></td>
		  </tr>
		  <tr>
			<td>Copyright Text:&nbsp;</td>
			<td><input type="text" name="copyright_text" value="<?php echo htmlspecialchars($steinepreis_theme_options['copyright_text']); ?>" style="width:400px;"></td>
		  </tr>
		</table>
		<p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php _e('Save') ?>" /></p>
		</form>
	</div>
<?php
}

add_action('admin_menu', 'steinepreis_admin_add_options_page');
?>