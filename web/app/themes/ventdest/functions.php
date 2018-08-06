<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ======

	Required external files

	========= */
define('VERSION', '1.0.3');

	require_once get_template_directory() . '/external/starkers-utilities.php';

  if ( ! file_exists( get_template_directory() . '/external/class-wp-bootstrap-navwalker.php' ) ) {
    // file does not exist... return an error.
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
  } else {
    // file exists... require it.
    require_once get_template_directory() . '/external/class-wp-bootstrap-navwalker.php';
  }

	/* ======

	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme

	========= */

  add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');

  if ( $url_path === ICL_LANGUAGE_CODE.'/exhibitor' ) {
     // load the file if exists
     $load = locate_template('template-single-exposant.php', true);
     if ($load) {
        exit(); // just exit if template was found and loaded
     }
  }
  });

	add_theme_support('post-thumbnails');

	function register_my_menu() {
	  register_nav_menus(
      array(
        'primary' => __( 'Navigation', 'ventdest' ),
        'footer' =>__( 'Footer' , 'ventdest'),
        'copyright' => __('Copyright', 'ventdest'),
        'top_bar' => __('Top bar', 'ventdest')
      )
    );
	}
  add_action( 'init', 'register_my_menu' );  

  function ets_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'footer') {
      $classes[] = '';
    }
    if($args->theme_location == 'copyright') {
      $classes[] = '';
    }
    return $classes;
  }
  add_filter('nav_menu_css_class', 'ets_menu_classes', 1, 3);

  function ets_get_menu_by_location( $location ) {
    if( empty($location) ) return false;

    $locations = get_nav_menu_locations();
    if( ! isset( $locations[$location] ) ) return false;

    $menu_obj = get_term( $locations[$location], 'nav_menu' );

    return $menu_obj;
  }

  // /**
  //  * Register our sidebars and widgetized areas.
  //  *
  //  */
  // function ets_widgets_init() {
  //   register_sidebar( array(
  //     'name'          => 'Footer copyright',
  //     'id'            => 'copyright',
  //     'before_widget' => '<div class="container h-centered">',
  //     'after_widget'  => '</div>'
  //   ) );
  // }
  // add_action( 'widgets_init', 'ets_widgets_init' );


	/* ======

	Actions and Filters

	========= */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ======

	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );

	========= */

  /**
  * Register a private 'Genre' taxonomy for post type 'book'.
  *
  * @see register_post_type() for registering post types.
  */
  // function ets_register_private_taxonomy() {
  //   $args = array(
  //       'label'             => __( 'Jour', 'libramont' ),
  //       'public'            => true,
  //       'rewrite'           => false,
  //       'hierarchical'      => false,
  //       'show_admin_column' => true
  //   );
     
  //   register_taxonomy( 'day', array('concours', 'conference', 'animation'), $args );

  //   $args = array(
  //       'label'             => __( 'Activité', 'libramont' ),
  //       'public'            => true,
  //       'rewrite'           => false,
  //       'hierarchical'      => false,
  //       'show_admin_column' => true
  //   );
     
  //   register_taxonomy( 'activity', array('food'), $args );
  // }
  // add_action( 'init', 'ets_register_private_taxonomy', 0 );

  // require_once( 'types/testimonial.php' );
  require_once( 'types/partner.php' );
  // require_once( 'types/concours.php' );
  // require_once( 'types/food.php' );
  // require_once( 'types/conference.php' );
  require_once( 'types/galerie.php' );
  // require_once( 'types/animation.php' );

  

	/* ========

	Scripts

	=========== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
    // jQuery script
		// wp_register_script( 'jquery', get_template_directory_uri().'/vendor/jquery/jquery.slim.min.js','', false, true );
		// wp_enqueue_script( 'jquery' );

    // Localize your script with server side data.
    global $sitepress;

    $data = [];
    if ( ! empty( $sitepress->get_current_language() ) ) {
        $data['wpml_current_language'] = $sitepress->get_current_language();
    }


    // Slider - slick
		wp_register_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'slick' ); 

    // Popper js
    wp_register_script( 'popperjs', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'popperjs' ); 

    // Popper js
    wp_register_script( 'masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'masonry' ); 

    // Bootstrap js
    wp_register_script( 'bootstrapjs', get_template_directory_uri().'/vendor/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery', 'popperjs' ), false, true );
    wp_enqueue_script( 'bootstrapjs' ); 



    // Main script
    wp_register_script( 'mainjs', get_template_directory_uri().'/assets/js/main.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'mainjs' );

    // Lity lightbox script
    wp_register_script( 'lityjs', get_template_directory_uri().'/assets/js/lity.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'lityjs' );

    // Autocomple script
    wp_register_script( 'autocompletejs', get_template_directory_uri().'/assets/js/awesomplete.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'autocompletejs' );

    // pass Ajax Url to main.js and custom variables
    wp_localize_script('mainjs', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
    wp_localize_script( 'mainjs', 'util', $data );

    // Lity lightbox css
    wp_register_style( 'litycss', get_template_directory_uri().'/assets/css/lity.min.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'litycss' ); 

    // Autocomplete css
    wp_register_style( 'autocompletecss', get_template_directory_uri().'/assets/css/awesomplete.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'autocompletecss' ); 

    // Font Awesome stylesheet
    wp_register_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css', '', '', 'screen' );
    wp_enqueue_style( 'fontawesome' );

    // Google Font stylesheet
    wp_register_style( 'googlefont', 'https://fonts.googleapis.com/css?family=Titillium+Web', '', '', 'screen' );
    wp_enqueue_style( 'googlefont' );

    // Main stylesheet
		wp_register_style( 'screen', get_stylesheet_directory_uri().'/assets/css/style.min.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'screen' );
	}

	/* =========

	Comments

	============ */

  // Disable support for comments and trackbacks in post types
  function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
      if(post_type_supports($post_type, 'comments')) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
      }
    }
  }
  add_action('admin_init', 'df_disable_comments_post_types_support');

  // Close comments on the front-end
  function df_disable_comments_status() {
    return false;
  }
  add_filter('comments_open', 'df_disable_comments_status', 20, 2);
  add_filter('pings_open', 'df_disable_comments_status', 20, 2);

  // Hide existing comments
  function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
  }
  add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

  // Remove comments page in menu
  function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
  }
  add_action('admin_menu', 'df_disable_comments_admin_menu');

  // Redirect any user trying to access comments page
  function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
      wp_redirect(admin_url()); exit;
    }
  }
  add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

  // Remove comments metabox from dashboard
  function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
  }
  add_action('admin_init', 'df_disable_comments_dashboard');

  // Remove comments links from admin bar
  function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
      remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
  }
  add_action('init', 'df_disable_comments_admin_bar');

	/* ======

	Excerpt

	========= */

	function custom_excerpt_length( $length ) {
		return 15;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

  /**
  * Conditional function to check if post belongs to term in a custom taxonomy.
  *
  * @param    tax        string                taxonomy to which the term belons
  * @param    term    int|string|array    attributes of shortcode
  * @param    _post    int                    post id to be checked
  * @return             BOOL                True if term is matched, false otherwise
  */
  function pa_in_taxonomy($tax, $term, $_post = NULL) {
      // if neither tax nor term are specified, return false
      if ( !$tax || !$term ) { return FALSE; }
      // if post parameter is given, get it, otherwise use $GLOBALS to get post
      if ( $_post ) {
          $_post = get_post( $_post );
      } else {
          $_post =& $GLOBALS['post'];
      }
      // if no post return false
      if ( !$_post ) { return FALSE; }
      // check whether post matches term belongin to tax
      $return = is_object_in_term( $_post->ID, $tax, $term );
      // if error returned, then return false
      if ( is_wp_error( $return ) ) { return FALSE; }
      return $return;
  }

/************************************
**
**************************************/

add_filter('next_posts_link_attributes', 'get_next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'get_previous_posts_link_attributes');

if (!function_exists('get_next_posts_link_attributes')){
    function get_next_posts_link_attributes($attr){
        $attr = 'rel="myrel" title="mytitle"';
        return $attr;
    }
}
if (!function_exists('get_previous_posts_link_attributes')){
    function get_previous_posts_link_attributes($attr){
        $attr = 'rel="myrel" title="mytitle"';
        return $attr;
    }
}

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

/*************************************************************
** Theme customization
**************************************************************/

$header_args = array(
  'width'         => 150,
  'height'        => 78,
  'flex-width'    => true,
  'flex-height'   => true,
  'header-text'   => false,
  'default-image' => get_template_directory_uri() . '/assets/img/logo.jpg',
  'uploads'       => true,
);
add_theme_support( 'custom-header', $header_args );

/** Allow SVG through WordPress Media Uploader */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/** Display svg thumbnail in the media library **/
function custom_admin_head() {
  $css = '';

  $css = 'td.media-icon img[src$=".svg"] { width: 100% !important; height: auto !important; }';

  echo '<style type="text/css">'.$css.'</style>';
}
add_action('admin_head', 'custom_admin_head');

function include_svg($url){
	$svg = file_get_contents($url);
	$svg = preg_replace('/<!--(.|\s)*?-->/', '', $svg); // Strip comments in html
	$svg = preg_replace('/<\?(.|\s)*?\?>/', '', $svg); // Strip comments in html
	$doc = DOMDocument::loadHTML($svg);
	foreach($doc->getElementsByTagName('svg') as $image){
	    foreach(array('width', 'height', 'y', 'x') as $attribute_to_remove){
	        if($image->hasAttribute($attribute_to_remove)){
	            $image->removeAttribute($attribute_to_remove);
	        }
	    }
	}
	echo $doc->saveHTML();
}

/** Register more image sizes for responsive images */
function custom_image_setup() {
  add_image_size( 'xsml_size', 150 );
  add_image_size( 'sml_size', 300 );
  add_image_size( 'blog', 300, 170, true);
  add_image_size( 'blog@2x', 600, 340, true);
  add_image_size( 'blog-mini', 96, 96, true);
  add_image_size( 'card-small', 200, 200, true);
  add_image_size( 'mid_size', 600 );
  add_image_size( 'lrg_size', 1200 );
  add_image_size( 'sup_size', 2400 );
}
add_action( 'after_setup_theme', 'custom_image_setup' );

add_filter( 'image_size_names_choose', 'my_custom_sizes' );
 
function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'xsml_size' => 'Extra small (150px × auto)' ,
        'sml_size' => 'Small (300px × auto)' ,
        'mid_size' => 'Medium (600px × auto)' ,
        'lrg_size' => 'Large (1200px × auto)' ,
        'sup_size' => 'Extra Large (2400px × auto)' 
    ) );
}


