<?php
include 'db.php';
conn();
global $conns;

$success = $error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $phone = $_POST['phone_number'];
    $room_id = $_POST['room_id'];
    $date = $_POST['date_to_avail'];

    // Fetch room info
    $stmt = $conns->prepare("SELECT room_name, price FROM rage_rooms WHERE id = ?");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $stmt->bind_result($room_name, $price);
    $stmt->fetch();
    $stmt->close();

    // Insert into transactions
    $stmt = $conns->prepare("INSERT INTO transactions (username, phone_number, room_id, room_name, price, date_to_avail, status, created_at) VALUES (?, ?, ?, ?, ?, ?, 'Approved', NOW())");
    $stmt->bind_param("ssisss", $username, $phone, $room_id, $room_name, $price, $date);
    
    if ($stmt->execute()) {
        $success = "Room successfully booked!";
    } else {
        $error = "Booking failed!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manual Booking</title>
</head>
<body>
  <h2>Manual Room Booking</h2>
  <?php if ($success): ?><p style="color: green;"><?= $success ?></p><?php endif; ?>
  <?php if ($error): ?><p style="color: red;"><?= $error ?></p><?php endif; ?>

  <form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Phone Number:</label><br>
    <input type="text" name="phone_number" required><br><br>

    <label>Select Room:</label><br>
    <select name="room_id" required>
      <?php
      $res = $conns->query("SELECT id, room_name FROM rage_rooms WHERE status = 'Available'");
      while ($row = $res->fetch_assoc()):
      ?>
        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['room_name']) ?></option>
      <?php endwhile; ?>
    </select><br><br>

    <label>Date to Avail:</label><br>
    <input type="date" name="date_to_avail" required><br><br>

    <button type="submit">Book Now</button>
  </form>
</body>
</html>
