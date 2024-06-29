<?php include_once 'resource/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(!isset($_SESSION['username'])): ?>
    <p>You are currently not signin <a href="login.php">Login</a> Not a member? <a href="signup.php">SignUP</a></p>
    <?php else: ?>
    <p>You are logged in as <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> <a href="logout.php">Logout</a></p>

    <?php endif ?>
</body>
</html>