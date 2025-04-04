<?php
// Enqueue parent and child theme styles
function my_child_theme_enqueue_styles() {
    // Load parent theme stylesheet first
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    
    // Load child theme stylesheet
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'));
}
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');


// ---------post type-----
function custom_post_type_games() {
    register_post_type('games',
        array(
            'labels'      => array(
                'name'          => __('Games'),
                'singular_name' => __('Game'),
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title', 'editor', 'thumbnail'),
            'menu_icon'   => 'dashicons-games',
        )
    );
}
add_action('init', 'custom_post_type_games');

// -----------------next--------------

function featured_games_shortcode($atts) {
    ob_start(); // Start output buffering

    $games_query = new WP_Query(array(
        'post_type'      => 'games',
        'posts_per_page' => 3,
    ));

    if ($games_query->have_posts()) :
        ?>
        <section class="games-section">
            <div class="games-container">
                <?php
                while ($games_query->have_posts()) : $games_query->the_post();
                    $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    ?>
                    <div class="game-card">
                        <img class="game-image" src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="game-btn">Find Out More <span>→</span></a>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
        </section>
        <?php
        wp_reset_postdata();
    else :
        echo "<p>No games found.</p>";
    endif;

    return ob_get_clean(); // Return buffered content
}
add_shortcode('featured_games', 'featured_games_shortcode');

// ==========================

function register_best_seller_post_type() {
    $labels = array(
        'name'                  => _x( 'Best Sellers', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Best Seller', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Best Sellers', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Best Seller', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Best Seller', 'textdomain' ),
        'new_item'              => __( 'New Best Seller', 'textdomain' ),
        'edit_item'             => __( 'Edit Best Seller', 'textdomain' ),
        'view_item'             => __( 'View Best Seller', 'textdomain' ),
        'all_items'             => __( 'All Best Sellers', 'textdomain' ),
        'search_items'          => __( 'Search Best Sellers', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Best Sellers:', 'textdomain' ),
        'not_found'             => __( 'No best sellers found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No best sellers found in Trash.', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'best-seller' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
    );

    register_post_type( 'best_seller', $args );
}
add_action( 'init', 'register_best_seller_post_type' );

function enqueue_slick_slider_assets() {
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css', array(), null);
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css', array(), null);
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider_assets');

// -------------------------------
function best_seller_slider_shortcode($atts) {
    ob_start(); // Start output buffering

    $best_sellers_query = new WP_Query(array(
        'post_type'      => 'best_seller', // Fetch from Best Seller post type
        'posts_per_page' => 6, // Adjust number of posts to display
    ));

    if ($best_sellers_query->have_posts()) :
        ?>
        <section class="best-seller-slider-section">
            <div class="best-seller-slider">
                <?php
                while ($best_sellers_query->have_posts()) : $best_sellers_query->the_post();
                    $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    ?>
                    <div class="bestseller-card">
                        <img class="bestseller-image" src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>">
                        <h3 class="bestseller-title"><?php the_title(); ?></h3>
                        <p class="bestseller-description"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="bestseller-btn">Find Out More <span>→</span></a>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
        </section>
        <script>
            jQuery(document).ready(function($) {
                $('.best-seller-slider').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    arrows: true,
                    dots: true,
                    infinite: true, // Enables infinite loop
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
        </script>
        <?php
        wp_reset_postdata();
    else :
        echo "<p>No best sellers found.</p>";
    endif;

    return ob_get_clean(); // Return buffered content
}
add_shortcode('best_seller_slider', 'best_seller_slider_shortcode');
// ----------footer--------------
function bestseller_names_shortcode() {
    ob_start(); // Start output buffering

    $bestseller_query = new WP_Query(array(
        'post_type'      => 'best_seller', // Custom Post Type
        'posts_per_page' => -1, // Fetch all
    ));

    if ($bestseller_query->have_posts()) :
        echo '<ul class="bestseller-list">';
        while ($bestseller_query->have_posts()) : $bestseller_query->the_post();
            echo '<li class="bestseller-item">' . get_the_title() . '</li>';
        endwhile;
        echo '</ul>';
        wp_reset_postdata();
    else :
        echo "<p>No best sellers found.</p>";
    endif;

    return ob_get_clean(); // Return buffered content
}
add_shortcode('bestseller_names', 'bestseller_names_shortcode');