/**********
ACF
**********/

// Add ACF Option page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page( 
    array(
      'page_title' 	=> 'Options générales',
  		'menu_title' 	=> 'Options générales',
  		'redirect' 		=> false,
  		'icon_url' 		=> 'dashicons-info',
    )
  );
}

add_action('acf/init', 'my_acf_option_init');
function my_acf_option_init() {
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page( 
      array(
        'page_title'  => 'Options générales',
        'menu_title'  => 'Options générales',
        'redirect'    => false,
        'icon_url'    => 'dashicons-info',
      )
    );
  }  
}

// Display Yoast SEO box after all content elements
add_filter( 'wpseo_metabox_prio', function() { return 'low';});

// Remove custom fields metabox for much faster admin page loading
add_filter('acf/settings/remove_wp_meta_box', '__return_true');

// Change default height form ACF wysiwyg textareas & iframes
add_action('acf/input/admin_head', 'my_acf_admin_head');
function my_acf_admin_head() {
    ?>
    <style type="text/css">
      .acf-field-wysiwyg iframe, .acf-field-wysiwyg textarea{
        height: 150px !important;
        min-height: 150px !important;
      }

      .acf-field-5b1fe3c0c552e iframe, .acf-field-5b1fe3c0c552e textarea{
        height: 50px !important;
        min-height: 50px !important;
      }

      .acf-flexhibitorle-content .layout .acf-fc-layout-handle {
        /*background-color: #00B8E4;*/
        background-color: #505458;
        color: #F1F1F1;
      }

      .acf-repeater.-row > table > tbody > tr > td,
      .acf-repeater.-block > table > tbody > tr > td {
        border-top: 2px solid #202428;
      }

      .acf-repeater .acf-row-handle {
        vertical-align: top !important;
        padding-top: 16px;
      }

      .acf-repeater .acf-row-handle span {
        font-size: 20px;
        font-weight: bold;
        color: #202428;
      }

      .imageUpload img {
        width: 75px;
      }

      .acf-repeater .acf-row-handle .acf-icon.-minus {
        top: 30px;
      }
    </style>
    <?php    
}

