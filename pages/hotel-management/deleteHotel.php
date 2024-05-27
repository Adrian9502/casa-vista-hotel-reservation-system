<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include ('../../accounts/db.php'); 
  include('../../accounts/sanitize-data.php');
  $hotelId = sanitize_data($_POST['delete-hotel-id']);

  // Begin a transaction
  $conn->begin_transaction();

  // Delete rooms associated with the hotel
  $stmt_delete_rooms = $conn->prepare("DELETE FROM rooms WHERE hotel_id=?");
  $stmt_delete_rooms->bind_param("i", $hotelId);
  $stmt_delete_rooms->execute();
  $num_deleted_rooms = $stmt_delete_rooms->affected_rows;
  $stmt_delete_rooms->close();

  // Delete the hotel record
  $stmt_delete_hotel = $conn->prepare("DELETE FROM Hotel WHERE hotel_id=?");
  $stmt_delete_hotel->bind_param("i", $hotelId);
  $stmt_delete_hotel->execute();
  $num_deleted_hotel = $stmt_delete_hotel->affected_rows;
  $stmt_delete_hotel->close();

  // Commit the transaction
  $conn->commit();

  if ($num_deleted_hotel > 0 && $num_deleted_rooms > 0) {
    // Both hotel and rooms deleted successfully
    echo "Hotel and associated rooms deleted successfully!";
  } elseif ($num_deleted_hotel > 0 && $num_deleted_rooms == 0) {
    // Hotel deleted but no associated rooms found
    echo "Hotel and associated rooms deleted successfully!";
  } else {
    // Error deleting hotel or no matching hotel found
    echo "Error deleting hotel or no matching hotel found.";
  }

  $conn->close();
  exit;
}
