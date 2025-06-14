<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: my_profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="sidebar">
    <h3>Admin Panel</h3>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="add_post.php">Add Post</a></li>
        <li><a href="view_posts.php">View Posts</a></li>
        <li><a href="update_account.php">Update Account</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
<div class="content">
    <h1>Welcome, Admin</h1>
    <p>Use the sidebar to navigate through the admin features.</p>
</div>
</body>
</html>