/**********
WPML
**********/

// Custom language switch in front-end menu
function languages_list(){
    $languages = icl_get_languages('skip_missing=0');
    if(!empty($languages)){
      foreach($languages as $l){
        if($l['active']){
          echo '<span class="text-secondary">';
          echo icl_disp_language(strtoupper($l['language_code']));
          echo '</span>';
        }else{
          echo '<a class="text-primary" href="'.$l['url'].'">';
          echo icl_disp_language(strtoupper($l['language_code']));
          echo '</a>';
        }
      }
    }
}

// Quick fix for WPML language switcher width in admin pages 
add_action('admin_head', 'admin_styles');
function admin_styles() {
  ?>
  <style>
    select{
      width: auto;
    }
  </style>
  <?php
}

/**********
Count views for posts
**********/

function ets_set_post_views($postID) {
    $count_key = 'ets_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function ets_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    ets_set_post_views($post_id);
}
add_action( 'wp_head', 'ets_track_post_views');

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// numbered pagination
function ets_pagination($pages = '', $range = 4)
{  
  $showitems = ($range * 2)+1;  

  global $paged;
  if(empty($paged)) $paged = 1;

  if($pages == '')
  {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages)
    {
      $pages = 1;
    }
  }   

  if(1 != $pages)
  {
    echo '<ul class="list-group-horizontal list-unstyled mt-5 pagination justify-content-center">';
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li class=\"list-group-item\"><a href='".get_pagenum_link(1)."'>&laquo; &laquo;</a></li>";
    if($paged > 1 && $showitems < $pages) echo "<li class=\"list-group-item\"><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

    for ($i=1; $i <= $pages; $i++)
    {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
      {
        echo ($paged == $i)? "<li class=\"list-group-item active\">".$i."</li>":"<li class=\"list-group-item\"><a href=\"".get_pagenum_link($i)."\">".$i."</a></li>";
      }
    }

    if ($paged < $pages && $showitems < $pages) echo "<li class=\"list-group-item\"><a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a></li>";  
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li class=\"list-group-item\"><a href='".get_pagenum_link($pages)."'>&rsaquo; &raquo;</a></li>";
    echo "</ul>\n";
  }
}


