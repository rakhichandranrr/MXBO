<?php

get_header();

$params                  = array();
$params['template_slug'] = 'shortcode';

// Include cpt content template
einar_core_template_part( 'post-types/team', 'templates/content', '', $params );

get_footer();
