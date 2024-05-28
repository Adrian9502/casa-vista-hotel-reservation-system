<?php
session_start();

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Connect to MySQL database
  include("./db.php");

  // Retrieve form data
  $input_username = mysqli_real_escape_string($conn, $_POST['username']);
  $input_password = mysqli_real_escape_string($conn, $_POST['password']);

  // Prepare and execute SQL statement to fetch user from the database
  $sql = "SELECT * FROM Users WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $input_username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify password
    if (password_verify($input_password, $row['password'])) {
      // Password is correct, set session variables
      $_SESSION['username'] = $input_username;
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['role'] = $row['role'];
      // Set success message in response
      $response['success'] = true;
      $response['role'] = $row['role']; // Add role to response
    } else {
      // Password is incorrect
      $response['error'] = "Incorrect Password, Please Try again";
    }
  } else {
    // Username not found
    $response['error'] = "Username not found. Please try again or sign up.";
  }

  // Close database connection
  $conn->close();
  echo json_encode($response);
}
