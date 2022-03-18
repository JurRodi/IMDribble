<?php 

    include_once(__DIR__. "/bootstrap.php");
    //Security::onlyLoggedInUsers();
    $user = new User();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
</head>
<body>
    <div class="avatar">
        <img src="<?php echo $user->getAvatar(); ?>" alt="avatar">
    </div>
</body>
</html>