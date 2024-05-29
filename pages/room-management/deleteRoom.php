<?php
// THIS FILE WILL FETCH TO DATABASE TO DELETE A ROOM IN DATABASE 
// include db connection and function to sanitize the user input
  include("../../accounts/db.php");
  include("../../accounts/sanitize-data.php");

  // Check if form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and validate form data
    $roomId = sanitize_data($_POST['room-id']);

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM Rooms WHERE room_id=?");
    $stmt->bind_param("i", $roomId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      // Room ID exists, proceed with the deletion operation
      $stmt = $conn->prepare("DELETE FROM Rooms WHERE room_id=?");
      $stmt->bind_param("i", $roomId);

      if ($stmt->execute()) {
        // Check the number of affected rows
        if ($stmt->affected_rows > 0) {
          // Room deleted successfully
          echo "Room deleted successfully!";
        } else {
          // No room was deleted (room ID does not exist)
          echo "Room ID does not exist.";
        }
      } else {
        // Error executing the deletion query
        echo "Error deleting room or no matching room ID found.";
      }
    } else {
      // Room ID does not exist
      echo "Room ID does not exist.";
    }
    $stmt->close();
    $conn->close();
  }
  ?>