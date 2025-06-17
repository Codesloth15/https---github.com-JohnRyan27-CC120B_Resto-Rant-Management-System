<?php
session_start();

// Basic site info
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

<!-- Show login error if exists -->
<?php if (isset($_SESSION['login_error'])): ?>
    <div class="alert alert-danger text-center mb-0">
        <?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
    </div>
<?php endif; ?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="LandingPage.php"><?= $site_title ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                 <li class="nav-item">
                    <a class="nav-link" href="#">📞 0927-743-3290</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">About</a>
                </li>
               
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $_SESSION['role'] === 'admin' ? 'Home.php' : 'LandingPage.php' ?>">Transaction</a>
                    </li>
                <?php endif; ?>
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

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Rage Room Experience</h2>
        <p class="text-center"><?= $rooms_intro ?></p>
        <div class="row mt-4">
            <!-- Cards -->
            <?php
            $rage_rooms = [
                ["img" => "../img/rageroom3.avif", "title" => "Smash Zone", "desc" => "Break plates, TVs, and glassware in our safest, most satisfying rage zone."],
                ["img" => "../img/rageroom1.jpg", "title" => "Office Mayhem", "desc" => "Tear apart printers, phones, and cubicle setups to relieve workplace stress."],
                ["img" => "../img/rageroom2.jpg", "title" => "Battle Room", "desc" => "Gear up with full protection and smash with bats, pipes, or sledgehammers."],
                ["img" => "../img/rageroom3.avif", "title" => "Smash Zone", "desc" => "Break plates, TVs, and glassware in our safest, most satisfying rage zone."],
                ["img" => "../img/rageroom1.jpg", "title" => "Office Mayhem", "desc" => "Tear apart printers, phones, and cubicle setups to relieve workplace stress."],
                ["img" => "../img/rageroom2.jpg", "title" => "Battle Room", "desc" => "Gear up with full protection and smash with bats, pipes, or sledgehammers."]
            ];


            foreach ($rage_rooms as $room): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?= $room['img'] ?>" class="card-img-top" alt="<?= $room['title'] ?>" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $room['title'] ?></h5>
                            <p class="card-text"><?= $room['desc'] ?></p>
                            <button class="btn btn-primary book-btn">Book</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Restaurant Section -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Our Restaurant</h2>
        <p class="text-center"><?= $resto_intro ?></p>
        <div class="row mt-4">
            <!-- Dishes -->
            <?php
            $dishes = [
                ["img" => "../img/1.jpg", "title" => "Smash Burger", "desc" => "Juicy beef patty with spicy fries and secret sauce."],
                ["img" => "../img/2.jpg", "title" => "Wreck-It Wings", "desc" => "Crispy, spicy chicken wings served with cool ranch dip."],
                ["img" => "../img/3.jpg", "title" => "Craft Beers & Mocktails", "desc" => "Refresh with our hand-crafted drinks after your rage session."]
            ];
            foreach ($dishes as $dish): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?= $dish['img'] ?>" class="card-img-top" alt="<?= $dish['title'] ?>" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $dish['title'] ?></h5>
                            <p class="card-text"><?= $dish['desc'] ?></p>
                            <button class="btn btn-primary book-btn">Book</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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
          <h5 class="modal-title">Login Required</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if (isset($_SESSION['login_error_modal'])): ?>
              <div class="alert alert-danger"><?= $_SESSION['login_error_modal']; unset($_SESSION['login_error_modal']); ?></div>
          <?php endif; ?>
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

<!-- Book button logic -->
<script>
    document.querySelectorAll('.book-btn').forEach(button => {
        button.addEventListener('click', () => {
            <?php if (isset($_SESSION['username'])): ?>
                window.location.href = "<?= $_SESSION['role'] === 'admin' ? 'Home.php' : 'UserPage.php' ?>";
            <?php else: ?>
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            <?php endif; ?>
        });
    });
</script>

</body>
</html>
