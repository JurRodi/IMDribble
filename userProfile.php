<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $conn = Db::getConnection();
    $user = User::getUserById($_GET['u']);

    $projects = Project::getProjectsByUserId($_GET['u']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
    <style><?php include 'styling/style.css'; ?></style>
    <link rel="stylesheet" href="styling/style.css">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    <!-- <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Back</a> -->
    
    <div class="profileDetails">
        <div class="avatar">
            <img class="avatar-profile" src="<?php echo 'images/'.$user['avatar']; ?>" alt="avatar">
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
            
            <div id="followUnfollowBtn">
                <?php $user1 = User::getUserByEmail($_SESSION['email']) ?>
                <?php if(Follow::getFollow($user1['id'],$_GET['u']) === false):  ?>    
                    <a href="#" class="followBtn" data-user="<?php echo $_GET['u'] ?>">Follow</a>
                <?php else:?>
                    <a href="#" class="unfollowBtn" data-user="<?php echo $_GET['u'] ?>">Unfollow</a>
                <?php endif ?>
            </div>
        </div>
        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="closeIcon">
            <span class="material-symbols-outlined">close</span>
        </a>
        <div>
    <a href="#" id="reportuser" class="reportuser" >Report user</a> </br>
    </div>
    </div>
    
    <div class="feed">
        <?php foreach($projects as $project): $images = Project::getAllImagesOfProject($project['id']);?>
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
   

    
    <div>
        <a href="#" id="reportuser" class="reportuser" >Report user</a> </br>
    </div>

     modal section
     <div class="bg-popup">
       <div class="modal-content2">
       <div class="close" >+</div>
       
       <h1>You are reporting a user</h1>
       
       
     <form name= "report" id="report">
        <label for="reportSelect">Why are you reporting this user?</label>
        <select id="reportSelect">
            <option value="Scammer">Scammer</option>
            <option value="Bullying">Bullying</option>
            <option value="Pretends to be someone else">Pretends to be someone else</option>
            <option value="Not a student/teacher">Not a student/teacher</option>
            <option value="inapropriate language">inapropriate language</option>
            <option value="inapropriate content">inapropriate content</option>
        </select>
        <input class="report-btn" name="reportuser" type="submit" value="sendComplaint" data-reportuser_id="<?php echo $_GET['u'] ?>" >
      
     </form>

    <script src="scripts/follow.js"></script>
    <script src="scripts/reportuser.js"></script>
</body>
</html>
