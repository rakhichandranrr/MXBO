<?php

include_once EINAR_CORE_CPT_PATH . '/clients/shortcodes/clients-list/class-einarcore-clients-list-shortcode.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
