<!DOCTYPE html>
<html lang="en">
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";
$message="";
$status="";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['TotalValue'])){
$tickets=$_GET['TotalValue'];
$TotAmt=$_GET['eid'];
$sql = "UPDATE store SET tickets = $tickets WHERE id = $TotAmt;";
$result = $conn->query($sql);
if ($result) {
  // echo "Success";
  $status="good";
}else{
  $status="bad";
}}

?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>front</title>
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./style.css">
  <style>
    body {
      padding: 0;
      padding-left: 6%;
      padding-right: 6%;
      margin: 0;
      box-shadow: 0;
      background-color: black;
    }

    ::placeholder {
      color: wheat;
      font-size: 0.9rem;

    }

    #search {
      width: 350px;
      background: transparent;
      border-radius: 20px;
      border: 1px solid white;
      height: 30px;
      margin-top: 17px;
      padding: 10px 10px 15px 10px;
      color: white;
      font-size: 0.93rem;
      text-decoration: none;

    }

    /* footer */
    .one a {
      color: darkgray;
      font-size: 15px;
      margin-bottom: 5px;
    }

    footer {
      display: flex;
      justify-content: space-between;
    }

    .footer {
      width: 100%;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      margin-bottom: 60px;
    }

    .row {
      display: inline;
    }

    .footer a {
      color: darkgray;
      font-size: 15px;
    }

    #first-row a {
      text-decoration: none;
    }

    #privacy {
      text-decoration: none;

    }

    #second-row {
      margin-bottom: 30px;
    }

    /* lela footer */
    hr {
      color: aliceblue;
      margin-top: 140px;
      padding-left: 0;
      border: 1px solid;

    }

    .whole {
      display: flex;
      flex-direction: row;
      margin-right: 20px;
      justify-content: space-between;
      color: white;
      font-size: 20px;
    }

    .whole a {
      text-decoration: none;
      color: lightgray;
      font-size: 0.7rem;

    }

    .one {
      display: flex;
      flex-direction: column;
    }

    .one img {
      width: 200px;
      height: 65px;
      border-radius: 20px;
    }

    .whole p {
      margin-bottom: 10px;
      font-size: 1.8rem;
    }

    .one a {
      color: darkgray;
      font-size: 15px;
      margin-bottom: 5px;
    }

    .both {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      width: 100%;
      background-color: black;
    }

    .both p strong {
      text-transform: uppercase;
      font-size: 1.3rem;
    }

    .both p {
      font-size: 1.2rem;
    }

    .two-part {
      width: 45%;
      display: flex;
      margin-left: 20%;
    }

    .checkout {
      width: 35%;
      margin-left: 20%;
      margin-top: 0;
      text-align: center;
    }

    .total-value {
      width: 40%;
      display: flex;
      justify-content: space-between;
      margin-left: 20%;
      color: white;
    }

    .fulfill {
      margin-top: 40px;
      color: white;
      font-size: 2.6rem;
      text-align: end;
      width: 40%;
      background-color: black;
    }

    .size strong {
      font-size: 1.4rem;
      color: white;
    }

    .description h2 {
      font-size: 2.5rem;
    }

    .description p {
      margin-left: 0;
    }

    .description {
      background-color: black
    }

    .this {
      margin-left: 10px;
    }

    #whole-part {
      background-color: black;
    }
  </style>
</head>

