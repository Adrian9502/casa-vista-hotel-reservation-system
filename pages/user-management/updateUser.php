<?php
//  THIS FILE IS FETCHING TO DATABASE TO UPDATE USERS 
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
      die("Error preparing update statement: " . $conn->error);
    }

    $update_stmt->bind_param("ssssi", $username, $email, $full_name, $role, $user_id);

    // Execute the update statement
    if ($update_stmt->execute() === TRUE) {
      echo "User updated successfully!";
    } else {
      // Echo only the error message
      echo "Error updating user: " . $update_stmt->error;
    }

    // Close the update statement
    $update_stmt->close();
  } else {
    echo "Error: User ID does not exist.";
  }

  // Close the check statement
  $check_stmt->close();
  // Close the database connection
  $conn->close();
} else {
  echo "Invalid request method.";
}
