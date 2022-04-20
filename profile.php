<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $conn = Db::getConnection();
    $user = User::getUserByEmail($_SESSION['email']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
    <link rel="stylesheet" href="styling/style.css">
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    <a href="settings.php">settings</a>
    <div class="avatar">
        <img src="<?php echo 'images/'.$user['avatar']; ?>" alt="avatar">
    </div>
    <h3><?php echo $user['username']; ?></h3>
    <p><?php echo $user['bio']; ?></p>
</body>
</html>