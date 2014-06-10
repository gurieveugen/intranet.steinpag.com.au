<?php $sq = get_search_query() ? get_search_query() : 'SEARCH SITE'; ?>

<form action="<?php bloginfo('url'); ?>" method="get" class="search-form">
	<fieldset>
		<input class="text" name="s" type="text" value="<?php echo $sq; ?>" onfocus="if(this.value=='SEARCH SITE'){this.value='';}" onblur="if(this.value==''){this.value='SEARCH SITE';}" />
		<input class="btn-search" type="submit" value="Search"/>
	</fieldset>
</form>