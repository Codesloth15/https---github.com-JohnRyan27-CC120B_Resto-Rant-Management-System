<?php
session_start();

if (!isset($_SESSION['redirect_url'])) {
    header("Location: login.php");
    exit();
}

$redirect_url = $_SESSION['redirect_url'];
unset($_SESSION['redirect_url']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .splash-container {
            text-align: center;
            animation: fadeOut 3s linear forwards;
        }
        h2 {
            color: #333;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top-color: #58641D;
            border-radius: 50%;
            animation: spin 1s infinite linear;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
    <meta http-equiv="refresh" content="3;url=<?php echo htmlspecialchars($redirect_url); ?>">
</head>
<body>
    <div class="splash-container">
        <div class="spinner"></div>
        <h2>wait mo lang biit...</h2>
        <p>paki uray ta i-redirect mi cka jy dashboard.</p>
    </div>
</body>
</html>
