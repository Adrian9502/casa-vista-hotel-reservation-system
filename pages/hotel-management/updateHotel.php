
<?php
// THIS FILE WILL FETCH TO DATABASE TO UPDATE HOTEL
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // db connection and function to sanitize input
  include('../../accounts/db.php');
  include('../../accounts/sanitize-data.php');

  // Sanitize the data
  $hotelId = sanitize_data($_POST['update-hotel-id']);
  $newName = sanitize_data($_POST['new-name']);
  $newImgLink = sanitize_data($_POST['new-hotel-img-link']);
  $newLocation = sanitize_data($_POST['new-location']);
  $newDescription = sanitize_data($_POST['new-description']);

  // Use prepared statements to prevent SQL injection
  // run the query to check if the hotel id existed
  $stmt = $conn->prepare("SELECT * FROM Hotel WHERE hotel_id=?");
  $stmt->bind_param("i", $hotelId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Hotel ID exists, proceed with the update operation
    $stmt = $conn->prepare("UPDATE Hotel SET name=?, img_link=?, location=?, description=? WHERE hotel_id=?");
    $stmt->bind_param("ssssi", $newName, $newImgLink, $newLocation, $newDescription, $hotelId);

    if ($stmt->execute()) {
      echo "Hotel updated successfully!";
    } else {
      echo "Error updating hotel!";
    }
  } else {
    // Hotel ID does not exist in the database
    echo "Hotel ID does not exist in the database. Please enter a valid ID.";
  }

  // Close statement
  $stmt->close();
}

// Close database connection
$conn->close();