<body x-data="{vip:0,normal:0,totatTicket:0,show:true,visible:true}">
<?php include_once 'navi.php'; ?>
  <?php
    if($status==="good"){
      ?>
      <div :class="visible?'flex':'hidden'" class="pt-3 align-center bg-green-400 flex justify-between text-white rounded border-2 border-green-500 w-4/5 absolute top-30">
        <p class="text-center text-lg w-full">Checkout Successful!!!</p>
        <button @click="visible = !visible" class="">
          <i  class="p-3 fa-solid fa-xmark h-full"></i>
        </button>
      </div>
<?php
    }else if($status==="bad"){
      ?>
        <div class="p-3 bg-red-300  text-white rounded border-2 border-red-400 w-4/5 absolute top-30">
          <p class="text-center text-lg w-full">Checkout Failed!!!</p>
        </div>
      <?php
    }
  ?>
  
  <!-- ############         ################# -->
  <?php
  
  if (isset($_GET["eid"])) {
    $title = $_GET['eid'];
    $sql = "SELECT * FROM store where id='$title'";
    $result = $conn->query($sql);
    // Display data within the HTML div
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        ?>
        <div class="whole-part" id="whole-part">
          <div class="first-row1">
            <div class="single1">
              <p class="para"><?php echo $row['title'] ?></p>
              <p><small><?php echo $row['date'], "at", $row['time'], $row['venue'] ?></small></p>
            </div>
            <div class="single">
              <img src="   <?php echo $row['image']??"./image/Seifu.jpg"?>" class="seifu" alt="...">
            </div>
          </div>
          <!--the whole right side -->
          <div class="bg-black rounded-md second-row2">
            <!-- <div class="star ">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill"
                viewBox="0 0 16 16">
                <path
                  d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill"
                viewBox="0 0 16 16">
                <path
                  d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill"
                viewBox="0 0 16 16">
                <path
                  d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill"
                viewBox="0 0 16 16">
                <path
                  d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill"
                viewBox="0 0 16 16">
                <path
                  d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
              </svg>
            </div> -->
            <!-- contain order -->

            <div class="description ">
              <h2><?php echo $row['title'] ?></h2>
              <p><strong><?php echo $row['description'] ?></strong>
              </p>
            </div>
            <div class="both mt-10">
              <div class="this ">
                <p><strong>Organizer:</strong><?php echo $row['name'] ?></p>
                <p><strong>Date:</strong><?php echo $row['date'] ?></p>
                <p><strong>Time:</strong><?php echo $row['time'] ?></p>
                <p><strong>Venue:</strong><?php echo $row['venue'] ?></p>
              </div>
              <div class="this">
                <p><strong>price:</strong><?php echo $row['price'] ?></p>
                <p><strong >Ticket:</strong><?php echo $row['tickets'] ?></p>
                <p><strong>Category:</strong><?php echo $row['category'] ?></p>
                <p><strong>Venue:</strong><? echo $row['venue'] ?></p>
              </div>
            </div>            
          </div>
        </div>
        <!-- ###################### -->
        
        </div>
        <section class="fulfill ml-auto w-1/2 flex justify-start flex-col">
          <p class="text-left">FULFILL ORDER</p>
      
          <!-- <div class="two-part"> -->
            <!-- <div> -->
              <!-- <div class="size">
                <p><strong>VIP</strong> <span id="vip"><?php echo $row['price'] ?>ETB</span></p>
              </div>
              <div>
                <div class="button">
                  <button class="minus" @click="normal = normal - 1"><img src="./image/Screenshot 2024-05-22 033406.png" id="minus" alt=""></button>
                  <input type="text" name="value" :value="normal" id="value" placeholder="" value="0">
                  <button class="plus" @click="normal = normal - 1"><img src="./image/Screenshot 2024-05-22 033921.png" id="plus" alt=""></button>
                </div>
              </div> -->
            <!-- </div> -->
            <!-- right side -->
            <!-- <div> -->
              
            </div>
          </div>
          <form class="" method="GET" action="./index.php" class="total-value">
            <div class="flex gap-4">
              <div class="size ">
                <p><strong>NORMAL</strong> <span class="text-2xl"><?php echo $row['price'] ?>'ETB</span></p>
                <div class="button">
                  <div @click="vip = vip - 1" class="minus"><img src="./image/Screenshot 2024-05-22 033406.png"
                  id="minuses"></div>
                  <input :value="vip" type="text" name="value" id="values" value="0" placeholder="">
                  <div @click="vip = vip + 1" class="plus"><img src="./image/Screenshot 2024-05-22 033921.png"
                  id="pluses"></div>
                </div>
              </div>
              <div class="">
                <div class="w-full flex">
                  <p><strong class="text-3xl">TOTAL Ticket</strong> <span class="text-3xl" x-text="Math.abs(vip + normal)" id="totals"></span></p>
                </div>
                <div class="flex">
                  <input :value="<?php echo $row['tickets'] ?> - Math.abs(vip + normal)" type="hidden" name="TotalValue">
                  <input type="hidden"  name="eid" value="<?php echo $title;?>" style="display:none" required>
                  <p><strong class="text-3xl pb-2">TOTAL Price</strong> <span class="text-3xl" x-text="Math.abs((vip + normal)*1000)" id="total"></span></p>
                </div>
              </div>
            </div>
            <div class="checkouts flex w-full my-3">
              <input class="w-3/4 bg-white border-none rounded text-3xl text-black font-bold uppercase" type="submit" name="submit" placeholder="checkout" >
            </div>
          </form>
        </sEction>
          

      <?php }
    } else {
      echo "No events found.";
    }
  }
  // Close the database connection
  $conn->close();
  ?>
  <!-- #############       ###################### -->
  <!-- main -->

  <!-- popular event -->

  <!-- lela footer -->
  <hr>
  <div class="whole">
    <div class="one">
      <p>Download The App</p>
      <div>
        <img src="./image/Screenshot 2024-05-18 105703.png" alt=""><br>
        <img src="./image/Screenshot 2024-05-18 105629.png" alt="">
      </div>
    </div>
    <div class="one">
      <p>Resource</p>
      <a href="">About</a>
      <a href="">FAQ</a>
      <a href="">Become an Organizer</a>
      <a href="">Help & Support</a>
    </div>
    <div class="one">
      <p>Social</p>
      <a href="">X/Twitter</a>
      <a href="">Instagram</a>
      <a href="">Telegram</a>
      <a href="">Facebook</a>
    </div>
    <div class="one">
      <p>Developers</p>
      <a href="">About Developers</a>
    </div>
  </div>

  <hr>
  <!-- footer -->
  <footer>
    <div class="footer">
      <div class="row" id="first-row">
        <a href="#">Logo</a>
        <a href="#">@ Name Here.All rights reserved</a>
      </div>
      <div class="row" id="second-row">
        <a href="#" id="privacy">Your privacy Choice</a>
        <a href="">terms</a>
        <a href="">privacy</a>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!-- <script src="./index.js"></script> -->

</body>

</html>