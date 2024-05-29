<?php
// THIS FILE WILL FETCH TO DATABASE TO ADD A NEW HOTEL
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // function to sanitize user input
  include('../../accounts/sanitize-data.php');

  // Validate and sanitize form data
  $hotel_name = sanitize_data($_POST['hotel-name']);
  $hotel_img = sanitize_data($_POST['hotel-img-link']);
  $hotel_location = sanitize_data($_POST['hotel-location']);
  $hotel_description = sanitize_data($_POST['hotel-description']);

  // Validate the URL
  if (filter_var($hotel_img, FILTER_VALIDATE_URL)) {
    // Sanitize the URL
    $sanitized_url = filter_var($hotel_img, FILTER_SANITIZE_URL);

    // Validate input data
    if (empty($hotel_name) || empty($hotel_location) || empty($hotel_description) || empty($sanitized_url)) {
      echo "Please fill in all fields.";
    } else {
      // Database connection
      include('../../accounts/db.php');

      // Prepare the SQL statement
      $sql = "INSERT INTO Hotel (name, img_link, location, description) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $hotel_name, $sanitized_url, $hotel_location, $hotel_description);

      // Execute the statement and check for success
      if ($stmt->execute()) {
        echo "Hotel added successfully!";
      } else {
        echo "Error adding hotel: " . $stmt->error;
      }

      // Close statement and database connection
      $stmt->close();
      $conn->close();
    }
  } else {
    echo "Invalid URL format.";
  }
} else {
  echo "Invalid request method.";
}
