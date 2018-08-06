<?php
add_action('init', 'register_about');
function register_about() 
{
  $labels = array(
    'name' => _x('À propos', 'post type general name'),
    'singular_name' => _x('À propos', 'post type singular name'),
    'add_new' => _x('Ajouter un article', 'Projet'),
    'add_new_item' => __('Ajouter un article'),
    'edit_item' => __('Editer'),
    'new_item' => __('Nouvel article'),
    'view_item' => __('Voir le contenu'),
    'search_items' => __('Rechercher un article'),
    'not_found' =>  __('Pas d’articles'),
    'not_found_in_trash' => __('Pas de contenu dans la corbeille'), 
    'parent_item_colon' => '',
    'menu_name' => 'À propos'
  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'page',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 2,
    'supports' => array('title','editor','thumbnail')
  ); 
  register_post_type('about',$args);

}
