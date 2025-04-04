<?php
/*
Template Name: Create Post Form
*/
get_header(); // Include the header
?>
<style>
/* Custom styles for the form */
.form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-container h2 {
    text-align: center;
    color: #333;
}

.form-container label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #444;
}

.form-container input[type="text"],
.form-container input[type="file"],
.form-container input[type="submit"],
.form-container textarea,
.form-container select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.form-container input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

.form-container input[type="submit"]:hover {
    background-color: #45a049;
}

.form-container textarea {
    height: 200px;
}

</style>
<div class="form-container">
    <h2>Create a New Post</h2>

    <?php
    // Handle form submission
    if ( isset($_POST['submit_post']) ) {

        // Verify nonce for security
        if ( isset($_POST['create_post_nonce_field']) && wp_verify_nonce($_POST['create_post_nonce_field'], 'create_post_nonce_action') ) {

            // Sanitize form inputs
            $post_title = sanitize_text_field( $_POST['post_title'] );
            $post_content = sanitize_textarea_field( $_POST['post_content'] );
            $post_category = intval( $_POST['post_category'] );
            $post_tags = sanitize_text_field( $_POST['post_tags'] );

            // Process the file upload
            if ( isset($_FILES['post_image']) && !empty($_FILES['post_image']['name']) ) {
                $uploaded_file = $_FILES['post_image'];

                // Handle the uploaded file
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                $upload_overrides = array( 'test_form' => false ); // Allow file upload in the admin

                // Upload the file and handle errors
                $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

                if ( $movefile && !isset($movefile['error']) ) {
                    // File uploaded successfully, get the URL and file path
                    $file_path = $movefile['file'];
                    $file_url = $movefile['url'];

                    // Insert image into media library
                    $wp_filetype = wp_check_filetype($file_url, null);
                    $attachment = array(
                        'guid' => $file_url,
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => sanitize_file_name($_FILES['post_image']['name']),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );

                    // Insert the attachment into the database
                    $attachment_id = wp_insert_attachment($attachment, $file_path);
                    if (!is_wp_error($attachment_id)) {
                        // Generate attachment metadata and update the post
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $attachment_metadata = wp_generate_attachment_metadata($attachment_id, $file_path);
                        wp_update_attachment_metadata($attachment_id, $attachment_metadata);
                    }
                } else {
                    echo '<p>Error uploading image: ' . $movefile['error'] . '</p>';
                }
            }

            // Prepare post data
            $post_data = array(
                'post_title'   => $post_title,
                'post_content' => $post_content,
                'post_status'  => 'publish', // You can set 'draft' here if you want the post to be saved as a draft
                'post_author'  => get_current_user_id(), // Current user is the author
                'post_category'=> array($post_category), // Selected category
                'tags_input'   => explode(',', $post_tags), // Tags input (comma-separated)
                'post_date'    => current_time('mysql'), // Current date and time
            );

            // Insert the post into the database
            $post_id = wp_insert_post( $post_data );

            if ( $post_id ) {
                // Assign the uploaded image as the featured image
                if ( isset($attachment_id) && !is_wp_error($attachment_id) ) {
                    set_post_thumbnail($post_id, $attachment_id);
                }

                echo '<p>Post created successfully!</p>';
            } else {
                echo '<p>There was an error creating the post.</p>';
            }

        } else {
            echo '<p>Nonce verification failed.</p>';
        }
    }
    ?>

    <!-- Form for creating a post -->
    <form method="post" enctype="multipart/form-data">
        <?php wp_nonce_field('create_post_nonce_action', 'create_post_nonce_field'); ?>

        <label for="post_title">Post Title:</label>
        <input type="text" name="post_title" id="post_title" required />

        <label for="post_content">Post Content:</label>
        <textarea name="post_content" id="post_content" required></textarea>

        <label for="post_category">Post Category:</label>
        <select name="post_category" id="post_category">
            <?php
            // Dynamically load categories
            $categories = get_categories();
            foreach ($categories as $category) {
                echo "<option value='{$category->term_id}'>{$category->name}</option>";
            }
            ?>
        </select>

        <label for="post_tags">Post Tags (comma separated):</label>
        <input type="text" name="post_tags" id="post_tags" />

        <label for="post_image">Featured Image:</label>
        <input type="file" name="post_image" id="post_image" accept="image/*" />

        <input type="submit" name="submit_post" value="Create Post" />
    </form>
</div>

<?php get_footer(); // Include the footer ?>
