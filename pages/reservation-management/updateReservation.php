<?php
include("../../accounts/db.php");
include("../../accounts/sanitize-data.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize and validate form data
  $reservationId = sanitize_data($_POST['reservation-id']);
  $newCheckIn = sanitize_data($_POST['new-check-in']);
  $newCheckOut = sanitize_data($_POST['new-check-out']);

  // Check if all variables are correctly sanitized
  if (!$reservationId || !$newCheckIn || !$newCheckOut) {
    echo "Error: Invalid input data.";
    exit;
  }

  try {
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM Reservations WHERE reservation_id=?");
    if ($stmt === false) {
      throw new Exception('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("i", $reservationId); // Corrected variable name
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      // Reservation ID exists, proceed with the update operation
      $stmt = $conn->prepare("UPDATE Reservations SET check_in=?, check_out=? WHERE reservation_id=?");
      if ($stmt === false) {
        throw new Exception('Prepare failed: ' . $conn->error);
      }

      $stmt->bind_param("ssi", $newCheckIn, $newCheckOut, $reservationId); // Corrected binding parameters

      if ($stmt->execute()) {
        echo "Reservation updated successfully!";
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
