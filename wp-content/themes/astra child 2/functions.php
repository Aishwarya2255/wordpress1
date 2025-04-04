<?php
// Enqueue parent and child theme styles
function my_child_theme_enqueue_styles() {
    // Load parent theme stylesheet first
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    
    // Load child theme stylesheet
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'));
}
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');

// -------------------------------

register_sidebar( array(
'name' => 'Footer Sidebar 1',
'id' => 'footer-sidebar-1',
'description' => 'Appears in the footer area',
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );



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

        <label for="post_tags">Post Tags (comma separated):</label>
        <input type="text" name="post_tags" id="post_tags" />

        <input type="submit" name="submit_post" value="Create Post" />
    </form>
    <?php
    return ob_get_clean(); // Return the output buffer content as a string
}

add_shortcode('create_post_form', 'custom_post_creation_form');


