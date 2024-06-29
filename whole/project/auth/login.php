<?php 
include_once 'resource/session.php';
include_once 'resource/Database.php';
include_once 'resource/utilities.php';

if (isset($_POST['loginBtn'])) {
    //array to hold errors
    $form_errors = array();

    $required_fields = array('username','password');

    $form_errors = array_merge($form_errors,check_empty_fields($required_fields));

    if(empty($form_errors)){
        //collect form data
        $user = $_POST['username'];
        $password = $_POST['password'];

        //chekc if user is in the database
        $sqlQuery = "SELECT * FROM user WHERE username = :username";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array('username'=> $user));

        while($row = $statement->fetch()){
            $id = $row['id'];
            $hashed_password = $row['password'];
            $username = $row['username'];

            if(password_verify($password,$hashed_password)){
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                header("location: /whole/checkshow.php");// to link
            }else{
                $result = "<p style='text-align:center; padding:20px; color:white;'>Invalid Username of Password</p>";
            }
        }

    }else{
        if(count($form_errors)){
            $result = "<p style ='text-align:center; color:white;'>There was one error in the form</p>";
        }else{
            $result = "<p style ='text-align:center; color:white;'>There were ".count($form_errors)." errors in the form</p>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <?php if (isset($result) || !empty($form_errors)): ?>
    <div class="error-message">
        <?php if (isset($result)): ?>
            <?php echo $result; ?>
        <?php endif; ?>
        <?php if (!empty($form_errors)): ?>
            <?php echo show_errors($form_errors); ?>
        <?php endif; ?>
    </div>
<?php endif; ?>    

    <div class="container">
        <h1>Login</h1>
        <form method="post" action="">
            <table>
                <tr><td>Username:</td></tr> 
                <tr><td><input type="text" value="" name="username"></td></tr>
                <tr><td>Password:</td></tr>
                <tr><td><input type="password" value="" name="password"></td></tr>
                <tr><td><input style="background-color: white; font-size: 17px; font-weight: 800;margin-top: 10px;color:black;" type="submit" name="loginBtn" value="LOGIN"></td></tr>
            </table>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
    </div>

</body>
</html>