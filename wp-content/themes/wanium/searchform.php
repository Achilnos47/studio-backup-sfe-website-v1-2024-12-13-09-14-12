<form class="search-form" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<input type="text" id="s2" class="mb0" name="s" value="<?php echo trim( get_search_query() ) ?>" placeholder="<?php esc_attr_e( 'Search on site...', 'wanium' ); ?>" autocomplete="off" />
	<input type="submit" value="<?php esc_attr( 'Search', 'wanium' ); ?>" class="btn">
</form>