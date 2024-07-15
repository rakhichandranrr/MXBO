<?php

include_once EINAR_CORE_CPT_PATH . '/team/helper.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/team/dashboard/admin/*.php' ) as $module ) {
	include_once $module;
}

foreach ( glob( EINAR_CORE_CPT_PATH . '/team/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
