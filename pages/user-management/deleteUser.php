<?php
include("../../accounts/db.php");
include("../../accounts/sanitize-data.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Get and validate form data
	$userId = sanitize_data($_POST['delete-user-id']);

	$conn = new mysqli($servername, $username, $password, $dbname);

	$stmt = $conn->prepare("SELECT * FROM Users WHERE user_id=?");
	$stmt->bind_param("i", $userId);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		// Room ID exists, proceed with the deletion operation
		$stmt = $conn->prepare("DELETE FROM Users WHERE user_id=?");
		$stmt->bind_param("i", $userId);

		if ($stmt->execute()) {
			// Check the number of affected rows
			if ($stmt->affected_rows > 0) {
				echo "User deleted successfully!";
			} else {
				echo "Error deleting user or User ID does not exist.";
			}
		} else {
			// Error executing the deletion query
			echo "Error deleting user or User ID does not exist.";
		}
	} else {
		echo "Error deleting user or User ID does not exist.";
	}
	$stmt->close();
	$conn->close();
}
?>




<script type="module" src="../../scripts/admin.js"></script>

</body>

</html>