/**********
Shortcodes
**********/
function ets_address_shortcode() {
    $address = get_field( 'address', 'option' );
    $email = get_field( 'email_address', 'option' );
    $phone = get_field( 'phone', 'option' );
    $fax = get_field( 'fax', 'option' );

    $facebook = get_field( 'facebook', 'option' );
    $instagram = get_field( 'instagram', 'option' );
    $gplus = get_field( 'google_plus', 'option' );
    $twitter = get_field( 'twitter', 'option' );

    return '<p>'. $address .'</p>
  <p>'. __('E-mail', 'libramont') .'&nbsp;:
      <a href="mailto:'. $email .'">'. $email .'</a>
      <br>'. __('Tél.', 'libramont') .'&nbsp;:
      <a href="tel:'. $phone .'">'. $phone .'</a>
      <br>'. __('Fax', 'libramont') .'&nbsp;:
      <a href="fax:'. $fax .'">'. $fax .'</a>
  </p>
  <p>'. _x('Suivez-nous sur', 'Social media title', 'libramont') .'
      <a href="'. $facebook .'" class="icon" target="_blank">
          <i class="fab fa-facebook-f"></i>
      </a>
      <a href="'. $instagram .'" class="icon" target="_blank">
          <i class="fab fa-instagram"></i>
      </a>
      <a href="'. $twitter .'" class="icon" target="_blank">
          <i class="fab fa-twitter"></i>
      </a>
      <a href="'. $gplus .'" class="icon" target="_blank">
          <i class="fab fa-google-plus-g"></i>
      </a>
  </p>';
}
add_shortcode( 'address', 'ets_address_shortcode' );


add_filter( 'wp_nav_menu_objects', 'add_has_children_to_nav_items' );

function add_has_children_to_nav_items( $items )
{
    $parents = wp_list_pluck( $items, 'menu_item_parent');

    foreach ( $items as $item ){
      $item->has_children = "0";
      if(in_array( $item->ID, $parents )){
        $item->has_children = '1';
      }
    }        

    return $items;
}

function get_url_for_language( $postId )
{
    $current_site = get_permalink($postId);
    return apply_filters( 'wpml_permalink', $current_site , get_locale() , true);

}

/**********
Formats for the editor WYSIWYG
**********/

//add custom styles to the WordPress editor
function my_custom_styles( $init_array ) {

    $style_formats = array(
        // These are the custom styles
        // array(
        //     'title' => 'Encadré',
        //     'selector' => 'p',
        //     'classes' => 'homapage__titleBorder',
        //     'wrapper' => false,
        // )
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_custom_styles' );

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );


add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
  if ( $url_path === 'exhibitor' ) {
     // load the file if exists
     $load = locate_template('template-single-exposant.php', true);
     if ($load) {
        exit(); // just exit if template was found and loaded
     }
  }
});
