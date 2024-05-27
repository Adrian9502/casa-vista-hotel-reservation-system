<?php
include("../../accounts/db.php");

$sql = "SELECT Reservations.reservation_id, Users.full_name, Rooms.room_number, Reservations.check_in, Reservations.check_out
        FROM Reservations 
        JOIN Users ON Reservations.user_id = Users.user_id 
        JOIN Rooms ON Reservations.room_id = Rooms.room_id";
$result = $conn->query($sql);
if ($result === false) {
  echo "Error: " . $conn->error;
  exit;
}

$reservations = array();
while ($row = $result->fetch_assoc()) {
  $reservations[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .reservation-management {
      margin: 20px;
      height: 95%;
    }

    .search-btn {
      padding: 10px 15px;
      border: none;
      background-color: orange;
      color: white;
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
      transition: background-color 0.15s ease;
      cursor: pointer;
    }
    .search-btn:hover{
      background-color: #FF8C00;
    }
    .reservation-text {
      font-size: 35px;
      color: orange;
    }

    .input-con {
      margin-bottom: 20px;
      margin-top: 20px;
      width: 100%;
      display: flex;
    }
    #search{
      padding: 8px;
      border-top-left-radius: 10px;
      border-bottom-left-radius: 10px;
      width: 100%;
      border: none;
    }

    #reservation-table {
      width: 100%;
      border-collapse: collapse;
      text-align: center;
    }

    #reservation-table th,
    #reservation-table td {
      border: 1px solid #ddd;
      background-color: #f8f0f0;
      padding: 8px;
    }

    #reservation-table th {
      background-color: #f2f2f2;
      text-align: center;
    }
    .back-button {
      padding: 10px;
      border-radius: 7px;
      border: none;
      background-color: orange;
      color: white;
      transition: background-color .15s ease;
      cursor: pointer;
    }

    .back-button:hover {
      background-color: rgb(278, 176, 41);
    }
    .title-con{
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  </style>
</head>

<body>
  <div class="reservation-management">
    <div class="title-con">
    <h2 class="reservation-text">View Reservation </h2>
    <button id="reservation-back-button" class="back-button">Back</button>
    </div>
    <div class="input-con">
      <input type="text" id="search" placeholder="Search Reservations by ID">
      <button  class="search-btn">Search</button>
    </div>
    <table id="reservation-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Room Number</th>
          <th>Check-in</th>
          <th>Check-out</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($reservations)) : ?>
          <?php foreach ($reservations as $reservation) : ?>
            <tr>
              <td><?php echo $reservation['reservation_id']; ?></td>
              <td><?php echo $reservation['full_name']; ?></td>
              <td><?php echo $reservation['room_number']; ?></td>
              <td><?php echo $reservation['check_in']; ?></td>
              <td><?php echo $reservation['check_out']; ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="5" class="no-results">No reservations found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <script src="../../scripts/admin.js" type="module">
    
  </script>
</body>

</html>

<?php
// Close database connection
$conn->close();
?>