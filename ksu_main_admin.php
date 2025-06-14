<?php
session_start();
include "db.php";
conn(); 

if (!$conns) {
    echo "<h2>Database connection error: " . mysqli_connect_error() . "</h2>";
}

// Handle Search & Filtering
$search = isset($_GET['search']) ? mysqli_real_escape_string($conns, $_GET['search']) : '';
$category = isset($_GET['category']) ? mysqli_real_escape_string($conns, $_GET['category']) : '';

// Handle Delete Functionality
if (isset($_POST['delete'])) {
    $post_id = mysqli_real_escape_string($conns, $_POST['post_id']);
    
    // SQL query to delete the post
    $deleteQuery = "DELETE FROM posts WHERE id = '$post_id'";
    
    if (mysqli_query($conns, $deleteQuery)) {
        // Redirect back to the page after deletion
        header("Location: ksu_main_admin.php");
        exit;
    } else {
        echo "<p>Error deleting post: " . mysqli_error($conns) . "</p>";
    }
}

// Handle Update Functionality
if (isset($_POST['update'])) {
    $post_id = mysqli_real_escape_string($conns, $_POST['post_id']);
    $title = mysqli_real_escape_string($conns, $_POST['title']);
    $content = mysqli_real_escape_string($conns, $_POST['content']);
    $category = mysqli_real_escape_string($conns, $_POST['category']);
    
    // Handle Image Upload
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "uploads/";  // Directory where images will be stored
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        
        // Move the uploaded file to the server's upload directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $imagePath = $uploadFile;
        } else {
            echo "<p>Error uploading image.</p>";
        }
    }
    
    // Update the database with the new image path if available
    $updateQuery = "UPDATE posts SET title = '$title', content = '$content', category = '$category'";
    if ($imagePath) {
        $updateQuery .= ", img = '$imagePath'";  // Update the image column
    }
    $updateQuery .= " WHERE id = '$post_id'";
    
    if (mysqli_query($conns, $updateQuery)) {
        // Redirect back to the page after update
        header("Location: ksu_main_admin.php");
        exit;
    } else {
        echo "<p>Error updating post: " . mysqli_error($conns) . "</p>";
    }
}

// SQL query for fetching posts with search and category filter
$dataQuery = "SELECT id, title, content, category, user_id, img FROM posts WHERE (title LIKE '%$search%' OR content LIKE '%$search%')";
if ($category) {
    $dataQuery .= " AND category = '$category'";
}
$dataQuery .= " ORDER BY id DESC";

