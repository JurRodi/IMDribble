<?php 
    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $user = User::getUserByEmail($_SESSION['email']);
    include_once(__DIR__. "/upload.php");
    $user = User::getUserByEmail($_SESSION['email']);

    if(isset($_POST['save'])){
        echo $_SESSION['email'];
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
            header("Location: profile.php");
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
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    <div class="avatar">
        <img src="<?php echo 'images/'.$user['avatar']; ?>" alt="avatar">
    </div>
    <br>
    <?php if(!empty($statusMsg)): ?>
        <div class="alert"><?php echo $statusMsg; ?></div>
    <?php endif; ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" name="submit" value="Upload">
    </form>
    <form action="" method="POST">
        <h4>Username: <input type="text" name="username" value="<?php echo $user['username']; ?>" ></h4>
        <h4>Email: <input type="text" name="email" value="<?php echo $user['email']; ?>"></h4>
        <h4>Second email: <input type="text" name="email2" value="<?php echo $user['email2']; ?>"></h4>
        <h4>Bio: <input type="text" name="bio" value="<?php echo $user['bio']; ?>"></h4>
        <h4>Education: <input type="text" name="education" value="<?php echo $user['education']; ?>"></h4>
        <h4>Instagram: <input type="text" name="instagram" value="<?php echo $user['instagram']; ?>"></h4>
        <h4>Linkedin: <input type="text" name="linkedin" value="<?php echo $user['linkedin']; ?>"></h4>
        <h4>Password: <a href="#">Change password</a> </h4>
        <input type="submit" name="save" value="Save">
    </form>
    <a href="deleteProfile.php">delete profile</a>
</body>
</html>

<script
