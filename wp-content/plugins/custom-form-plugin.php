<?php
/**
 * Plugin Name: Custom Form Plugin
 * Description: A simple plugin to add a custom form and connect it to the WordPress database.
 * Version: 1.0
 * Author: Aishwarya
 */

// Hook to add the form to a page or post
function custom_form_display() {
    ob_start();
    ?>

    <form method="POST" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        custom_form_process();
    }

    return ob_get_clean();
}

// Hook to display the form in the content area
function custom_form_shortcode() {
    return custom_form_display();
}
add_shortcode('custom_form', 'custom_form_shortcode');

// Function to process form data and insert into the database
function custom_form_process() {
    global $wpdb;

    // Collect form data
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);

    // Prepare and insert data into the database
    $table_name = $wpdb->prefix . 'custom_form_submissions';  // Creating a table with a custom name
    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'submitted_at' => current_time('mysql'),
        ),
        array('%s', '%s', '%s', '%s')
    );

    // Display success message
    echo '<p>Thank you for your submission!</p>';
}

// Create the custom database table for storing form submissions
function custom_form_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_form_submissions';
    $charset_collate = $wpdb->get_charset_collate();

    // SQL query to create the table
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        message text NOT NULL,
        submitted_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // Include WordPress database upgrade function
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'custom_form_create_table');

?>

