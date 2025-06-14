<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogging_platform_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = trim($_POST['category']);
    $author_id = $_SESSION['admin_id'];

    if (empty($title) || empty($content) || empty($category)) {
        echo "<p style='color: red;'>All fields are required.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO posts (title, content, category, author_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $content, $category, $author_id);
        if ($stmt->execute()) {
            echo "<p style='color: green;'>Post added successfully.</p>";
        } else {
            echo "<p style='color: red;'>Error: " . htmlspecialchars($stmt->error) . "</p>";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="content">
        <h2>Add New Post</h2>
        <form method="POST">
            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="Enter post title" required>
            </div>
            <div class="input-group">
                <label for="content">Content</label>
                <textarea name="content" placeholder="Write your post content here..." rows="10" required></textarea>
            </div>
            <div class="input-group">
                <label for="category">Category</label>
                <input type="text" name="category" placeholder="Enter post category" required>
            </div>
            <button type="submit">Add Post</button>
        </form>
    </div>
</body>
</html>