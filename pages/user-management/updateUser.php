<!-- THIS FILE IS FETCHING TO DATABASE TO UPDATE USERS -->
<?php
// if the logged in role is not admin , return to login page
if ($_SESSION['role'] !== 'admin') {
  header("location: ../../login/login.html");
  exit();
}
// include the database connection and function to sanitize inputs from user
include("../../accounts/db.php");
include('../../accounts/sanitize-data.php');

// updating user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data and sanitize
  $user_id = sanitize_data($_POST['user-id-update']);
  $username = sanitize_data($_POST['update-username']);
  $email = sanitize_data($_POST['update-email']);
  $full_name = sanitize_data($_POST['update-name']);
  $role = sanitize_data($_POST['update-role']);

  // Check if user ID exists
  $check_sql = "SELECT * FROM Users WHERE user_id = ?";
  $check_stmt = $conn->prepare($check_sql);
  if ($check_stmt === false) {
    die("Error preparing statement: " . $conn->error);
  }

  $check_stmt->bind_param("i", $user_id);
  $check_stmt->execute();
  $result = $check_stmt->get_result();

  if ($result->num_rows > 0) {
    // User ID exists, proceed with update
    $update_sql = "UPDATE Users SET username = ?, email = ?, full_name = ?, role = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    if ($update_stmt === false) {
      die("Error preparing statement: " . $conn->error);
    }

    $update_stmt->bind_param("ssssi", $username, $email, $full_name, $role, $user_id);

    // if query update successfully
    if ($update_stmt->execute() === TRUE) {
      echo "User updated successfully!";
    } else {
      echo "Error updating user or User ID does not exist.";
    }
    // close the statement
    $update_stmt->close();
  } else {
    echo "Error: User ID does not exist.";
  }

  // Close statement and database connection
  $check_stmt->close();
  $conn->close();
}
