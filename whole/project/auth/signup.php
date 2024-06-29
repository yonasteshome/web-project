<?php 
//add our connection script
include_once 'resource/Database.php';
include_once 'resource/utilities.php';

//proccess the form
if(isset($_POST['signupBtn'])){
    //initialize an array to store any error message from the form
    $form_errors = array();

    //Form Validation 
    $required_fields = array('email','username','password');
    //call a function to check empty field and merge the return data in form array in the utilities
    
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //fields that require checking for minimum length
    $fileds_to_check_length = array('username' => 4, 'password' => 6);

    //email validation
    $form_errors = array_merge($form_errors, check_email($_POST));

    // call the function to chekc minimum required length and merger the return data into form-error array
    $form_errors = array_merge($form_errors, check_min_length($fileds_to_check_length));
    
    
    //check if error array is empty ,if yes process from data and inser record
    if(empty($form_errors)) {
        //collect form data and store in variables
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        //hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {

            //create SQl insert Statement
            $sqlInsert = "INSERT INTO user(username, email, password, join_date)
                        VALUES (:username, :email, :password, now())";

            //use pdo to sanitize data
            $statement = $db->prepare($sqlInsert);

            //add the data into database
            $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password ));

            //check if a one new row is created
            if($statement->rowCount() == 1) {
                $result = "<p style= padding:20px; color:green;'>Registration Successful</p>";
            }
        } catch (PDOException $ex) {
            $result = "<p style='border: 1px solid grey; padding:20px; color:red;'>An Error Occurred: " . $ex->getMessage() . "</p>";
        }
    }else{
        if(count($form_errors) == 1) {
            $resultError = "<p style='color:red;'>There was 1 error in the form <br>";
        }else{
            $resultError = "<p>There were ".count($form_errors)." errors in the form <br></p>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Register Page</title>
    <style>
        body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        font-family: Roboto;
        background-color: black;
        }

        .right {
        background-color: black;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        }

        .right .container {

        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        height: 500px;
        width: 370px;
        background-color: rgba(63, 63, 63, 0.5);
        filter: opacity(70%);
        filter: blur(30%);
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .right .container h1 {
        text-align: left;
        }

        .right .container input{
        color: white;
        font-size: 15px;
        height: 42px;
        width: 300px;
        background-color: rgba(165, 165, 165, 0.2);
        border-style: none;
        border-radius: 6px;
        }
        .message{
        display: flex;
        flex: 1;
        justify-content: space-between;
        text-align: justify;
        flex-direction: row;
        }
        .right .container a{
        color:white;
        text-align: left;
        margin-left: 0px;
        }
        .error-message{
            background-color: rgba(226, 149, 149, 0.4);
            border-radius: 5px;
            color:white;
            padding-right: 10px;
            width: 370px;
            margin: 0px;
        }
        .success-message{
            background-color: rgba(103, 223, 87, 0.4);
            border-style: none;
            width: 370px;
            text-align: center;
            border-radius: 5px;
            color: white;
        }

    </style>
</head>
<body>
    <div class="right">

    <?php if (isset($result)): ?>
        <div class="success-message">
            <?php echo $result; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($resultError)): ?>
        <div class="error-message">
            <?php echo $resultError; ?>
            <?php if (!empty($form_errors)): ?>
            <?php echo show_errors($form_errors); ?>
        <?php endif; ?>  
        </div>
    <?php endif; ?>    
    
    <div class="container">
        <h1>Sign Up</h1>
        <form method="post" action="">
        <table>
            <tr><td>Email:</td><tr>
            <tr><td><input type="text" value="" name="email"></td></tr>
            <tr><td>Username:</td></tr>
            <tr><td><input type="text" value="" name="username"></td></tr>
            <tr><td>Password:</td></tr>
            <tr><td><input type="password" value="" name="password"></td></tr>
            <tr><td></td></tr>
            <tr><td><input style="background-color: white; font-size: 17px; font-weight: 800;margin-top: 10px;color:black;" name="signupBtn" type="submit" value="SIGN UP"></td></tr>
        </table>
    </form>
      <p>Already have an account? <a href="login.php">LogIn</a></p>
    </div>
  </div>


</body>
</html>
