<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $conn = Db::getConnection();
    $user = User::getUserByEmail($_SESSION['email']);

    $projects = Project::getProjectsByUserId($user['id']);
    $project_id = 1;
    $images = Project::getAllImagesOfProject($project_id);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
    <style><?php include 'styling/style.css'; ?></style>
    <link rel="stylesheet" href="styling/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
</head>
<body>
    <?php if(!empty($_GET['status'])): ?>
        <?php if( $_GET['status'] == 'success'): ?>
            <div class="successMessage">
                <h2>Your profile settings have been saved!</h2>
                <span class="material-symbols-outlined" style="font-size:60px">done</span>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    <div class="profileDetails">
        <div class="avatar">
            <img src="<?php echo 'images/'.$user['avatar']; ?>" alt="avatar">
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
                <a href="<?php echo $user['instagram']; ?>" ><div id="instagram"></div></a>
            <?php endif; ?>
            <?php if (!empty($user['linkedin'])): ?>
                <a href="<?php echo $user['linkedin']; ?>" ><div id="linkedin"></div></a>
            <?php endif; ?>
        </div>
        <a href="settings.php" class="settingIcon">
            <span href="settings.php" class="material-symbols-outlined">settings</span>
        </a>
    </div>

    <div class="feed">
        <?php foreach($projects as $project): ?>
            <div class="project profileProject" >
                <div class="projectImageContainer">
                    <?php foreach($images as $image): ?>
                        <img class="projectImage" src="<?php echo 'images/'.$image['fileName']; ?>" alt="Picture of project">
                    <?php endforeach; ?>
                </div>
                <h3><?php echo $project['title'] ?></h3>
                <p><?php echo $project['teaser'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="./scripts/succesMessage.js"></script>
</body>
</html>