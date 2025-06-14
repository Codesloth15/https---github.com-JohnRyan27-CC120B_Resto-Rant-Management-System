<?php 
include "db.php";
session_start();

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category']; // Capture the category
    $user_id = $_SESSION['user_id'];
    
    // Initialize the image path to an empty string
    $imagePath = ''; 

    // Check if an image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $uploadDir = 'uploads/'; // Directory to store images

        // Ensure the uploads directory exists and is writable
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
        }

        // Validate the file extension and size
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxSize = 5 * 1024 * 1024; // 5MB
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        
        if (in_array($imageExtension, $allowedExtensions) && $imageSize <= $maxSize) {
            // Generate a unique file name
            $newImageName = uniqid('img_') . '.' . $imageExtension;

            // Create the full image path
            $imagePath = $uploadDir . $newImageName;

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($imageTmp, $imagePath)) {
                // Image uploaded successfully
            } else {
                echo "<script>alert('Failed to upload image.');</script>";
            }
        } else {
            echo "<script>alert('Invalid image format or size exceeded.');</script>";
        }
    }

    // Database connection
    conn();

    try {
        // Insert post data including category and image
        $data = "INSERT INTO posts (title, content, category, user_id, img) 
                 VALUES ('$title', '$content', '$category', '$user_id', '$imagePath')";
        $contents = mysqli_query($conns, $data);

        if ($contents) {
            echo "<script>alert('Post created successfully');location.href='create_announcement.php';</script>";
        } else {
            echo "<script>alert('Error occurred while creating post');location.href='create_announcement.php';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Error: {$e->getMessage()}');location.href='create_announcement.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Announcement</title>
    <style>
           /* Add your existing styles here */
           body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #e8eaf6, #c5cae9);
        }

        header {
            background-color: #239255;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        #toggleSidebar {
            padding: 10px 15px;
            background-color: #239255;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #toggleSidebar:hover {
            background-color: #58641D;
        }

        .container {
            display: flex;
            flex: 1;
        }

        .sidebar {
            background-color: #333;
            color: white;
            width: 250px;
            transition: width 0.3s;
            min-height: 100vh;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            border-bottom: 1px solid #444;
        }

        .sidebar ul li a {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: white;
            font-size: 16px;
        }

        .sidebar ul li a:hover {
            background-color: #7B904B;
        }

        .content {
            padding: 20px;
            flex-grow: 1;
            background: #f9f9f9;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #58641D;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 2px solid #BBCF8D;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #7B904B;
            background-color: #ffffff;
            outline: none;
            box-shadow: 0 0 5px rgba(123, 144, 75, 0.5);
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button[type="submit"] {
            background-color: #239255;
            color: white;
        }

        button[type="submit"]:hover {
            background-color: #273B09;
        }

        button[type="reset"] {
            background-color: #D32F2F;
            color: white;
        }

        button[type="reset"]:hover {
            background-color: #F44336;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .sidebar.active {
                width: 250px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Create a Post</h1>
        <button id="toggleSidebar">Toggle Sidebar</button>
    </header>
    <div class="container">
        <nav class="sidebar">
            <ul>                
                <li><a href="ksu_main_admin.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <main class="content">
            <form action="create_announcement.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Post Title:</label>
                    <input type="text" id="title" name="title" placeholder="Enter your post title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea id="content" name="content" placeholder="Write your post content here" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="Events">Events</option>
                        <option value="Announcements">Announcements</option>
                        <option value="News">News</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Attach a Photo:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <div class="form-actions">
                    <button type="submit" name="submit">Submit</button>
                    <button type="reset">Reset</button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
