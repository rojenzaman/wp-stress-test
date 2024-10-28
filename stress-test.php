<?php
/**
 * Random WordPress Page Creator
 *
 * This standalone PHP script creates random pages in a WordPress installation without requiring user login.
 * This script is ideal for automated testing, especially with load testing tools like Loader.io.
 *
 * Warning: Use only in development or testing environments, as this bypasses WordPress authentication.
 */

// Set headers to prevent caching
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: 0');

// Database Configuration
define('DB_NAME', 'your_database_name');      // Name of your WordPress database
define('DB_USER', 'your_database_user');      // Database username
define('DB_PASSWORD', 'your_database_password'); // Database password
define('DB_HOST', 'localhost');               // Database host (usually 'localhost')
define('WP_PREFIX', 'wp_');                   // WordPress table prefix (usually 'wp_')

// Secure Access Token
$secure_token = 'your_secure_token_here';     // Replace with your actual secure token

// Check if the token is provided and matches the secure token
if (!isset($_GET['token']) || $_GET['token'] !== $secure_token) {
    echo 'Unauthorized access.';
    exit;
}

// Connect to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Generate random title and content for the new page
$title = 'Random Page ' . bin2hex(random_bytes(5));
$content = 'This is random page content created by <a href="https://github.com/rojenzaman/wp-stress-test" target="_blank">WP Stress Test</a>.';

// SQL query to insert a new page into the WordPress posts table
$sql = "INSERT INTO " . WP_PREFIX . "posts 
        (post_title, post_content, post_excerpt, post_status, post_type, post_author, post_date, post_date_gmt, post_modified, post_modified_gmt, comment_status, ping_status, to_ping, pinged, post_content_filtered) 
        VALUES 
        ('$title', '$content', '', 'publish', 'page', 1, NOW(), NOW(), NOW(), NOW(), 'open', 'closed', '', '', '')";

// Execute the query and display a message
if ($conn->query($sql) === TRUE) {
    $post_id = $conn->insert_id;
    $page_url = '/?p=' . $post_id; // Basic permalink structure; adjust as needed for your site

    echo "New page created! Page ID: " . $post_id . '. ';
    echo '<a href="' . $page_url . '">View Page</a>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
