<?php
/* Template Name: User Admin Management */

// if (!is_user_logged_in() || !current_user_can('administrator')) {
//     wp_redirect(home_url());
//     exit;
// }

get_header();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verify nonce
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'user_admin_action')) {
        die('Security check failed');
    }

    if (isset($_POST['create_user'])) {
        $username = sanitize_text_field($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $role = sanitize_text_field($_POST['role']);
        $custom_role = isset($_POST['custom_role']) ? sanitize_text_field($_POST['custom_role']) : '';

        if ($role === 'custom') {
            if (empty($custom_role)) {
                echo "<p class='error'>Please specify a custom role.</p>";
                return;
            }
            $final_role = $custom_role;

            // Add the custom role to WordPress if it doesn't exist
            if (!get_role($custom_role)) {
                add_role($custom_role, ucwords($custom_role), ['read' => true]);
            }
        } else {
            $final_role = $role;
        }

        if (username_exists($username) || email_exists($email)) {
            echo "<p class='error'>User already exists.</p>";
        } else {
            $password = wp_generate_password();
            $user_id = wp_create_user($username, $password, $email);
            if (!is_wp_error($user_id)) {
                $user = new WP_User($user_id);
                $user->set_role($final_role);

                // Redirect to the WordPress dashboard
                wp_redirect(admin_url());
                exit;
                // echo "<p>User created successfully. Temporary password: $password</p>";
            } else {
                echo "<p class='error'>Error: " . $user_id->get_error_message() . "</p>";
            }
        }
    }

    if (isset($_POST['change_role'])) {
        $user_id = intval($_POST['user_id']);
        $new_role = sanitize_text_field($_POST['new_role']);
        $custom_role = isset($_POST['custom_role']) ? sanitize_text_field($_POST['custom_role']) : '';

        if ($new_role === 'custom') {
            if (empty($custom_role)) {
                echo "<p class='error'>Please specify a custom role.</p>";
                return;
            }
            $final_role = $custom_role;

            // Add the custom role to WordPress if it doesn't exist
            if (!get_role($custom_role)) {
                add_role($custom_role, ucwords($custom_role), ['read' => true]);
            }
        } else {
            $final_role = $new_role;
        }

        $user = new WP_User($user_id);
        if ($user) {
            $user->set_role($final_role);
            echo "<p>Role updated successfully to '{$final_role}'.</p>";
        } else {
            echo "<p class='error'>Error updating role.</p>";
        }
    }
}
?>

<style>
    .user-admin-management {
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
        font-family: Arial, sans-serif;
    }

    .user-admin-management h1, .user-admin-management h2 {
        text-align: center;
        color: #333;
    }

    .user-admin-management form {
        margin-bottom: 30px;
    }

    .user-admin-management label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .user-admin-management input, 
    .user-admin-management select, 
    .user-admin-management button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .user-admin-management button {
        background: #0073aa;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }

    .user-admin-management button:hover {
        background: #005d8f;
    }

    .user-admin-management p {
        text-align: center;
        color: green;
        font-weight: bold;
    }

    .user-admin-management p.error {
        color: red;
    }

    #custom_role_field_create, #custom_role_field_change {
        display: none;
    }
</style>

<div class="user-admin-management">
    <h1>Manage Admin Accounts</h1>
    <form method="post">
        <?php wp_nonce_field('user_admin_action'); ?>
        <h2>Create User</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="role">Role:</label>
        <select id="role" name="role" required onchange="toggleCustomRoleFieldCreate(this.value)">
            <option value="administrator">Administrator</option>
            <option value="editor">Editor</option>
            <option value="author">Author</option>
            <option value="contributor">Contributor</option>
            <option value="subscriber">Subscriber</option>
            <option value="custom">Custom Role</option>
        </select>
        <div id="custom_role_field_create">
            <label for="custom_role_create">Custom Role:</label>
            <input type="text" id="custom_role_create" name="custom_role" placeholder="Enter custom role">
        </div>
        <button type="submit" name="create_user">Create User</button>
    </form>

    <form method="post">
        <?php wp_nonce_field('user_admin_action'); ?>
        <h2>Change User Role</h2>
        <label for="user_id">Select User:</label>
        <select id="user_id" name="user_id" required>
            <?php
            $users = get_users();
            foreach ($users as $user) {
                echo "<option value='{$user->ID}'>{$user->display_name} ({$user->user_email})</option>";
            }
            ?>
        </select>
        <label for="new_role">New Role:</label>
        <select id="new_role" name="new_role" required onchange="toggleCustomRoleFieldChange(this.value)">
            <?php
            global $wp_roles;
            $roles = $wp_roles->roles;
            foreach ($roles as $key => $role) {
                echo "<option value='{$key}'>{$role['name']}</option>";
            }
            ?>
            <option value="custom">Custom Role</option>
        </select>
        <div id="custom_role_field_change">
            <label for="custom_role_change">Custom Role:</label>
            <input type="text" id="custom_role_change" name="custom_role" placeholder="Enter custom role">
        </div>
        <button type="submit" name="change_role">Change Role</button>
    </form>
</div>

<script>
    function toggleCustomRoleFieldCreate(selectedValue) {
        const customRoleField = document.getElementById('custom_role_field_create');
        customRoleField.style.display = selectedValue === 'custom' ? 'block' : 'none';
    }

    function toggleCustomRoleFieldChange(selectedValue) {
        const customRoleField = document.getElementById('custom_role_field_change');
        customRoleField.style.display = selectedValue === 'custom' ? 'block' : 'none';
    }
</script>

<?php get_footer(); ?>
