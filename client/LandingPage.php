<?php
session_start();
// Basic configuration (could be loaded from a separate config file)
$site_title = "Rage Room & Resto";
$tagline = "Smash. Eat. Unwind.";
$rooms_intro = "Let out your stress in our fully equipped rage rooms with bats, bottles, and blast-proof fun.";
$resto_intro = "Refuel with hearty meals and cold drinks after a rage session.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $site_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><?= $site_title ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">📞 0927-743-3290</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section text-white text-center d-flex align-items-center" style="background-image: url('../img/l.jpg'); background-size: cover; background-position: center; height: 50vh;">
    <div class="container">
        <h1 style="font-size: 70px; font-weight: bold;"><?= $site_title ?></h1>
        <p class="lead" style="font-size: 40px;"><?= $tagline ?></p>
    </div>
</section>

<!-- Rage Room Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Rage Room Experience</h2>
        <p class="text-center"><?= $rooms_intro ?></p>
        <div class="row mt-4">
            <!-- Card 1 -->
            <div class="col-md-4 mb-4">
                <div class="card h-200 d-flex flex-column">
                    <img src="../img/rageroom3.avif" class="card-img-top" alt="Smash Zone" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Smash Zone</h5>
                        <p class="card-text">Break plates, TVs, and glassware in our safest, most satisfying rage zone.</p>
                        <button class="btn btn-primary book-btn mt-2">Book</button>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4 mb-4">
                <div class="card h-200 d-flex flex-column">
                    <img src="../img/rageroom1.jpg" class="card-img-top" alt="Office Mayhem" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Office Mayhem</h5>
                        <p class="card-text">Tear apart printers, phones, and cubicle setups to relieve workplace stress.</p>
                        <button class="btn btn-primary book-btn mt-2">Book</button>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4 mb-4">
                <div class="card h-200 d-flex flex-column">
                    <img src="../img/rageroom2.jpg" class="card-img-top" alt="Battle Room" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Battle Room</h5>
                        <p class="card-text">Gear up with full protection and smash with bats, pipes, or sledgehammers.</p>
                        <button class="btn btn-primary book-btn mt-2">Book</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Restaurant Section -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Our Restaurant</h2>
        <p class="text-center"><?= $resto_intro ?></p>
        <div class="row mt-4">
            <!-- Dish 1 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="../img/1.jpg" class="card-img-top" alt="Smash Burger" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Smash Burger</h5>
                        <p class="card-text">Juicy beef patty with spicy fries and secret sauce.</p>
                        <button class="btn btn-primary book-btn mt-2">Book</button>
                    </div>
                </div>
            </div>
            <!-- Dish 2 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="../img/2.jpg" class="card-img-top" alt="Wreck-It Wings" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Wreck-It Wings</h5>
                        <p class="card-text">Crispy, spicy chicken wings served with cool ranch dip.</p>
                        <button class="btn btn-primary book-btn mt-2">Book</button>
                    </div>
                </div>
            </div>
            <!-- Dish 3 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="../img/3.jpg" class="card-img-top" alt="Craft Drinks" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Craft Beers & Mocktails</h5>
                        <p class="card-text">Refresh with our hand-crafted drinks after your rage session.</p>
                        <button class="btn btn-primary book-btn mt-2">Book</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; <?= date("Y") ?> <?= $site_title ?>. All rights reserved.</p>
</footer>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="login_handler.php">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <div class="text-center">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('.book-btn').forEach(button => {
        button.addEventListener('click', () => {
            <?php if (isset($_SESSION['user'])): ?>
                window.location.href = "UserPage.php";
            <?php else: ?>
                let loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            <?php endif; ?>
        });
    });
</script>

</body>
</html>
