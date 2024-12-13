<?php $languages = icl_get_languages( 'skip_missing=0&orderby=code' ); ?>
<?php if( !empty( $languages ) ) : ?>
    <div class="module widget-wrap language left">
        <ul class="menu menu-language">
            <li class="has-dropdown">
                <a href="#"><?php echo ICL_LANGUAGE_NAME; ?></a>
                <ul>
                    <?php 
                    foreach( $languages as $l ) {
                        echo '<li><a href="'.esc_url($l['url']).'">';
                        if( $l['country_flag_url'] ) {
                            echo '<img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" />';
                        }
                        echo esc_attr($l['native_name']);
                        echo '</a></li>';
                    } 
                    ?>
                </ul>
            </li>
        </ul>
    </div>
<?php endif;