<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">

</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <button id="toggleSidebar">Toggle Sidebar</button>
    </header>
    <div class="container">
        <nav class="sidebar hidden">
            <ul>
                <li><a href="ksu_main_admin.php">Home</a></li>
                <li><a href="create_post.php">Create</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
        <main class="content">
        <?php

include "db.php";
 conn(); 
if (!$conns) {
    echo "<h2>Database connection error: " . mysqli_connect_error() . "</h2>";
} else {
    $data = "SELECT id, title, content, user_id FROM  posts ORDER BY id DESC";
    $contents = mysqli_query($conns, $data);
    $user_id = $_SESSION['user_id']; 
    if ($contents) {
        echo "<form action='main.php' method='post' class='post-form'>";
        while ($row = mysqli_fetch_assoc($contents)) {
            echo "<div class='post'>";
            echo "<input type='hidden' name='post_id[]' value='{$row['id']}'>";


                echo "<h2>Title: <input type='text' name='title[{$row['id']}]' value='" . htmlspecialchars($row['title']) . "' class='title-input'></h2>";
                echo "<p>Content: <textarea name='content[{$row['id']}]' class='content-input'>" . htmlspecialchars($row['content']) . "</textarea></p>";
       
            echo "<div class='post-actions'>";
                echo "<button type='submit' name='update' value='{$row['id']}' class='update-btn'>Update</button>";
                echo "<button type='submit' name='delete' value='{$row['id']}' class='delete-btn'>Remove</button>";
            
            echo "</div>";
            echo "</div>";
        }
        echo "</form>";
    } else {
        echo "<h2>Error fetching posts: " . htmlspecialchars(mysqli_error($conns)) . "</h2>";
    }

}

if (isset($_POST['delete'])) {
    $postId = (int)$_POST['delete']; 
   conn(); 
    $deleteQuery = "DELETE FROM posts WHERE id = $postId";

    if (mysqli_query($conns, $deleteQuery)) {
        echo "<script>alert('Post deleted successfully.');location.href='main.php';</script>";
    } else {
        echo "<script>alert('Error deleting post: " . mysqli_error($conns) . "');location.href='main.php';</script>";
    }
  
}

?>
        </main>
    </div>
    <script>
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('.sidebar');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>


<style>

    .userpost{
 width: 100%;
 height: 200px;
 background-color: blue;


    }
</style>
<style>
    .post{
        margin: auto;
        width: 80%;
        background-color: green;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        font-size: 18px;

}

.post-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.post {
    background: #ffffff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.post h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.post p {
    margin: 10px 0;
}

.title-input,
.content-input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background: #f9f9f9;
}

.content-input {
    min-height: 80px;
    resize: vertical;
}

.post-actions {
    display: flex;
    gap: 10px;
}

button {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.update-btn {
    background-color: #007bff;
    color: white;
}

.update-btn:hover {
    background-color: #0056b3;
}

.delete-btn {
    background-color: #d9534f;
    color: white;
}

.delete-btn:hover {
    background-color: #c9302c;
}.content{
    overflow: scroll;
}

</style>



