<!DOCTYPE html>
<html lang="en">

<head>
  <!-- THIS FILE FOR THE AJAX REQUEST FOR DYNAMIC PAGE  -->
  <!-- Reservation Management -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../../../hotel_reservation_system/styles/admin-management.css">
</head>

<body>
  <div class="main-container">
    <div class="container" id="main-content">
      <div class="title-con">
        <h2 class="section-heading">Reservation Management</h2>
        <div class="crud-btn">

          <button class="crud-button" id="update-reservation-btn">
            <i class='fas fa-edit icon-btn'>
              <span>&#160;Update</span>
            </i>
          </button>
          <button class="crud-button" id="cancel-reservation-btn">
            <i class='fas fa-times icon-btn'>
              <span>&#160;Cancel</span>
            </i>
          </button>
        </div>
      </div>
      <div class="input-con">
        <input type="text" id="search" placeholder="Search Room by ID">
        <button class="search-btn search-btn-reservation" id="search-btn">Search</button>
      </div>
      <?php
      // Establish database connection
      include('../../accounts/db.php');

      $sql = "SELECT Reservations.reservation_id, Users.full_name, Rooms.room_number, Rooms.room_id, Reservations.check_in, Reservations.check_out
      FROM Reservations 
      JOIN Users ON Reservations.user_id = Users.user_id 
      JOIN Rooms ON Reservations.room_id = Rooms.room_id";
      $result = $conn->query($sql);
      if ($result === false) {
        echo "Error: " . $conn->error;
        exit;
      }

      $reservations = array();
      while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
      }
      ?>
      <div class="table-container">
        <table id="reservation-table">
          <thead>
            <tr>
              <th>Reservation ID</th>
              <th>Full Name</th>
              <th>Room ID</th>
              <th>Room Number</th>
              <th>Check-in</th>
              <th>Check-out</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($reservations)) : ?>
              <?php foreach ($reservations as $reservation) : ?>
                <tr>
                  <td><?php echo $reservation['reservation_id']; ?></td>
                  <td><?php echo $reservation['full_name']; ?></td>
                  <td><?php echo $reservation['room_id']; ?></td>
                  <td><?php echo $reservation['room_number']; ?></td>
                  <td><?php echo $reservation['check_in']; ?></td>
                  <td><?php echo $reservation['check_out']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="no-results">No reservations found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Popup form for update reservation -->
    <div class="popup-overlay" id="update-reservation-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Update Reservation</h2>
        <form id="update-reservation-form" method="POST">
          <div class="input-group">
            <label for="reservation-id">Reservation ID:</label>
            <input type="number" id="reservation-id" name="reservation-id" placeholder="Enter existing reservation ID" required>
          </div>
          <div class="input-group">
            <label for="new-check-in">New Check-in Date:</label>
            <input type="date" id="new-check-in" name="new-check-in" required>
          </div>
          <div class="input-group">
            <label for="new-check-out">New Check-out Date:</label>
            <input type="date" id="new-check-out" name="new-check-out" required>
          </div>
          <div class="button-container">
            <button type="submit">Update Reservation</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Popup form for cancel reservation -->
    <div class="popup-overlay" id="cancel-reservation-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Cancel Reservation</h2>
        <form id="cancel-reservation-form" method="POST">
          <label for="cancel-reservation-id">Reservation ID:</label>
          <input type="number" id="cancel-reservation-id" name="reservation-id" placeholder="Enter existing reservation ID" required>
          <div class="button-container">
            <button type="submit">Cancel Reservation</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../../scripts/admin.js" type="module"></script>
</body>

</html>