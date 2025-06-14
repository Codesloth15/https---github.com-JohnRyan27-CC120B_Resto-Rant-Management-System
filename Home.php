<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page with Sidebar</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      display: flex;
      height: 100vh;
      background-color: #f4f4f4;
    }

    .sidebar {
      background-color: #1976d2;
      color: white;
      transition: width 0.3s;
      overflow: hidden;
      height: 100vh;
      width: 60px;
    }

    .sidebar.open {
      width: 200px;
    }

    .sidebar .toggle-btn {
      padding: 10px;
      cursor: pointer;
      background-color: #1565c0;
      text-align: center;
    }

    .sidebar .menu {
      display: flex;
      flex-direction: column;
      margin-top: 20px;
    }

    .sidebar .menu-item {
      padding: 15px;
      display: flex;
      align-items: center;
      cursor: pointer;
      transition: background 0.2s;
    }

    .sidebar .menu-item:hover {
      background-color: #1565c0;
    }

    .sidebar .menu-item i {
      margin-right: 10px;
    }

    .menu-label {
      white-space: nowrap;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .sidebar.open .menu-label {
      opacity: 1;
    }

    .content {
      flex: 1;
      padding: 20px;
    }
  </style>
</head>
<body>
  <?php include 'sidebar.php'; ?>

  <div class="content">
    <h1>Welcome to the Home Page</h1>
    <p>Select an option from the sidebar.</p>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    function toggleSidebar() {
      sidebar.classList.toggle('open');
    }
  </script>
</body>
</html>