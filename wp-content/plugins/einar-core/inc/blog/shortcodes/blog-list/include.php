<?php

include_once EINAR_CORE_INC_PATH . '/blog/shortcodes/blog-list/class-einarcore-blog-list-shortcode.php';

foreach ( glob( EINAR_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
