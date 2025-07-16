<?php
session_start();
include __DIR__ . '/../db.php';
conn();
global $conns;

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
$foods = [];
$groupedFoods = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    $room_id = $_POST['room_id'];
    $room_name = $_POST['room_name'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];

    $orderSummary = "";
    $totalOverall = 0;

    foreach ($quantities as $food_id => $qty) {
        if ((int)$qty > 0) {
            $price = (float)$prices[$food_id];
            $total_price = $qty * $price;
            $totalOverall += $total_price;

            $stmt = $conns->prepare("SELECT name FROM resto_menu WHERE id = ?");
            $stmt->bind_param("i", $food_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $food = $result->fetch_assoc();
            $food_name = $food['name'] ?? 'Unknown';

            $orderSummary .= "{$food_name} x{$qty} ₱" . number_format($total_price, 2) . ", ";

            $insert = $conns->prepare("INSERT INTO ordered_foods (transaction_id, username, room_id, room_name, food_id, food_name, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("isisssid", $room_id, $username, $room_id, $room_name, $food_id, $food_name, $qty, $total_price);
            $insert->execute();
        }
    }

    $orderSummary .= "Total: ₱" . number_format($totalOverall, 2);

    $summaryInsert = $conns->prepare("INSERT INTO order_receipts (username, room_id, room_name, summary, total) VALUES (?, ?, ?, ?, ?)");
    $summaryInsert->bind_param("sissd", $username, $room_id, $room_name, $orderSummary, $totalOverall);
    $summaryInsert->execute();

    echo "<script>alert('Order placed successfully!'); window.location.href='transaction_request.php';</script>";
    exit;
}

// Fetch foods
$result = $conns->query("SELECT * FROM resto_menu ORDER BY category, name ASC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $groupedFoods[$row['category']][] = $row;
    }
}

// Fetch user's room info
$roomQuery = $conns->prepare("SELECT * FROM transactions WHERE username = ?");
$roomQuery->bind_param("s", $username);
$roomQuery->execute();
$roomResult = $roomQuery->get_result();
$roomData = $roomResult->fetch_assoc();

$room_name = $roomData['room_name'] ?? 'N/A';
$room_id = $roomData['room_id'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Foods</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
        }

        .container {
            display: flex;
            padding: 20px;
            gap: 20px;
        }

        .menu-section {
            flex: 3;
        }

        .summary-section {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            height: fit-content;
        }

        .category-title {
            font-size: 1.3em;
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }

        .menu-items {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-body {
            padding: 10px 15px;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 5px;
        }

        .qty-btn {
            padding: 5px 10px;
            font-size: 1.1em;
            background: #eee;
            border: none;
            cursor: pointer;
            border-radius: 6px;
        }

        .total-box {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 15px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .summary-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .summary-list li {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px dashed #ddd;
        }

        .submit-btn {
            background: #28a745;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .submit-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<!-- NAVBAR (unchanged) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../LandingPage.php">Rage Room & Resto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">📞 0927-743-3290</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item"><a class="nav-link" href="transaction_request.php">Transaction</a></li>
                    <li class="nav-item"><a class="nav-link" href="LandingPage.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="order_foods.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_rooms.php">Room</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="../logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="container">
    <!-- Left: Menu -->
    <div class="menu-section">
        <form method="POST" id="orderForm">
            <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
            <input type="hidden" name="room_id" value="<?= htmlspecialchars($room_id) ?>">
            <input type="hidden" name="room_name" value="<?= htmlspecialchars($room_name) ?>">

            <?php foreach ($groupedFoods as $category => $items): ?>
                <div class="category-title">🍽️ <?= htmlspecialchars($category) ?></div>
                <div class="menu-items">
                    <?php foreach ($items as $food): ?>
                        <div class="card">
                            <img src="../<?= htmlspecialchars($food['photo']) ?>" alt="Food">
                            <div class="card-body">
                                <div class="card-title"><?= htmlspecialchars($food['name']) ?></div>
                                <p style="margin: 5px 0; font-size: 0.9em;"><?= htmlspecialchars($food['description']) ?></p>
                                <p><strong>₱<?= number_format($food['price'], 2) ?></strong></p>

                                <div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
                                    <button type="button" class="qty-btn" onclick="adjustQuantity(<?= $food['id'] ?>, -1)">➖</button>
                                    <span id="qty-display-<?= $food['id'] ?>">0</span>
                                    <button type="button" class="qty-btn" onclick="adjustQuantity(<?= $food['id'] ?>, 1)">➕</button>
                                </div>

                                <input type="hidden" name="quantity[<?= $food['id'] ?>]" id="qty-input-<?= $food['id'] ?>" value="0">
                                <input type="hidden" name="price[<?= $food['id'] ?>]" value="<?= $food['price'] ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
    </div>

    <!-- Right: Summary -->
    <div class="summary-section">
        <h3>🛒 Order Summary</h3>
        <ul class="summary-list" id="summaryList"><li>No items selected.</li></ul>
        <div class="total-box" id="summaryTotal">₱0.00</div>
        <button type="submit" class="submit-btn">🧾 Place Order</button>
        </form>
    </div>
</div>

<script>
function updateTotals() {
    const inputs = document.querySelectorAll("input[name^='quantity']");
    const summaryList = document.getElementById("summaryList");
    let grandTotal = 0;
    let summaryHTML = '';

    inputs.forEach(input => {
        const qty = parseInt(input.value);
        if (qty > 0) {
            const id = input.name.match(/\d+/)[0];
            const priceInput = document.querySelector(`input[name='price[${id}]']`);
            const price = parseFloat(priceInput.value);
            const name = input.closest('.card-body').querySelector('.card-title').innerText;
            const total = qty * price;
            grandTotal += total;
            summaryHTML += `<li>${name} x ${qty}<span>₱${total.toFixed(2)}</span></li>`;
        }
    });

    summaryList.innerHTML = summaryHTML || '<li>No items selected.</li>';
    document.getElementById("summaryTotal").innerText = '₱' + grandTotal.toFixed(2);
}

function adjustQuantity(foodId, delta) {
    const input = document.getElementById(`qty-input-${foodId}`);
    const display = document.getElementById(`qty-display-${foodId}`);
    let current = parseInt(input.value) || 0;
    current += delta;
    if (current < 0) current = 0;
    input.value = current;
    display.textContent = current;
    updateTotals();
}
</script>

</body>
</html>
