<?php
// Enqueue parent and child theme styles
function my_child_theme_enqueue_styles() {
    // Load parent theme stylesheet first
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    
    // Load child theme stylesheet
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'));
}
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');



//To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'webrpoint_button' ); 
function webrpoint_button() {
    return __( 'Add to basket', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Add to basket', 'woocommerce' );
}
// -------------------------------------------
add_action('wp_footer','my_footer_message');
function my_footer_message(){
    echo "Prerna Trimurty Infotech Pvt. Ltd. All Rights Reserved ";

}

// ---------------------------------------------

add_action('woocommerce_before_add_to_cart_form','new_message');
function new_message(){
    echo"This is a new brand product";
}

//------------------------------------------------

// function my_custom_script() {

// echo '<script>alert("Thanks for visting our site!");</script>';

// }

// add_action( 'wp_footer', 'my_custom_script', 10, 1 );

// ---------------------------------------------------

function custom_admin_notice() {

echo '<div class="notice notice-success is-dismissible">

<p> admin notice!</p>

</div>';

}

add_action( 'admin_notices', 'custom_admin_notice' );

//-------------------------------------


add_action('woocommerce_share','new_message2');
function new_message2(){
    echo"You can also share it with friends!! ". "  " . "click on ".'<button onclick=location.href="https://www.whatsapp.com/" > Share Now </button>';

}

//---------------------custom post---------------------------

add_action( 'init', 'create_custom_post_type' );
 
function create_custom_post_type() {
    $supports = array(
'title', // post title
'editor', // post content
'author', // post author
'thumbnail', // featured images
'excerpt', // post excerpt
'custom-fields', // custom fields
'comments', // post comments
'revisions', // post revisions
'post-formats', // post formats
);

    $labels = array(
'name' => _x('News', 'plural'),
'singular_name' => _x('News', 'singular'),
'menu_name' => _x('News', 'admin menu'),
'name_admin_bar' => _x('News', 'admin bar'),
'add_new' => _x('Add New', 'add new'),
'add_new_item' => __('Add New News'),
'new_item' => __('New News'),
'edit_item' => __('Edit News'),
'view_item' => __('View News'),
'all_items' => __('All News'),
'search_items' => __('Search News'),
'not_found' => __('No News found.'),
);
 
$args = array(
'supports' => $supports,
 'taxonomies' => array('custom-tag'),
// 'taxonomies' => array( 'post_tag', 'Service'),
'labels' => $labels,
'description' => 'Holds our News and specific data',

'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'show_in_admin_bar' => true,
'can_export' => true,
'capability_type' => 'post',
'show_in_rest' => true,
'query_var' => true,
'rewrite' => array('slug' => 'news'),
'has_archive' => true,
'hierarchical' => false,
'menu_position' => 6,
'menu_icon' => 'dashicons-megaphone',
 );
 
register_post_type( 'News',$args);

// register_taxonomy('News_category', 'news', array('hierarchical'=> true, 'label' => 'Category', 'query_var' => true, 'rewrite'=> array( 'slug' => 'news-category')));
}

function wpmu_register_taxonomy() {

  $labels = array(
        'name'              => __( 'Services', 'wpmu' ),
        'singular_name'     => __( 'Service', 'wpmu' ),
        'search_items'      => __( 'Search Services', 'wpmu' ),
        'all_items'         => __( 'All Services', 'wpmu' ),
        'edit_item'         => __( 'Edit Services', 'wpmu' ),
        'update_item'       => __( 'Update Services', 'wpmu' ),
        'add_new_item'      => __( 'Add New Services', 'wpmu' ),
        'new_item_name'     => __( 'New Service Name', 'wpmu' ),
        'menu_name'         => __( 'Services', 'wpmu' ),
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ),
        'rewrite' => array( 'slug' => 'services' ),
        'show_admin_column' => true
    );
    
    register_taxonomy( 'Service', array('news'), $args);
    
}
add_action( 'init', 'wpmu_register_taxonomy' );

register_taxonomy( 
'custom-tag', //taxonomy 
'news', //post-type
array( 
    'hierarchical'  => false, 
    'label'         => __( 'My Custom Tags','taxonomy general name'), 
    'singular_name' => __( 'Tag', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true 
));

// -------------------------form post------------------------------------


function custom_post_creation_form() {
    ob_start(); // Start output buffering
    ?>
    <form method="post">
        <label for="post_title">Post Title:</label>
        <input type="text" name="post_title" id="post_title" required />

        <label for="post_content">Post Content:</label>
        <textarea name="post_content" id="post_content" required></textarea>

        <label for="post_category">Post Category:</label>
        <select name="post_category" id="post_category">
            <?php
            $categories = get_categories();
            foreach ($categories as $category) {
                echo "<option value='{$category->term_id}'>{$category->name}</option>";
            }
            ?>
        </select>

        <label for="post_tags">Post Tags:</label>
        <input type="text" name="post_tags" id="post_tags" />

        <input type="submit" name="submit_post" value="Create Post" />
    </form>
    <?php
    return ob_get_clean(); // Return the output buffer content as a string
}

add_shortcode('create_post_form', 'custom_post_creation_form');
?>