$contents = mysqli_query($conns, $dataQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS-KSU Announcements</title>
    <link rel="stylesheet" href="css/user_dashboard.css">
</head>

<body>
    <!-- Header Section -->
    <header>
    <div class="header-container">
        <img src="img/logo.png" alt="Logo" class="logo">
        <img src="img/its.png" alt="Logo" class="logo">
        <h3> ITS - Kalinga State University</h3>
    <br> &nbsp;
        <nav class="nav-links">
            <a href="my_profile.php"><img class="homeicon" src="img/home.png" alt=""></a>
            <a href="admin_dashboard"><img class="dashboardicon" src="img/dashboard.png" alt=""></a>
            <a href="create_announcement.php"><img class="createicon" src="img/create.png" alt=""></a>
            <a href="logout.php"><img class="logouticon" src="img/logout.png" alt=""></a>
        </nav>
    </div>
    <section class="search-section">
        <form method="GET" action="ksu_main_admin.php">
            <input type="text" name="search" placeholder="Search announcements...">
            <select name="category">
                <option value="">All Categories</option>
                <option value="Events">Events</option>
                <option value="Announcements">Announcements</option>
                <option value="News">News</option>
            </select>
            <button type="submit">Search</button>
        </form>
    </section>
    </header>
    <!-- Main Content Section -->
    <div class="content-section">
        <?php
        if ($contents) {
            while ($row = mysqli_fetch_assoc($contents)) {
                echo "<div class='post'>";
                echo "<form method='POST' action='ksu_main_admin.php' class='post-form' enctype='multipart/form-data'>";
                echo "<input type='hidden' name='post_id' value='{$row['id']}'>";
                
                // Title as editable input
                echo "<input type='text' name='title' class='post-title' value='" . htmlspecialchars($row['title']) . "' required>";
                
                // Category (Dropdown for better UX)
                echo "<select name='category' class='post-category' required>";
                $categories = ['Events', 'Announcements', 'News']; // Add more categories if needed
                foreach ($categories as $cat) {
                    $selected = ($cat === $row['category']) ? "selected" : "";
                    echo "<option value='$cat' $selected>$cat</option>";
                }
                echo "</select>";
                
                // Display current image if available
                if (!empty($row['img'])) {
                    echo "<img src='" . htmlspecialchars($row['img']) . "' alt='Post Image'  class='post-image' />";
                }

                // Content as editable textarea
                echo "<textarea name='content' class='post-content' required>" . htmlspecialchars($row['content']) . "</textarea>";
                
                // Image Upload Field
                echo "<label for='image'>Upload New Image :</label>";
                echo "<input type='file' name='image' id='image' class='post-image-upload' />";
                
                // Buttons for Update and Delete
                echo "<div class='post-actions'>";
                echo "<button type='submit' name='update' class='update-btn'>Update</button>";
                echo "<button type='submit' name='delete' class='delete-btn'>Delete</button>";
                echo "</div>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<h3>No announcements found. Try searching or filtering.</h3>";
        }
        ?>
    </div>
</body>
</html>



<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    header {
    background-color: #239255; 
    color: white;
    padding: 20px;
    text-align: center;
}

.header-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.logo {
    width: 50px; 
    height: auto; 
    display: inline-block;
}


    nav.nav-links a {
        margin: 0 10px;
        color: white;
        text-decoration: none;
        font-weight: bold;
        font-size: 15px;
    }

    .search-section {
        margin: 20px;
        text-align: center;
    }

    .search-section input,
    .search-section select,
    .search-section button {
        padding: 8px;
        font-size: 14px;
        margin: 5px;
    }

    /* Post List Section */
    .content-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        padding: 20px;
    }

    .post {
        background: #ffffff;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 80%;
        transition: transform 0.2s;
    }

    .post:hover {
        transform: translateY(-3px);
    }

    .post h2 {
        margin-bottom: 8px;
        font-size: 20px;
    }

    .post p {
        margin-bottom: 8px;
        font-size: 16px;
    }

    /* Post Action Buttons */
    .post-actions {
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
    }

    .update-btn,
    .delete-btn {
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: white;
    }

    .update-btn {
        background-color: #007bff;
    }

    .delete-btn {
        background-color: #d9534f;
    }

    .update-btn:hover {
        background-color: #0056b3;
    }

    .delete-btn:hover {
        background-color: #c9302c;
    }
    .homeicon{
        width:45px;
        height: 45px;
    }
    .dashboardicon{
        width: 45px;
        height: 45px ;
    }
    .createicon{
        width: 50px ;
        height: 50px;
    }
    .logouticon{
        width: 45px;
        height: 45px;
    }
    .post {
    background: #ffffff;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 80%;
    margin-bottom: 20px;
    transition: transform 0.2s;
}

.post:hover {
    transform: translateY(-3px);
}

.post-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.post-title,
.post-category,
.post-content {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.post-title {
    font-weight: bold;
    font-size: 20px;
}

.post-category {
    font-size: 16px;
    background-color: #f9f9f9;
}

.post-content {
    min-height: 100px;
    font-size: 16px;
}

.post-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.update-btn,
.delete-btn {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    color: white;
    font-size: 14px;
}

.update-btn {
    background-color: #007bff;
}

.delete-btn {
    background-color: #d9534f;
}

.update-btn:hover {
    background-color: #0056b3;
}

.delete-btn:hover {
    background-color: #c9302c;
}.post-image {
    width: 100%; /* Make the image responsive */
    max-width: 300px; /* Limit maximum width */
    height: auto;
    margin-bottom: 15px;
    border-radius: 5px;
}.post-content {
min-height:500px;
    /* Limits the height to 500px */
        /* Allows vertical resizing by the user */
}
</style>
 