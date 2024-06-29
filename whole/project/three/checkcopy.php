<!DOCTYPE html>
<html>
<head>
  <title>Event Management System</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }
    
    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .container h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    
    .form-group textarea {
      height: 100px;
    }
    
    .form-group input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      cursor: pointer;
    }
    
    .form-group input[type="submit"]:hover {
      background-color: #45a049;
    }
    
  </style>
</head>
<body>
  <div class="container">
    <h1>Create Event</h1>
    <form action="check.php" method="POST">
      <div class="form-group">
        <label for="organization_name">Organization Name:</label>
        <input type="text" id="organization_name" name="organization_name" required>
      </div>
      <div class="form-group">
        <label for="event_title">Event Title:</label>
        <input type="text" id="event_title" name="event_title" required>
      </div>
      <div class="form-group">
        <label for="event_date">Date:</label>
        <input type="date" id="event_date" name="event_date" required>
      </div>
      <div class="form-group">
        <label for="event_time">Time:</label>
        <input type="time" id="event_time" name="event_time" required>
      </div>
      <div class="form-group">
        <label for="venue">Venue:</label>
        <input type="text" id="venue" name="venue" required>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" min="0" required>
      </div>
      <div class="form-group">
        <label for="available_tickets">Available Tickets:</label>
        <input type="number" id="available_tickets" name="available_tickets" min="0" required>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <select id="category" name="category" required>
          <option value="">Select a category</option>
          <option value="show">Show</option>
          <option value="music">Music</option>
          <option value="sport">Sport</option>
        </select>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
      </div>
      <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" id="photo1" name="photo" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Create Event">
      </div>
    </form>
    <?php
// Retrieve form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if all required form fields are set
  if (isset($_POST['organization_name'], $_POST['event_title'], $_POST['event_date'], $_POST['event_time'],
           $_POST['venue'], $_POST['price'], $_POST['available_tickets'], $_POST['category'], $_POST['description'])) {
      $organization_name = $_POST['organization_name'];
      $event_title = $_POST['event_title'];
      $event_date = $_POST['event_date'];
      $event_time = $_POST['event_time'];
      $venue = $_POST['venue'];
      $price = $_POST['price'];
      $available_tickets = $_POST['available_tickets'];
      $category = $_POST['category'];
      $description = $_POST['description'];

      // Handle file upload
      if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
          $image = $_FILES['photo']['name'];
          $imageData = $_FILES['photo']['tmp_name'];
          $image_destination = "img/" . $image;
          if (move_uploaded_file($imageData, $image_destination)) {
              // Database connection
              $host = 'localhost';
              $dbname = 'event';
              $username = 'root';
              $password = '';

              // Create a new MySQLi object
              $mysqli = new mysqli($host, $username, $password, $dbname);

              // Check for connection errors
              if ($mysqli->connect_errno) {
                  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                  exit();
              }

              // Prepare the INSERT statement
              $query = "INSERT INTO store (name, title, date, time, venue, price, tickets, category, description, [image])
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $stmt = $mysqli->prepare($query);

              // Bind the parameters and execute the statement
            // Bind the parameters and execute the statement
$stmt->bind_param("sssssdissb", $organization_name, $event_title, $event_date, $event_time, $venue, $price, $available_tickets, $category, $description, $image);
$stmt->execute();
              // Close the statement and the database connection
              $stmt->close();
              $mysqli->close();

              echo "Event data saved successfully.";
          } else {
              echo 'Error uploading image.';
              
          }
      } else {
          echo 'No image uploaded.';
          
      }
  } else {
      echo 'Please fill in all required fields.';
  }
}
?>
  </div>
</body>
</html>