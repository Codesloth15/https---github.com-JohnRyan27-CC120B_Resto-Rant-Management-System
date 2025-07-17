<?php
include 'db.php';
conn();
global $conns;

$success = $error = "";
$showSuccessPrompt = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = intval($_POST['room_id']);
    $customer_name = trim($_POST['customer_name']);
    $customer_phone = trim($_POST['customer_phone']);
    $customer_address = trim($_POST['customer_address']);
    $rental_date = $_POST['rental_date'];
    $rental_hours = intval($_POST['rental_hours']);

    if ($room_id && $customer_name && $customer_phone && $customer_address && $rental_date && $rental_hours > 0) {
        // Fetch room name from rage_rooms table
        $stmt = $conns->prepare("SELECT name FROM rage_rooms WHERE id = ?");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $stmt->bind_result($room_name);
        $stmt->fetch();
        $stmt->close();

        if (!$room_name) {
            $error = "Invalid room selected.";
        } else {
            // Insert into transactions table
            $stmt = $conns->prepare("INSERT INTO transactions (username, phone_number, room_id, room_name, price, date_to_avail, status, hours) VALUES (?, ?, ?, ?, 'N/A', ?, 'Approved', ?)");
            $stmt->bind_param("ssisss", $customer_name, $customer_phone, $room_id, $room_name, $rental_date, $rental_hours);

            if ($stmt->execute()) {
                $showSuccessPrompt = true;
            } else {
                $error = "Database error: " . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        $error = "Please fill all fields correctly.";
    }
} else {
    $error = "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rent Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; }
        .success { color: green; font-size: 20px; margin-bottom: 20px; }
        .error { color: red; font-size: 18px; margin-bottom: 20px; }
        .button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; font-weight: bold; }
        .button:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="box">
        <?php if ($showSuccessPrompt): ?>
            <div class="success">Transaction successful! ✅</div>
            <a href="Room.php" class="button">Continue</a>
        <?php elseif ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
            <a href="javascript:history.back()" class="button" style="background:#dc3545;">Go Back</a>
        <?php endif; ?>
    </div>
</body>
</html>
