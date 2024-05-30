<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  session_start();
  // Check if the user is logged in
  if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.html");
    exit();
  }
  // sanitize
  include ("./sanitize-data.php");
  // Connect to your database
  include("./db.php"); // Adjust the path if needed
  // Retrieve data sent from the client-side (JavaScript)
  $username = $_POST['username'];
  $rating = $_POST['rating'];
  
  $description = sanitize_data($_POST['description']);

  // Prepare and execute the SQL query to insert feedback into the database
  $sql = "INSERT INTO feedback (username, rating, feedback) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sis", $username, $rating, $description);

  // Execute the query
  if ($stmt->execute()) {
    echo "Feedback submitted successfully";
  } else {
    echo "Failed to submit feedback";
  }

  // Close the database connection
  $stmt->close();
  $conn->close();
}
