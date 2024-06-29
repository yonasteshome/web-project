<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
  /* CSS styles for the form */
  form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-family: Arial, sans-serif;
  }

  label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
  }

  input[type="text"],
  input[type="date"],
  input[type="number"],
  select,
  textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
  }

  input[type="checkbox"] {
    margin-top: 6px;
    margin-bottom: 16px;
  }

  button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

  button[type="submit"]:hover {
    background-color: #45a049;
  }

    </style>
</head>
<body>
<form action="form_event_creation.php" method="POST">
  <label for="event-name">Event Name:</label>
  <input type="text" id="event-name" name="event-name" required>

  <label for="event-title">Event Title:</label>
  <input type="text" id="event-title" name="event-title" required>

  <label for="event-category">Event Category:</label>
  <select id="event-category" name="event-category" required>
    <option value="">Select Category</option>
    <option value="sport">Sport</option>
    <option value="music">Music</option>
    <option value="show">Show</option>
  </select>

  <label for="event-date">Event Date:</label>
  <input type="date" id="event-date" name="event-date" required>

  <label for="event-venue">Event Venue:</label>
  <input type="text" id="event-venue" name="event-venue" required>

  <label for="available-seats">Available Seats:</label>
  <input type="number" id="available-seats" name="available-seats" required>

  <label for="vip-status">VIP Status:</label>
  <input type="checkbox" id="vip-status" name="vip-status">

  <label for="event-description">Event Description:</label>
  <textarea id="event-description" name="event-description" required></textarea>

  <button type="submit">Create Event</button>
</form>
<?php
// ...

// Retrieve the form data
$eventName = $_POST['event-name'];
$eventTitle = $_POST['event-title'];
$eventCategory = $_POST['event-category'];
$eventDate = $_POST['event-date'];
$eventVenue = $_POST['event-venue'];
$availableSeats = $_POST['available-seats'];
$vipStatus = isset($_POST['vip-status']) ? 1 : 0;
$eventDescription = $_POST['event-description'];

// ...

// Map the selected category value to the desired string
$categories = array(
    'sport' => 'Sport',
    'music' => 'Music',
    'show' => 'Show'
  );
  
  if (isset($categories[$eventCategory])) {
    $eventCategory = $categories[$eventCategory];
  } else {
    $eventCategory = 'Unknown';
  }
  
  // ...

if (isset($categories[$eventCategory])) {
  $eventCategory = $categories[$eventCategory];
} else {
  $eventCategory = 'Unknown';
}

// ...
// Create a new MySQLi instance (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event-management-system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// ...

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO `event-creation-form` (name, title, category, date, venue, seats, status, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// Bind the parameters
$stmt->bind_param("ssssssis", $eventName, $eventTitle, $eventCategory, $eventDate, $eventVenue, $availableSeats, $vipStatus, $eventDescription);

// ...
// Execute the statement
if ($stmt->execute()) {
  // Display a success message
  echo "Event created successfully!";
} else {
  // Display an error message
  echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
</body>
</html>
