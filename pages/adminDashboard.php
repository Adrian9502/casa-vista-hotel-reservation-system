<?php
session_start();

// Check if user is logged in
if ($_SESSION['role'] !== 'admin') {
  header("location: ../login/login.html");
  exit();
}

if (isset($_SESSION['username'])) {
  // Get the logged-in username
  $loggedInUsername = $_SESSION['username'];
} else {
  header("location: ../login/login.html");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Casa Vista - Admin</title>
  <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="../styles/adminDashboard-sidebar.css">
  <link rel="stylesheet" href="../styles/adminDashboard.css">
  <link rel="stylesheet" href="../styles/general.css">
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />

</head>

<body class="bg-primary">

  <sidebar class="sidebar open bg-tertiary">
    <div class="logo">
      <img class="logo-sidebar" src="../img/logo-header.png" alt="">
    </div>
    <div class="sidebar-content bg-tertiary">
      <ul class="lists">
        <li class="list">
          <div class="nav-link-user ">
            <div class="user-text">
              <span>Admin</span>
            </div>
          </div>
        </li>
        <li class="list">
          <a href="../pages/adminDashboard.php" class="nav-link">
            <i class="bx bx-home-alt icon"></i>
            <span class="link">Home</span>
          </a>
        </li>
        <li class="list">
          <div class="nav-link hotel-management">
            <i class='bx bxs-hotel icon'></i>
            <span class="link">Hotel Management</span>
          </div>
        </li>

        <li class="list">
          <div class="nav-link room-management">
            <i class='bx bxs-door-open icon'></i>
            <span class="link">Room Management</span>
          </div>
        </li>

        <li class="list">
          <div class="nav-link reservation-management">
            <i class='bx bxs-calendar icon'></i>
            <span class="link">Reservation Management</span>
          </div>
        </li>

        <li class="list">
          <div class="nav-link report-and-analytics">
            <i class='bx bxs-notepad icon'></i>
            <span class="link">Reporting & Analytics</span>
          </div>
        </li>

        <li class="list">
          <div class="nav-link user-management">
            <i class='bx bxs-user icon'></i>
            <span class="link">User Management</span>
          </div>
        </li>


        <li class="list">
          <a href=".././accounts/logout.php" class="nav-link log-out">
            <i class="bx bx-log-out icon"></i>
            <span class="link">Logout</span>
          </a>
        </li>

      </ul>
    </div>
  </sidebar>


  <main id="main-content" class="bg-tertiary">
    <div class="main-container1">
      <div class="admin-dash">
        <div class="dashboard-text">
          Administrator Dashboard
        </div>
        <div class="admin-name">
          <span class="admin-greet">
            Hello, Welcome back!
          </span>
          <span class="admin-rn">
            <i class='bx bxs-user-account'></i> <?php echo $loggedInUsername ?>
          </span>
        </div>
      </div>
      <div class="container-grid">
        <div class="grid hotel-management">
          <i class='bx bxs-hotel grid-icon'></i>
          <div class="grid-title">
            Hotel Management
          </div>
          <p class="grid-description">
            Manage hotel operations. Create, View, Update and Delete Hotels.
          </p>

        </div>
        <div class="grid room-management">
          <i class='bx bxs-door-open grid-icon'></i>
          <div class="grid-title">
            Room Management
          </div>
          <p class="grid-description">
            Manage room operations. Create, View, Update and Delete Rooms.
          </p>
        </div>
        <div class="grid reservation-management">
          <i class='bx bxs-calendar grid-icon'></i>
          <div class="grid-title">
            Reservation Management
          </div>
          <p class="grid-description">
            Manage hotels and rooms operations. book a reservation for hotel and rooms.
          </p>
        </div>
        <div class="grid report-and-analytics">
          <i class='bx bxs-notepad grid-icon'></i>
          <div class="grid-title">
            Reporting & Analytics
          </div>
          <div class="grid-description">
            View data, create reports, and get insights for better decisions.
          </div>
        </div>
        <div class="grid user-management">
          <i class='bx bxs-user grid-icon'></i>
          <div class="grid-title">
            User Management
          </div>
          <div class="grid-description">
            View other administrator and customers.
          </div>

        </div>
        <a href=".././accounts/logout.php">
          <div class="grid">
            <i class="bx bx-log-out grid-icon"></i>
            <div class="grid-title">
              Log out
            </div>
            <div class="grid-description">
              Logout and back to the login page.
            </div>
          </div>
        </a>
      </div>

    </div>
  </main>

  <script type="module" src="../scripts/admin.js">
  </script>
  <?php include 'footer.php'; ?>
</body>

</html>