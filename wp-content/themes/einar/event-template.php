<?php
/*
Template Name: Timetable Event
*/
get_header();

// Include event content template
if ( einar_is_installed( 'core' ) ) {
	einar_core_template_part( 'plugins/timetable', 'templates/content' );
}

get_footer();
