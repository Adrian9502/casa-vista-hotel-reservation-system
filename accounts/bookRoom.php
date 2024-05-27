<?php
session_start();

include("./db.php");

// Get form data from POST request
if(isset($_POST['user_id']) && isset($_POST['room_id']) && isset($_POST['check_in']) && isset($_POST['check_out'])) {
  $user_id = $_POST['user_id'];
  $room_id = $_POST['room_id'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];

  // Debugging output
  echo "Received data: user_id = $user_id, room_id = $room_id, check_in = $check_in, check_out = $check_out";

  // Insert form data into database using prepared statements
  $sql = "INSERT INTO Reservations (user_id, room_id, check_in, check_out) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iiss", $user_id, $room_id, $check_in, $check_out);

  if ($stmt->execute()) {
    echo "Room Booking Successful!";
  } else {
    echo "Error saving form: " . $conn->error;
  }
} else {
  echo "Missing form data";
}

$conn->close();
?>
