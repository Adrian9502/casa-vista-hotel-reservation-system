<!DOCTYPE html>
<html lang="en">

<head>
  <!-- THIS FILE FOR THE AJAX REQUEST FOR DYNAMIC PAGE  -->
  <!-- Room Management -->
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
        <h2 class="section-heading">Room Management</h2>
        <div class="crud-btn">

          <button class="crud-button" id="create-room-btn">
            <i class='fas fa-plus icon-btn'>
              <span>
                &#160;Create
              </span>
            </i>
          </button>
          <button class="crud-button" id="update-room-btn">
            <i class='fas fa-edit icon-btn'>
              <span>&#160;Update</span>
            </i>
          </button>
          <button class="crud-button" id="delete-room-btn">
            <i class='fas fa-times icon-btn'>
              <span>&#160;Delete</span>
            </i>
          </button>
        </div>
      </div>
      <div class="input-con">
        <input type="text" id="search" placeholder="Search Room by ID">
        <button class="search-btn search-btn-room" id="search-btn">Search</button>
      </div>
      <?php
      // Establish database connection
      include('../../accounts/db.php');

      $sql = "SELECT * FROM Rooms";
      $result = $conn->query($sql);
      // Close database connection
      $conn->close();
      ?>
      <div class="table-container">
        <table id="room-table">
          <thead>
            <tr>
              <th>Room ID</th>
              <th>Room Number</th>
              <th>Image</th>
              <th>Room Type</th>
              <th>Price</th>
              <th>Status</th>
              <th>Hotel ID</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                  <td><?php echo $row["room_id"]; ?></td>
                  <td>Room <?php echo $row["room_number"]; ?></td>
                  <td class="db-img">
                    <img class="data-image" src="<?php echo $row["img_link"]; ?>" alt="">
                  </td>
                  <td><?php echo $row["type"]; ?></td>
                  <td><?php echo "$" . $row["price"]; ?></td>
                  <td><?php echo $row["status"]; ?></td>
                  <td><?php echo $row["hotel_id"]; ?></td>
                </tr>
            <?php
              }
            } else {
              echo "<tr><td colspan='4' class='no-results'>No hotels found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Popup form for add room -->
    <div class="popup-overlay" id="create-room-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Create New Room</h2>
        <form id="create-room-form" method="POST">
          <div class="form-group">
            <label for="room-number">Room Number:</label>
            <input type="text" id="room-number" name="room-number" required />
          </div>
          <div class="form-group">
            <label for="room-img-link">Image URL:</label>
            <input type="url" id="room-img-link" name="room-img-link" placeholder="Enter room image URL" required />
          </div>
          <div class="form-group">
            <label for="room-description">Room Description:</label>
            <textarea  type="text" id="room-description" name="room-description" required ></textarea>
          </div>
          <div class="form-group">
            <label for="room-type">Type:</label>
            <select id="room-type" name="room-type" required>
              <option value="Standard">Standard</option>
              <option value="Deluxe">Deluxe</option>
              <option value="Suite">Suite</option>
              <option value="Penthouse">Penthouse</option>
            </select>
          </div>

          <div class="form-group">
            <label for="room-price">Price:</label>
            <input type="number" id="room-price" name="room-price" step="0.01" min="0" required />
          </div>

          <div class="form-group">
            <label for="room-status">Status:</label>
            <select id="room-status" name="room-status" required>
              <option value="available">Available</option>
              <option value="booked">Booked</option>
              <option value="out_of_service">Out of service</option>
            </select>
          </div>

          <div class="form-group">
            <label for="room-hotel">Hotel ID:</label>
            <select id="room-hotel" name="room-hotel" required>
              <?php
              include("../../accounts/db.php");

              // Query to fetch hotels from the database
              $sql = "SELECT hotel_id, name FROM Hotel";

              // Execute the query
              $result = $conn->query($sql);

              // Check if query was successful
              if ($result->num_rows > 0) {
                // Loop through the result set and generate <option> elements
                while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['hotel_id'] . '">' . $row['hotel_id'] . '</option>';
                }
              } else {
                // Query returned no results, handle the situation
                echo '<option value="">No hotels found</option>';
              }

              // Close the database connection
              $conn->close();
              ?>
            </select>
          </div>
          <div class="button-container">
            <button type="submit">Create Room</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Popup form for update room -->
    <div class="popup-overlay" id="update-room-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Update Room</h2>
        <form id="update-room-form" method="POST">
          <div class="input-group">
            <label for="room-id">Room ID:</label>
            <input type="number" id="room-id" name="room-id" placeholder="Enter existing room ID" required>
          </div>
          <div class="input-group">
            <label for="new-room-number">Room Number:</label>
            <input type="number" id="new-room-number" name="new-room-number" placeholder="Enter new room number" required>
          </div>
          <div class="form-group">
            <label for="new-room-img-link">Image URL:</label>
            <input type="url" id="new-room-img-link" name="new-room-img-link" placeholder="Enter room image URL" required />
          </div>

          <div class="form-group">
            <label for="new-room-description">Room Description:</label>
            <textarea  type="text" id="new-room-description" name="new-room-description" required ></textarea>
          </div>

          <div class="form-group">
            <label for="new-room-type">Type:</label>
            <select id="new-room-type" name="new-room-type" required>
              <option value="Standard">Standard</option>
              <option value="Deluxe">Deluxe</option>
              <option value="Suite">Suite</option>
              <option value="Penthouse">Penthouse</option>
            </select>
          </div>
          <div class="input-group">
            <label for="new-price">Price:</label>
            <input type="number" id="new-price" name="new-price" placeholder="Enter new price" required>
          </div>
          <div class="input-group">
            <label for="new-status">Status:</label>
            <select id="new-status" name="new-status" required>
              <option value="Available">Available</option>
              <option value="Booked">Booked</option>
              <option value="Out of service">Out of service</option>
            </select>
          </div>
          <div class="input-group">
            <label for="room-hotel">New Hotel ID:</label>
            <select id="room-hotel" name="room-hotel" required>
              <?php
              // Database connection
              include("../../accounts/db.php");

              $sql = "SELECT hotel_id, name FROM Hotel";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // Loop through the result set and generate <option> elements
                while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['hotel_id'] . '">' . $row['hotel_id'] . '</option>';
                }
              } else {
                // Query returned no results, handle the situation
                echo '<option value="">No hotels found</option>';
              }

              // Close the database connection
              $conn->close();
              ?>
            </select>
          </div>
          <div class="button-container">
            <button type="submit">Update Room</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Popup form for delete room -->
    <div class="popup-overlay" id="delete-room-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Delete Room</h2>
        <form id="delete-room-form" method="POST">
          <label for="delete-room-id">Room ID:</label>
          <input type="number" id="delete-room-id" name="room-id" placeholder="Enter existing room ID" required>
          <div class="button-container">
            <button type="submit">Delete Room</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../../scripts/admin.js" type="module"></script>
</body>

</html>