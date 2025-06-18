<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../LandingPage.php");
    exit;
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "resto_rant_management_system";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM rage_rooms ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Rooms</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="../LandingPage.php">Rage Room & Resto</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="UserPage.php" class="nav-link">Back to Dashboard</a></li>
                <li class="nav-item"><a href="../logout.php" class="nav-link text-danger">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="text-center mb-4">Available Rage Rooms</h2>
    <div class="row">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($room = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php
                            $imgPath = !empty($room['image_path']) ? "../" . $room['image_path'] : "../uploads/default.jpg";
                            $imgPath = htmlspecialchars($imgPath);
                        ?>
                        <img src="<?= $imgPath ?>" class="card-img-top" alt="<?= htmlspecialchars($room['name']) ?>" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($room['name']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($room['description'])) ?></p>
                            <p><strong>Room Type:</strong> <?= htmlspecialchars($room['room_type']) ?></p>
                            <p><strong>Props:</strong> <?= htmlspecialchars($room['props']) ?></p>
                            <p><strong>Price:</strong> ₱<?= number_format($room['price'], 2) ?></p>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary book-btn"
                                data-room-id="<?= $room['id'] ?>"
                                data-room-name="<?= htmlspecialchars($room['name']) ?>"
                            >Book Now</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">No rooms available right now.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="book_room.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Book Room</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="room_id" id="modalRoomId">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($_SESSION['username']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date to Avail</label>
                <input type="date" name="date_to_avail" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Confirm Booking</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.book-btn').forEach(button => {
    button.addEventListener('click', function () {
        const roomId = this.getAttribute('data-room-id');
        document.getElementById('modalRoomId').value = roomId;
        const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
        bookingModal.show();
    });
});
</script>

</body>
</html>

<?php $conn->close(); ?>
