<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $user = User::getUserByEmail($_SESSION['email']);

    $projects = Project::getAll();
    $project_id = 1;
    $images = Project::getAllImagesOfProject($project_id);
    

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
    <?php foreach($projects as $project): ?>
        <?php foreach($images as $image): ?>
            <img src="<?php echo 'avatars/'.$image['fileName']; ?>" alt="Picture of project">
        <?php endforeach; ?>
        <h3><?php echo $project['title'] ?></h3>
        <p><?php echo $project['teaser'] ?></p>
        <?php $userOfProject = User::getUserById($project['user_id']) ?>
        <a href="userProfile.php?u=<?php echo $userOfProject['id'] ?>"><?php echo $userOfProject['username'] ?></a>
    <?php endforeach; ?>
</body>
</html>