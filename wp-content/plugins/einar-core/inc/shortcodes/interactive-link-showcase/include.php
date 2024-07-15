<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/interactive-link-showcase/class-einarcore-interactive-link-showcase-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/interactive-link-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
