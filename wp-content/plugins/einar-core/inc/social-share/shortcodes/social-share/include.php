<?php

include_once EINAR_CORE_INC_PATH . '/social-share/shortcodes/social-share/class-einarcore-social-share-shortcode.php';

foreach ( glob( EINAR_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
