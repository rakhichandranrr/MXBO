<?php

include_once EINAR_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
