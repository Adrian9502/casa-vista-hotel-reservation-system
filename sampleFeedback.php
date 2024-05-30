<?php
session_start();
include('./accounts/db.php');

// Fetch feedback for a specific hotel or all feedback
$query = "SELECT Feedback.rating, Feedback.feedback, Users.username, Feedback.created_at
          FROM Feedback
          INNER JOIN Users ON Feedback.user_id = Users.user_id";

$result = $conn->query($query);

$feedbacks = [];
while ($row = $result->fetch_assoc()) {
    $feedbacks[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback Form</title>
  <style>
    body{
      font-family: Arial, Helvetica, sans-serif;
    }
    .feedback-wrapper{
      width: 80%;
      margin: auto;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .feedback-container {
      max-width: 700px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    }
    .feedback-item {
      padding: 15px;
      border-bottom: 1px solid #ddd;
    }
    .feedback-item:last-child {
      border-bottom: none;
    }
    .feedback-item strong {
      display: block;
      margin-bottom: 5px;
      font-size: 1.2em;
    }
    .feedback-item .rating {
      color: #FFD700;
    }
    .feedback-form h3 {
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }
    .feedback-form label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #555;
    }
    .feedback-form select,
    .feedback-form textarea,
    .feedback-form button {
      width: calc(100% - 22px);
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .feedback-form select:focus,
    .feedback-form textarea:focus,
    .feedback-form button:focus {
      outline: none;
      border-color: #4CAF50;
    }
    .feedback-form textarea {
      resize: none;
    }
    .feedback-form button {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
    .feedback-form button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

<div class="feedback-wrapper">
<div class="feedback-container">
  <h3>Guest Feedback</h3>
  <?php foreach ($feedbacks as $feedback): ?>
    <div class="feedback-item">
      <strong><?php echo htmlspecialchars($feedback['username']); ?></strong>
      <div class="rating">Rating: <?php echo str_repeat('★', $feedback['rating']); ?> (<?php echo $feedback['rating']; ?>)</div>
      <div class="feedback-text"><?php echo nl2br(htmlspecialchars($feedback['feedback'])); ?></div>
      <div class="feedback-time"><?php echo htmlspecialchars($feedback['created_at']); ?></div>
    </div>
  <?php endforeach; ?>
</div>

<div class="feedback-form">
  <h3>Rate Your Stay</h3>
  <form id="feedbackForm" method="POST" action="">
    <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
    <label for="rating">Rating (1-5):</label>
    <select name="rating" id="rating" required>
      <option value="1">★</option>
      <option value="2">★★</option>
      <option value="3">★★★</option>
      <option value="4">★★★★</option>
      <option value="5">★★★★★</option>
    </select>
    <br>
    <label for="feedback">Feedback:</label>
    <textarea name="feedback" id="feedback" rows="4" required></textarea>
    <br>
    <button type="submit">Submit Feedback</button>
  </form>
</div>
</div>

</body>
</html>
