<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/event-agenda/class-einarcore-event-agenda-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/event-agenda/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
