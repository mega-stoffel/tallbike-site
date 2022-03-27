<?php
/**
* Registriert den Post Type "events"
*/
function register_events_post_type() {
    // Hier wird der Post Type registriert
}
add_action( 'init', 'register_events_post_type' );

/*
$labels = array(
    'name'                  => __( 'Bikes', TRANSLATION_CONST ),
    'singular_name'         => __( 'Bike', TRANSLATION_CONST ),
    'add_new'               => __( 'Hinzufügen', TRANSLATION_CONST ),
    'add_new_item'          => __( 'Bike hinzufügen', TRANSLATION_CONST ),
    'edit_item'             => __( 'Bike bearbeiten', TRANSLATION_CONST ),
    'new_item'              => __( 'Bike hinzufügen', TRANSLATION_CONST ),
    'view_item'             => __( 'Bike anzeigen', TRANSLATION_CONST ),
    'view_items'            => __( 'Bikes anzeigen', TRANSLATION_CONST ),
    'search_items'          => __( 'Bike suchen', TRANSLATION_CONST ),
    'not_found'             => __( 'Keine Bikes gefunden', TRANSLATION_CONST ),
    'not_found_in_trash'    => __( 'Keine Bikes im Papierkorb gefunden', TRANSLATION_CONST ),
    'parent_item_colon'     => __( 'Übergeordnete Bikes:', TRANSLATION_CONST ),
    'all_items'             => __( 'Alle Bikes:', TRANSLATION_CONST ),
    'archives'              => __( 'Bikes Archiv:', TRANSLATION_CONST ),
    'attributes'            => __( 'Bikes Attribute:', TRANSLATION_CONST ),
    'insert_into_item'      => __( 'Zu Bike hinzufügen', TRANSLATION_CONST ),
    'uploaded_to_this_item' => __( 'Zu Bike hinzugefügt', TRANSLATION_CONST ),
    'featured_image'        => __( 'Bike-Bild', TRANSLATION_CONST ),
    'set_featured_image'    => __( 'Bike-Bild setzen:', TRANSLATION_CONST ),
    'remove_featured_image' => __( 'Bike-Bild entfernen:', TRANSLATION_CONST ),
    'use_featured_image'    => __( 'Als Bike-Bild verwenden:', TRANSLATION_CONST ),
    'menu_name'             => __( 'Bikes', TRANSLATION_CONST ),
);

$supports = array(
    'title',
    'editor', // Content Bereich
    'excerpt', // Kurzer Auszug des Contents für Archivseiten
    'author',
    'thumbnail', // featured_image / Produktbild
    //'trackbacks',
    //'custom-fields',
    //'revisions',
    'page-attributes',
    'comments'
);

$args = array(
    'labels' => $labels,
    'hierarchical' => false,
    'description' => __( 'Unsere Bikes!', TRANSLATION_CONST ),
    'supports' => $supports,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5, // Unterhalb der Posts
    'menu_icon' => 'dashicons-card',
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'capability_type' => 'post'
);

register_post_type( 'bikes', $args );

add_action( 'init', 'register_product_post_type' );*/