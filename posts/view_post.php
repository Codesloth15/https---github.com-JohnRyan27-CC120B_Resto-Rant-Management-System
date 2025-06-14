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

$result = $conn->query("SELECT posts.id, posts.title, posts.category, admins.username AS author, posts.created_at 
                        FROM posts 
                        JOIN admins ON posts.author_id = admins.id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="content">
        <h2>All Posts</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                 <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td><?= htmlspecialchars($row['author']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
                    <?php endwhile; ?>
                 <?php else: ?>
                <tr>
                    <td colspan="5">No posts found.</td>
                </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</body>
</html>
