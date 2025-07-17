<?php
include 'db.php';
conn();
global $conns;

$success = $error = "";

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $conns->prepare("DELETE FROM history_transactions WHERE transaction_id = ?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        $success = "Transaction ID $delete_id deleted successfully.";
    } else {
        $error = "Error deleting transaction.";
    }
    $stmt->close();
}

// Fetch all history after potential delete
$history = [];
$result = $conns->query("SELECT * FROM history_transactions ORDER BY completed_at DESC");
while ($r = $result->fetch_assoc()) {
    $history[] = $r;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin | Transaction History</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    body { margin: 0; font-family: Arial, sans-serif; background: #f4f4f4; }
    .main-wrapper { display: flex; height: 100vh; }
    .content { flex: 1; padding: 40px; overflow-y: auto; background: white; }
    .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .header h2 { display: flex; align-items: center; font-size: 22px; gap: 8px; }
    table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
    th, td { padding: 12px 16px; border-bottom: 1px solid #ddd; text-align: left; }
    th { background: #343a40; color: #fff; }
    tr:hover { background: #f1f1f1; }
    .btn { padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; margin-right: 4px; }
    .btn-approve { background: #28a745; color: #fff; }
    .btn-reject { background: #dc3545; color: #fff; }
    .btn-done { background: #6c757d; color: #fff; }
    .btn-cancel { background: #ffc107; color: #000; }
    .success { color: green; margin-bottom: 10px; }
    .error { color: red; margin-bottom: 10px; }
    form { display: inline-block; }
</style>
</head>
<body>

<div class="main-wrapper">
  <?php include 'Sidebar.php'; ?>
  <div class="content">
    <div class="header"> 
      <h2><span class="material-icons">history</span> Booking History</h2>
      <h2><a href="order_history.php">Order History</a></h2>
    </div>

    <?php if ($success): ?>
      <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php elseif ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Room</th>
          <th>Price</th>
          <th>Date</th>
          <th>Status</th>
          <th>Created At</th>
          <th>Completed At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($history) === 0): ?>
          <tr><td colspan="9" style="text-align:center;">No history found.</td></tr>
        <?php else: ?>
          <?php foreach ($history as $tx): ?>
            <tr>
              <td><?= $tx['transaction_id'] ?></td>
              <td><?= htmlspecialchars($tx['username']) ?></td>
              <td><?= htmlspecialchars($tx['room_name']) ?></td>
              <td>₱<?= number_format($tx['price'], 2) ?></td>
              <td><?= htmlspecialchars($tx['date_to_avail']) ?></td>
              <td><?= htmlspecialchars($tx['status']) ?></td>
              <td><?= htmlspecialchars($tx['created_at']) ?></td>
              <td><?= htmlspecialchars($tx['completed_at']) ?></td>
              <td>
                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                  <input type="hidden" name="delete_id" value="<?= $tx['transaction_id'] ?>">
                  <button type="submit" class="btn btn-reject">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>

  </div>
</div>

</body>
</html>
