<?php

include_once EINAR_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/class-einarcore-product-list-shortcode.php';

foreach ( glob( EINAR_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
