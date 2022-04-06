<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $user = User::getUserByEmail($_SESSION['email']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    <div class="avatar">
        <img src="<?php echo $user['avatar']; ?>" alt="avatar">
    </div>
    <a href="#">Edit<?php //User::setAvatar($avatar) ?></a>
    <h4>Username: <input type="text" name="username" value="<?php echo $user['username']; ?>" ></h4>
    <h4>Bio: <input type="text" name="username" value="<?php echo $user['bio']; ?>"></h4>
    <h4>Email: <input type="text" name="username" value="<?php echo $user['email']; ?>"></h4>
    <h4>Password: <a href="#">Change password</a> </h4>
</body>
</html>