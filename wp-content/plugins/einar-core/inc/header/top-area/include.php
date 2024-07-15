<?php

include_once EINAR_CORE_INC_PATH . '/header/top-area/class-einarcore-top-area.php';
include_once EINAR_CORE_INC_PATH . '/header/top-area/helper.php';

foreach ( glob( EINAR_CORE_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}
