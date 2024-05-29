<?php
// THIS FILE WILL FETCH TO DATABASE TO DELETE RESERVATION IN DATABASE
// include db connection and function to sanitize data
include("../../accounts/db.php");
include("../../accounts/sanitize-data.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize and validate form data
  $reservationId = sanitize_data($_POST['reservation-id']);
  // Check if reservation ID is correctly sanitized
  if (!$reservationId) {
    echo "Error: Invalid input data.";
    exit;
  }

  try {
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM Reservations WHERE reservation_id=?");
    if ($stmt === false) {
      throw new Exception('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("i", $reservationId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      // Reservation ID exists, proceed with the delete operation
      $stmt = $conn->prepare("DELETE FROM Reservations WHERE reservation_id=?");
      if ($stmt === false) {
        throw new Exception('Prepare failed: ' . $conn->error);
      }

      $stmt->bind_param("i", $reservationId);

      if ($stmt->execute()) {
        echo "Reservation cancelled successfully!";
      } else {
        throw new Exception('Execute failed: ' . $stmt->error);
      }
    } else {
      // Reservation ID does not exist
      echo "Reservation ID does not exist.";
    }
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }

  $stmt->close();
  $conn->close();
}
