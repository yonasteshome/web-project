<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>front</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./project/three/style.css">
<style>
    body{
    padding:0;
    padding-left:6%;
    padding-right:6%;
    margin:0;
    box-shadow:0;
    background-color:black;
}
::placeholder{
    color:wheat;
    font-size:0.9rem;

  }
  #search{
    width:350px;
    background:transparent;
    border-radius: 20px;
    border:1px solid white;
    height:30px;
    margin-top:17px;
    padding: 10px 10px 15px 10px;
    color: white;
    font-size:0.93rem;
    text-decoration: none;
    
}

.one a{
    color:darkgray;
    font-size: 15px;
    margin-bottom: 5px;
}
footer{
    display:flex;
    justify-content:space-between;
}
.footer{
    width:100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 60px;
    }
.row{
    display:inline;
}
.footer a{
    color:darkgray;
    font-size:15px;
}
#first-row a{
    text-decoration:none;
}
#privacy{
    text-decoration:none;
}
#second-row{
    margin-bottom: 30px;
}
/* lela footer */
hr{
    color: aliceblue;
    margin-top: 140px;
    padding-left: 0;
    border: 1px solid;
}
.whole{
    display: flex;
    flex-direction: row;
    margin-right: 20px;
    justify-content: space-between;
    color: white;
    font-size: 20px;
}
.whole a{
    text-decoration:none;
    color:lightgray;
    font-size:0.7rem;

}
.one{
    display:flex;
    flex-direction:column;
}
.one img{
    width:200px;
    height:65px;
    border-radius: 20px;
}
.whole p{
    margin-bottom: 10px;
    font-size: 1.8rem;
}
.one a{
    color: darkgray;
    font-size: 15px;
    margin-bottom: 5px;
}
.popular-event-image{
  margin: 10px;
}

.container-all{
  display:flex;
  flex-wrap: wrap
  }
#category{
  display: flex;
  flex-direction: row;
  justify-content: start;
  
}
.category{
  font-size: 1.3rem;
  font-family: sans-serif;
  margin-top: 30px;
  margin-bottom: 30px;
  background-color:lightslategrey;
  color: white;
}
.unique{
  margin-left: 800px;
  background-color: green;
  color: white;
  padding: 10px;
  border-radius: 20px;
}
</style>
  </head>
<body>
<?php include_once 'nav.php'; ?>
      <div id="category">
        <form action="" method="GET">
            <input class="px-2 rounded-md bg-white" type="submit" value="All" name="all" class="category">
            <input class="px-2 rounded-md bg-white" type="submit" value="Sport" name="sport" class="category">
            <input class="px-2 rounded-md bg-white" type="submit" value="Show" name="show" class="category">
            <input class="px-2 rounded-md bg-white" type="submit" value="Music" name="music" class="category">
          </form>
          
      </div>

      <!-- main -->
    <!-- popular event -->
      <div class="container-all">
    <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "event";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM store";
            if(isset($_GET['all'])){
              $sql = 'SELECT * FROM store';
            }
            if(isset($_GET['sport'])){
              $sql = "SELECT * FROM store WHERE category='sport';";
            }
            if(isset($_GET['show'])){
              $sql = "SELECT * FROM store WHERE category='show';";
            }
            if(isset($_GET['music'])){
              $sql = "SELECT * FROM store WHERE category='music';";
            }
            
      
            $result = $conn->query($sql);
            // Display data within the HTML div
            if ($result->num_rows > 0) {
               
                while ($row = $result->fetch_assoc()) {
                
             ?>
                    
                    <div class="popular-event">
      <h4 class="popular-event"></h4>
    </div>
    <!-- ?eid=2&submit=more -->
    <div class="popular-event-image no-underline rounded-md">
      <a class="no-underline	" href="/whole/project/two/index.php?eid=<?php echo $row['id']?>">
      <div class="first stage">
        <div class="overflow-hidden group">
          <img  class=" Eshetu parts group-hover:scale-125 transition-duration-1000" src="<?php echo $row['image']??"./img/stadium.jpg"?>" alt="...">
        </div>
      </a>
        <div class="row-star px-6 py-2">
          <div class="paragraph w-full flex justify-between align-center">
            <div>
              <p class="no-underline	text-2xl"><?php echo $row['title']?></p>
              <p class="no-underline	"><small><?php echo $row['date']?> </small></p>
            </div>
         <div>
            <p class="no-underline	"><?php echo $row['price']?>ETB</p>

         </div>
          </div>
          <!-- <div class="star">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
              <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
            </svg>
          </div> -->
        </div>
      </div>
    </div>
                    
                  <?php
                }
            } else {
                echo "No events found.";
            }

            // Close the database connection
            $conn->close();
        ?>
        </div>
      <!-- lela footer -->
      <hr>
    <div class="whole">
      <div class="one">
        <p>Download The App</p>
        <div>
          <img src="./img/Screenshot 2024-05-18 105703.png" alt=""><br>
          <img src="./img/Screenshot 2024-05-18 105629.png" alt="">
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
