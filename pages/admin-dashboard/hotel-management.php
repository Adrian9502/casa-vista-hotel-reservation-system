<!DOCTYPE html>
<html lang="en">

<head>
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
        <h2 class="section-heading">Hotel Management</h2>
        <div class="crud-btn">

          <button class="crud-button" id="add-hotel-btn">
            <i class='fas fa-plus icon-btn'>
              <span>
                &#160;Create
              </span>
            </i>
          </button>
          <button class="crud-button" id="update-hotel-btn">
            <i class='fas fa-edit icon-btn'>
              <span>&#160;Update</span>
            </i>
          </button>
          <button class="crud-button" id="delete-hotel-btn">
            <i class='fas fa-times icon-btn'>
              <span>&#160;Delete</span>
            </i>
          </button>
        </div>
      </div>
      <div class="input-con">
        <input type="text" id="search" placeholder="Search Hotel by ID">
        <button class="search-btn search-btn-hotel" id="search-btn">Search</button>
      </div>
      <?php
      // Establish database connection
      include('../../accounts/db.php');

      // Retrieve data from the Hotel table
      $sql = "SELECT * FROM Hotel";
      $result = $conn->query($sql);

      // Close database connection
      $conn->close();
      ?>

      <div class="table-container">
        <table id="hotel-table">
          <thead>
            <tr>
              <th>Hotel ID</th>
              <th>Image</th>
              <th>Hotel Name</th>
              <th>Location</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                  <td><?php echo $row["hotel_id"]; ?></td>
                  <td class="db-img">
                    <img class="data-image" src="<?php echo $row["img_link"]; ?>" alt="">
                  </td>
                  <td><?php echo $row["name"]; ?></td>
                  <td><?php echo $row["location"]; ?></td>
                  <td class="description"><?php echo $row["description"]; ?></td>
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
    <!-- Popup form for add hotel -->
    <div class="popup-overlay" id="create-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Create New Hotel</h2>
        <form id="add-hotel-form" method="POST">
          <div class="form-group">
            <label for="hotel-name">Hotel Name:</label>
            <input type="text" id="hotel-name" name="hotel-name" placeholder="Enter new hotel name" required />
          </div>

          <div class="form-group">
            <label for="hotel-img-link">Image URL:</label>
            <input type="url" id="hotel-img-link" name="hotel-img-link" placeholder="Enter hotel image URL" required />
          </div>
          <div class="form-group">
            <label for="hotel-location">Location:</label>
            <input type="text" id="hotel-location" placeholder="Enter new hotel location" name="hotel-location" required />
          </div>

          <div class="form-group">
            <label for="hotel-description">Description:</label>
            <textarea id="hotel-description" name="hotel-description" placeholder="Enter hotel description" required style="resize: none;"></textarea>
          </div>
          <div class="button-container">
            <button type="submit">Add Hotel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Popup form for update hotel -->
    <div class="popup-overlay" id="update-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Update Hotel</h2>
        <form id="update-hotel-form" method="POST">
          <div class="form-group">
            <label for="hotel-id-update">Hotel ID:</label>
            <input type="number" id="hotel-id-update" name="update-hotel-id" placeholder="Enter existing hotel ID" required />
          </div>
          <div class="form-group">
            <label for="new-name">New Hotel Name:</label>
            <input type="text" id="new-name" name="new-name" placeholder="Enter new hotel name" required />
          </div>
          <div class="form-group">
            <label for="new-hotel-img-link">New Image URL:</label>
            <input type="url" id="new-hotel-img-link" name="new-hotel-img-link" placeholder="Enter new hotel image URL" required />
          </div>
          <div class="form-group">
            <label for="new-location">New Location:</label>
            <input type="text" id="new-location" name="new-location" placeholder="Enter new location" required />
          </div>
          <div class="form-group">
            <label for="new-description">New Description:</label>
            <input type="text" id="new-description" name="new-description" placeholder="Enter new description" required />
          </div>
          <div class="button-container">
            <button type="submit">Update Hotel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Popup form for delete hotel -->
    <div class="popup-overlay" id="delete-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Delete Hotel</h2>
        <form id="delete-hotel-form" method="POST">
          <div class="input-group">
            <label for="delete-hotel-id">Hotel ID:</label>
            <input type="number" id="delete-hotel-id" name="delete-hotel-id" placeholder="Enter existing hotel ID to delete" required>
          </div>
          <div class="button-container">
            <button type="submit">Delete Hotel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../../scripts/admin.js" type="module"></script>
</body>

</html>