<?php 
    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $user = User::getUserByEmail($_SESSION['email']);
    include_once(__DIR__. "/upload.php");
    $user = User::getUserByEmail($_SESSION['email']);
    $error;
    include_once(__DIR__. "/changepassword.php");

    if(isset($_POST['save'])){
        try{
            $updatedUser = new User();
            $updatedUser->getUserByEmail($_SESSION['email']);
            $updatedUser->setEmail($user["email"]);
            $updatedUser->setEmail2($_POST["email2"]);
            $updatedUser->setBio($_POST["bio"]);
            $updatedUser->setEducation($_POST["education"]);
            $updatedUser->setInstagram($_POST["instagram"]);
            $updatedUser->setLinkedin($_POST["linkedin"]);
            $updatedUser->updateProfile();
            header("Location: profile.php?status=success");
        }
        catch(Throwable $e){
            $error = $e->getMessage();
        }
    }


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
    <link rel="stylesheet" href="styling/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
</head>
<body >
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    <div id="settingsForm">
        <div class="avatar">
            <img src="<?php echo 'images/'.$user['avatar']; ?>" alt="avatar">
        </div>
        <br>
        <?php if(!empty($statusMsg)): ?>
            <div class="alert"><?php echo $statusMsg; ?></div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data" >
            <input type="file" name="image">
            <input type="submit" name="submit" value="Upload" class="btn">
        </form>
        <form action="" method="POST" >
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>">

            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo $user['email']; ?>">

            <label for="email2">Second email</label>
            <input type="text" name="email2" value="<?php echo $user['email2']; ?>">

            <label for="bio">Bio</label>
            <input type="text" name="bio" value="<?php echo $user['bio']; ?>">

            <label for="education">Education</label>
            <input type="text" name="education" value="<?php echo $user['education']; ?>">

            <label for="instagram">Instagram</label>
            <input type="text" name="instagram" value="<?php echo $user['instagram']; ?>">

            <label for="linkedin">Linkedin</label>
            <input type="text" name="linkedin" value="<?php echo $user['linkedin']; ?>">
            <?php if(isset($error)): ?>
                <p><?php echo $error ?></p>
            <?php endif; ?>
            <input type="submit" name="save" value="Save" class="btn">
        </form>
        <a href="#" id="cp-button" class="cp-button" >Change password</a> </br>
        <a href="deleteProfile.php">delete profile</a>
    </div>
    

  <!--modal section -->
   
  <div class="bg-popup">
       <div class="modal-content">
       <div class="close" >+</div>
       
       <form  method="POST" action="">
       
        <h1>Change password</h1>
        <h2>Choose a new password!</h2>
        <div class="pw-details" >
            <label for="password">Old password</label>
            <input class="input-cp" type="password" name="oldPwd" placeholder="Old password" required>
        </div>
        <div class="pw-details" >
            <label for="password">New password</label>
            <input class="input-cp" type="password" name="newPwd" placeholder="New password" required>
            </div>
        <div class="pw-details" >
            <label for="password">Confirm new password</label>
            <input class="input-cp" type="password" name="confirmPwd" placeholder="Confirm new password" required>
        </div>
        <input class="cp-btn" name="ChangePassword" type="submit" value="ChangePassword">
            
        </form>
       
   </div>
   <script src="scripts/changepassword.js"></script>
</body>
</html>

<script
