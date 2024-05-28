<?php

// This file is getting information in rooms table in database and display it dynamically (onchange) on customer.js (formAjax function)
// For example when booking a room, user will select which hotel they want to book and what room. every change of the options in hotel the room will change dynamically base on the hotel user selected

// include db connection
include("./db.php");

// for dynamic option select
$hotel_id = intval($_GET['hotel_id']);
$sql = "SELECT room_id, room_number, type, price, status FROM Rooms WHERE hotel_id = $hotel_id";
$result = $conn->query($sql);

if ($result === false) {
    $response = array('error' => 'Query error: ' . $conn->error);
    echo json_encode($response);
    exit();
}

$rooms = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
}

echo json_encode($rooms);
$conn->close();
?>
