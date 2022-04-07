<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $conn = Db::getConnection();
    $user = User::getUserByEmail($_SESSION['email']);

    $statement = $conn->prepare("SELECT * FROM avatars WHERE user_id = :user_id");
    $statement->bindValue(':user_id', $user['id']);
    $statement->execute();
    $avatar = $statement->fetch();

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
    <a href="settings.php">settings</a>
    <div class="avatar">
        <img src="<?php echo 'avatars/'.$avatar['fileName']; ?>" alt="avatar">
    </div>
    <h3><?php echo $user['username']; ?></h3>
</body>
</html>