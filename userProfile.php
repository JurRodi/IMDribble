<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $conn = Db::getConnection();
    $user = User::getUserById($_GET['u']);

    $projects = Project::getProjectsByUserId($_GET['u']);
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
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    
    <div class="profileDetails">
        <div class="avatar">
            <img src="<?php echo 'avatars/'.$user['avatar']; ?>" alt="avatar">
        </div>
        <div class="userData">
            <h3><?php echo $user['username']; ?></h3>
            <?php if (!empty($user['education'])): ?>
                <p>Student: <?php echo $user['education']; ?></p>
            <?php endif; ?>
            <?php if (!empty($user['bio'])): ?>
                <p><?php echo $user['bio']; ?></p>
            <?php endif; ?>
            <?php if (!empty($user['instagram'])): ?>
                <a href="<?php echo $user['instagram']; ?>"><div id="instagram"></div></a>
            <?php endif; ?>
            <?php if (!empty($user['linkedin'])): ?>
                <a href="<?php echo $user['linkedin']; ?>"><div id="linkedin"></div></a>
            <?php endif; ?>
        </div>
        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="closeIcon">
            <span class="material-symbols-outlined">close</span>
        </a>
    </div>
    
    <div class="feed">
        <?php foreach($projects as $project): ?>
            <div class="project profileProject" >
                <div class="projectImageContainer">
                    <?php foreach($images as $image): ?>
                        <img src="<?php echo 'avatars/'.$image['fileName']; ?>" alt="Picture of project">
                    <?php endforeach; ?>
                </div>
                <h3><?php echo $project['title'] ?></h3>
                <p><?php echo $project['teaser'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    
</body>
</html>