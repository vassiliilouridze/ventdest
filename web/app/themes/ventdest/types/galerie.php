<?php
add_action('init', 'register_galerie');

function register_galerie() {
  $name = 'galerie';
  $domain = 'ventdest';

  $labels = array(
    'name' => _x(ucfirst($name), 'custom post type : general name', $domain),
    'singular_name' => _x(ucfirst($name), 'custom post type : singular name', $domain),
    'add_new' => _x('Add', 'custom post type : add new', $domain),
    'add_new_item' => __('Add new '.$name, $domain),
    'edit_item' => __('Edit', $domain),
    'new_item' => __('New '.$name, $domain),
    'view_item' => __('See '.$name, $domain),
    'search_items' => __('Search', $domain),
    'not_found' =>  __('No '.$name.' found', $domain),
    'not_found_in_trash' => __('No '.$name.' found in the trash', $domain),
    'parent_item_colon' => '',
    'menu_name' => _x(ucfirst($name),'custom post type : menu name', $domain),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-format-gallery',
    'supports' => array('title','thumbnail','editor')
  );

  register_post_type('galerie',$args);
}
