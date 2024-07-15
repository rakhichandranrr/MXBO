<?php

include_once EINAR_CORE_CPT_PATH . '/team/shortcodes/team-list/class-einarcore-team-list-shortcode.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/team/shortcodes/team-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
