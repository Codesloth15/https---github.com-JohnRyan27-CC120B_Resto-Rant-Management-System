<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #e8eaf6, #c5cae9);
        }

        header {
            background-color: #58641D;
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
            background-color: #7B904B;
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
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #BBCF8D;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
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
            background-color: #58641D;
            color: white;
        }

        button[type="submit"]:hover {
            background-color: #7B904B;
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
                <li><a href="createannouncement.php">Create Post</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <main class="content">
            <form id="postForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Post Title:</label>
                    <input type="text" id="title" name="title" placeholder="Enter your post title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea id="content" name="content" placeholder="Write your post content here" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Attach a Photo:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <div class="form-actions">
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>
                </div>
                <div id="message"></div>
            </form>
        </main>
    </div>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
            const image = document.getElementById('image').files[0];

            const formData = new FormData();
            formData.append('title', title);
            formData.append('content', content);
            if (image) {
                formData.append('image', image);
            }

            fetch('create_post.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('message').innerText = data.message;
                document.getElementById('postForm').reset();
            })
            .catch(error => {
                document.getElementById('message').innerText = "An error occurred. Please try again.";
            });
        });
    </script>
</body>
</html>
