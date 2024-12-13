		<?php get_template_part( 'templates/footer/layout', wanium_get_footer_layout() ); ?>
		<?php if ( 'yes' == get_option('wanium_enable_scroll_top', 'yes') ) : ?>
			<div class="back-to-top"><i class="ti-angle-up"></i></div>
		<?php endif; ?>
	</div><!--END: main-container-->
	<?php wp_footer(); ?>
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="pswp__bg"></div>
	    <div class="pswp__scroll-wrap">
	        <div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div>
	        <div class="pswp__ui pswp__ui--hidden">
	            <div class="pswp__top-bar">
	                <div class="pswp__counter"></div>
	                <button class="pswp__button pswp__button--close" title="<?php esc_html_e( 'Close (Esc)', 'wanium' ) ?>"></button>
	                <button class="pswp__button pswp__button--share" title="<?php esc_html_e( 'Share', 'wanium' ) ?>"></button>
	                <button class="pswp__button pswp__button--fs" title="<?php esc_html_e( 'Toggle fullscreen', 'wanium' ) ?>"></button>
	                <button class="pswp__button pswp__button--zoom" title="<?php esc_html_e( 'Zoom in/out', 'wanium' ) ?>"></button>
	                <div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div>
	            </div>
	            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class="pswp__share-tooltip"></div></div>
	            <button class="pswp__button pswp__button--arrow--left" title="<?php esc_html_e( 'Previous (arrow left)', 'wanium' ) ?>"></button>
	            <button class="pswp__button pswp__button--arrow--right" title="<?php esc_html_e( 'Next (arrow right)', 'wanium' ) ?>"></button>
	            <div class="pswp__caption"><div class="pswp__caption__center"></div></div>
	        </div>
	    </div>
	</div>
</body>
</html>