<?php
/*
 * Verlinkt die Plugin SINGLE Post-Type Seiten
 */
function tallbike_plugin_custom_single_theme_file_include($template)
{
    global $wp;
   
    if(isset($wp->query_vars['post_type'])) // && $wp->query_vars['post_type'] == 'bikes' )
    {
        $requested_post_type = $wp->query_vars['post_type'];
        
        if ($requested_post_type == 'bikes' || $requested_post_type == 'events')
        {
            $file = TALLBIKE_PLUGIN_PATH.'/theme_files/single-' . $requested_post_type . '.php';
            if(file_exists($file)) {
                $template = $file;
            }
        }
        return $template;
    }
    return $template;
}

#add_filter('single_template', 'tallbike_plugin_custom_single_theme_file_include');

/*
 * Verlinkt die Plugin ARCHIVE Post-Type Seiten
 */
function tallbike_plugin_custom_archive_theme_file_include($template) {

    global $wp;
    $requested_post_type = $wp->query_vars["post_type"];

    if(($requested_post_type == 'bikes') || ($requested_post_type == 'events'))
    {
        $file = TALLBIKE_PLUGIN_PATH.'/theme_files/archive-'.$requested_post_type.'.php';
        if(file_exists($file)) {
            $template = $file;
        }
    }
    return $template;
}
#add_action('archive_template', 'tallbike_plugin_custom_archive_theme_file_include');