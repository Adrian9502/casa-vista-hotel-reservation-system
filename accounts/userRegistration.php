<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // include database connection and function to sanitize user inputs
  include('../accounts/db.php');
  include('../accounts/sanitize-data.php');

  // Retrieve form data and sanitize
  $username = sanitize_data($_POST['new-username']);
  $input_password = sanitize_data($_POST['new-password']);
  // hash the user password 
  $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);
  $email = sanitize_data($_POST['email']);
  $full_name = sanitize_data($_POST['name']);
  $role = sanitize_data($_POST['role']);

  // Prepare and execute SQL statement to insert data into the database
  $sql = "INSERT INTO Users (username, password, email, full_name, role) VALUES (?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
  }

  $stmt->bind_param("sssss", $username, $hashed_password, $email, $full_name, $role);
  // if insertion is successful
  if ($stmt->execute() === TRUE) {
    echo "New User added successfully!";
    exit();
  } else {
    echo "Error adding new user, ". $stmt->error;
  }

  // Close statement and database connection
  $stmt->close();
  $conn->close();
}
?>
