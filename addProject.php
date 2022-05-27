<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $user = User::getUserByEmail($_SESSION['email']);
    include_once(__DIR__. "/upload.php");
    $tags = Tag::getAll();
    
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
<body>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    <div id="settingsForm">
        <?php if(!empty($statusMsg)): ?>
            <div class="alert"><?php echo $statusMsg; ?></div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Project name" required>
            <label for="teaser">Teaser</label>
            <input type="text" name="teaser" placeholder="Teaser" required>
            <label for="description">Description</label>
            <input type="text" name="description" placeholder="Description" required></br>
            <label for="tags">Tags</label>
            <?php foreach($tags as $tag): ?>
                <input type="checkbox" name="tags[]" value="<?php echo $tag['id']; ?>">
                <label for="<?php echo $tag['name']; ?>"><?php echo $tag['name']; ?></label>
            <?php endforeach; ?>
            </br><input type="file" name="image" required></br>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>
</body>
</html>