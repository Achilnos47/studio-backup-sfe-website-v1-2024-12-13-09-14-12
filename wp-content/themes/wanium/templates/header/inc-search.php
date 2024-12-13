<div class="module widget-wrap search-widget-wrap left">
    <div class="search">
        <a href="#" class="modal-fixed-action" data-modal="search-modal"><i class="ti-search"></i></a>
        <span class="title"><?php esc_html_e( 'Search Site', 'wanium' ); ?></span>
    </div>
    <div class="widget-inner modal-fixed" id="search-modal">
	    <a class="modal-fixed-close hidden-sx text-right" href="#"><i class="ti-close color-white-force ms-text opacity-show"></i></a>
	    <div class="modal-fixed-content">
        	<?php echo get_search_form(); ?>
	    </div>
    </div>
</div>