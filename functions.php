<?php
/* -------------------------------------------------------------------------- */
/*  Load the good stuff
/* -------------------------------------------------------------------------- */

get_template_part('inc/functions/clean'); // CLEAN WP
get_template_part('inc/functions/enqueue-style'); // ENQUEUE-STYLE
get_template_part('inc/functions/enqueue-scripts'); // ENQUEUE-SCRIPTS
get_template_part('inc/functions/walker-nav'); // WALKER NAV
//get_template_part('inc/dashboard/widget'); // DASHBOARD WIDGETS

get_template_part('inc/functions/setup'); // SETUP THEME
get_template_part('inc/functions/body-class'); // BODY CLASSES
get_template_part('inc/functions/image'); // IMAGE UPLOAD QUALITY ALWAYS 100%
get_template_part('inc/functions/dashboard'); // DASHBOARD WIDGETS
get_template_part('inc/functions/excerpt'); // CUSTOM EXCERPTS
get_template_part('inc/functions/archive-title'); // ARCHIVE TITLE
get_template_part('inc/functions/admin'); // ADMIN
get_template_part('inc/functions/login'); // LOGIN
get_template_part('inc/functions/gutenberg'); // GUTENBERG

get_template_part('inc/custom-post-type/custom-post-type'); // CUSTOM POST TYPES
get_template_part('inc/custom-taxonomy/custom-taxonomy'); // CUSTOM TAXONOMIES

get_template_part('inc/functions/acf-options-page'); // ACF OPTIONS PAGE "Website"

get_template_part('inc/functions/debug'); // DEVELOPER SPECIFIC
