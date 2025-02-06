<?php
/**
 * Verlinkt die Plugin SINGLE Post-Type Seiten
 */
function example_plugin_custom_single_theme_file_include($template) {

    global $wp;
    $requested_post_type = $wp->query_vars["post_type"];

    if($requested_post_type == 'bikes')
        return $template;

    $file = EXAMPLE_PLUGIN_PATH.'/theme_files/single-'.$requested_post_type.'.php';
    if(file_exists($file)) {
        $template = $file;
    }

    return $template;

}
add_filter('single_template', 'example_plugin_custom_single_theme_file_include');

/**
 * Verlinkt die Plugin ARCHIVE Post-Type Seiten
 */
function example_plugin_custom_archive_theme_file_include($template) {

    global $wp;
    $requested_post_type = $wp->query_vars["post_type"];

    if($requested_post_type == 'bikes')
        return $template;

    $file = EXAMPLE_PLUGIN_PATH.'/theme_files/archive-'.$requested_post_type.'.php';
    if(file_exists($file)) {
        $template = $file;
    }

    return $template;

}
add_action('archive_template', 'example_plugin_custom_archive_theme_file_include');

function example_plugin_custom_archive_theme_file_include($template) {

    global $wp;
    $requested_post_type = $wp->query_vars["post_type"];

    if($requested_post_type == 'events')
        return $template;

    $file = EXAMPLE_PLUGIN_PATH.'/theme_files/archive-'.$requested_post_type.'.php';
    if(file_exists($file)) {
        $template = $file;
    }

    return $template;

}
add_action('archive_template', 'example_plugin_custom_archive_theme_file_include');