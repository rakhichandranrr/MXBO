<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/image-marquee/class-einarcore-image-marquee-shortcode.php';

foreach ( glob( EINAR_CORE_INC_PATH . '/shortcodes/image-marquee/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
