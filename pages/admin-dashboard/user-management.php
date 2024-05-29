<!DOCTYPE html>
<!-- THIS FILE WILL FETCH TO DATABASE TO ADD A NEW HOTEL -->
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
        <h2 class="section-heading">User Management</h2>
        <div class="crud-btn">

          <button class="crud-button" id="add-user-btn">
            <i class='fas fa-plus icon-btn'>
              <span>
                &#160;Create
              </span>
            </i>
          </button>
          <button class="crud-button" id="update-user-btn">
            <i class='fas fa-edit icon-btn'>
              <span>&#160;Update</span>
            </i>
          </button>
          <button class="crud-button" id="delete-user-btn">
            <i class='fas fa-times icon-btn'>
              <span>&#160;Delete</span>
            </i>
          </button>
        </div>
      </div>

      <div class="input-con">
        <input type="text" id="search" placeholder="Search Hotel by ID">
        <button class="search-btn search-btn-user" id="search-btn">Search</button>
      </div>

      <?php
      include("../../accounts/db.php");

      $sql = "SELECT * FROM Users";
      $result = $conn->query($sql);
      $conn->close();
      ?>

      <div class="table-container">
        <table id="user-table">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>Full Name</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                  <td><?php echo $row["user_id"]; ?></td>
                  <td><?php echo $row["username"]; ?></td>
                  <td><?php echo $row["email"]; ?></td>
                  <td><?php echo $row["full_name"]; ?></td>
                  <td><?php echo $row["role"]; ?></td>
                </tr>
            <?php
              }
            } else {
              echo "<tr><td colspan='4' class='no-results'>No user found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Popup form for create user -->
    <div class="popup-overlay" id="create-user-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Create New User</h2>
        <form id="add-user-form" method="POST">
          <div class="form-group">
            <label for="new-username">Username:</label>
            <input type="text" id="new-username" name="new-username" placeholder="Enter username" required />
          </div>

          <div class="form-group">
            <label for="new-password">Password:</label>
            <input type="password" id="new-password" placeholder="Enter password" name="new-password" required />
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter full name" required>
          </div>
          <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
              <option value="customer">Customer</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="button-container">
            <button type="submit">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Popup form for update user -->
    <div class="popup-overlay" id="update-user-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Update User</h2>
        <form id="update-user-form" method="POST">
          <div class="form-group">
            <label for="user-id-update">User ID:</label>
            <input type="number" id="user-id-update" name="user-id-update" placeholder="Enter existing user ID" required />
          </div>

          <div class="form-group">
            <label for="update-username">New Username:</label>
            <input type="text" id="update-username" name="update-username" placeholder="Enter new username" required />
          </div>
          <div class="form-group">
            <label for="update-email">New Email:</label>
            <input type="email" id="update-email" name="update-email" placeholder="Enter new email" required />
          </div>
          <div class="form-group">
            <label for="update-name">New Full Name:</label>
            <input type="text" id="update-name" name="update-name" placeholder="Enter new full name" required />
          </div>
          <div class="form-group">
            <label for="update-role">New Role:</label>
            <select name="update-role" id="update-role">
              <option value="Customer">Customer</option>
              <option value="Admin">Admin</option>
            </select>
          </div>
          <div class="button-container">
            <button type="submit">Update User</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Popup form for delete user -->
    <div class="popup-overlay" id="delete-user-popup-overlay">
      <div class="popup fade-in-bck">
        <span class="close-btn" id="close-btn">&times;</span>
        <h2>Delete User</h2>
        <form id="delete-user-form" method="POST">
          <div class="input-group">
            <label for="delete-user-id">User ID:</label>
            <input type="number" id="delete-user-id" name="delete-user-id" placeholder="Enter existing User ID to delete" required>
          </div>
          <div class="button-container">
            <button type="submit">Delete User</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="module" src="../../scripts/admin.js"></script>
</body>

</html>