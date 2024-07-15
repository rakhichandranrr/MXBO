<?php

include_once EINAR_CORE_INC_PATH . '/search/class-einarcore-search.php';
include_once EINAR_CORE_INC_PATH . '/search/helper.php';
include_once EINAR_CORE_INC_PATH . '/search/dashboard/admin/search-options.php';

foreach ( glob( EINAR_CORE_INC_PATH . '/search/layouts/*/include.php' ) as $layout ) {
	include_once $layout;
}
