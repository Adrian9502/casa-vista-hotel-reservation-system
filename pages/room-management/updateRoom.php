<?php
// THIS FILE WILL FETCH TO DATABASE TO UPDATE A ROOM IN DATABASE 
include("../../accounts/db.php");
include("../../accounts/sanitize-data.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize and validate form data
  $roomId = sanitize_data($_POST['room-id']);
  $newRoomNumber = sanitize_data($_POST['new-room-number']);
  $newPrice = sanitize_data($_POST['new-price']);
  $newImg = sanitize_data($_POST['new-room-img-link']);
  $newDesc = sanitize_data($_POST['new-room-description']);
  // no need to sanitize because this is <option> and not directly user input
  $newType = $_POST['new-room-type'];
  $newStatus = $_POST['new-status'];
  $newHotelId = $_POST['room-hotel'];

  // Check if all variables are correctly sanitized
  if (!$roomId || !$newRoomNumber || !$newPrice || !$newStatus || !$newHotelId || !$newType || !$newImg || !$newDesc) {
    echo "Error: Invalid input data.";
    exit;
  }
  try {
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM Rooms WHERE room_id=?");
    if ($stmt === false) {
      throw new Exception('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("i", $roomId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      // Room ID exists, proceed with the update operation
      $stmt = $conn->prepare("UPDATE Rooms SET room_number=?, description=?, img_link=?, type=?, price=?, status=?, hotel_id=? WHERE room_id=?");
      if ($stmt === false) {
        throw new Exception('Prepare failed: ' . $conn->error);
      }

      $stmt->bind_param("isssisii", $newRoomNumber,$newDesc, $newImg, $newType, $newPrice,   $newStatus, $newHotelId, $roomId);

      if ($stmt->execute()) {
        echo "Room updated successfully!";
      } else {
        throw new Exception('Execute failed: ' . $stmt->error);
      }
    } else {
      // Room ID does not exist
      echo "Room ID does not exist.";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
}
