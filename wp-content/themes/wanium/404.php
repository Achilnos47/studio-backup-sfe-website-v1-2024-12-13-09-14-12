<?php get_header(); ?>
<section class="fullscreen bg-light">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="text-center">
                    <h1 class="behind"><?php esc_html_e( '404','wanium' ); ?></h1>
                    <h1 class="large"><strong><?php esc_html_e( 'Sorry!', 'wanium' ); ?></strong><?php esc_html_e( "This page isn't available.",'wanium' ); ?></h1>
                    <a class="btn btn-filled btn-rounded btn-lg ti-arrow-right  btn-sm-sm" href="<?php echo get_home_url(); ?>"><?php esc_html_e( 'Go to Homepage','wanium' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer();