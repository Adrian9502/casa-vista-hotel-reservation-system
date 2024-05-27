<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate and sanitize form data
  include("../../accounts/sanitize-data.php");
  $room_number = sanitize_data($_POST['room-number']);
  // no need to sanitize because its <option>
  $room_type = $_POST['room-type']; 
  $room_status = $_POST['room-status'];
  $room_price = sanitize_data($_POST['room-price']);
  $room_hotel = sanitize_data($_POST['room-hotel']);
  $room_img_link = $_POST['room-img-link']; 

  include("../../accounts/db.php");

  if (filter_var($room_img_link, FILTER_VALIDATE_URL)) {
    $sanitized_url = filter_var($room_img_link, FILTER_SANITIZE_URL); // Sanitize room image URL

    // Check if all variables are correctly sanitized
    if (!$room_number || !$room_type || !$room_price || !$room_status || !$room_hotel || !$room_img_link) {
      echo "Error: Invalid input data.";
      exit;
    }

    try {
      // Prepare and execute SQL statement with parameterized query
      $sql = "INSERT INTO Rooms (room_number, img_link, type, price, status, hotel_id)
              VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);

      if ($stmt === false) {
        throw new Exception('Prepare failed: ' . $conn->error);
      }

      // Bind parameters
      $stmt->bind_param("issisi", $room_number, $room_img_link, $room_type, $room_price, $room_status, $room_hotel);

      if ($stmt->execute()) {
        echo "Room added successfully!";
      } else {
        throw new Exception('Execute failed: ' . $stmt->error);
      }
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
  } else {
    echo "Error: Invalid image URL.";
  }
}
?>
