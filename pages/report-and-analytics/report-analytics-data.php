<?php
// THIS FILE WILL FETCH TO DATABASE TO GET THE OCCUPANCY RATES, BOOKING TRENDS, TOTAL RESERVATION AND TOTAL REVENUE (Financial reports) 

// include db connection
include('../../accounts/db.php');

// Fetch total reservations
$result = $conn->query("SELECT COUNT(*) AS total_reservations FROM Reservations");
if ($result === false) {
  echo "Error: " . $conn->error;
  exit;
}
$totalReservations = $result->fetch_assoc()['total_reservations'];

// Fetch total revenue
$result = $conn->query("SELECT SUM(Rooms.price) AS total_revenue FROM Reservations JOIN Rooms ON Reservations.room_id = Rooms.room_id");
if ($result === false) {
  echo "Error: " . $conn->error;
  exit;
}
$totalRevenue = $result->fetch_assoc()['total_revenue'];

// Fetch occupancy rates
$result = $conn->query("SELECT Hotel.name, COUNT(Reservations.reservation_id) AS total_bookings, COUNT(Reservations.reservation_id) * 100.0 / COUNT(Rooms.room_id) AS occupancy_rate FROM Hotel LEFT JOIN Rooms ON Hotel.hotel_id = Rooms.hotel_id LEFT JOIN Reservations ON Rooms.room_id = Reservations.room_id GROUP BY Hotel.name");
if ($result === false) {
  echo "Error: " . $conn->error;
  exit;
}
$occupancyRates = [];
while ($row = $result->fetch_assoc()) {
  $occupancyRates[] = $row;
}

// Fetch booking trends
$result = $conn->query("SELECT YEAR(check_in) AS year, MONTH(check_in) AS month, COUNT(*) AS total_bookings FROM Reservations GROUP BY YEAR(check_in), MONTH(check_in) ORDER BY YEAR(check_in), MONTH(check_in)");
if ($result === false) {
  echo "Error: " . $conn->error;
  exit;
}
$bookingTrends = [];
while ($row = $result->fetch_assoc()) {
  $bookingTrends[] = $row;
}

// Close the connection only after fetching all data
$conn->close();