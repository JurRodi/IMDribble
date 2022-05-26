<?php
    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();

    $user = User::getUserByEmail($_SESSION['email']);
    $tags = Tag::getAll();
    $project = Project::getProjectById($_GET['p']);
    $currentTags = Project::getTagsOfProject($project['id']);

    if(isset($_POST['submit'])){
        $project_id = Project::updateProject($project['id'], $_POST['title'], $_POST['teaser'], $_POST['description'], $_POST['tags']);
        include_once(__DIR__. "/upload.php");
        header("Location: project.php?p=".$project['id']);
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
<body>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    
    <?php if(!empty($statusMsg)): ?>
        <div class="alert"><?php echo $statusMsg; ?></div>
    <?php endif; ?>
    <div class="projectImageContainer">
        <?php foreach(Project::getAllImagesOfProject($project['id']) as $image): ?>
            <img class="editImage" src="<?php echo 'images/'.$image['fileName']; ?>" alt="Picture of project">
        <?php endforeach; ?>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?php echo $project['title'] ?>" placeholder="Project name" required>
        <label for="teaser">Teaser</label>
        <input type="text" name="teaser" value="<?php echo $project['teaser'] ?>" placeholder="Teaser" required>
        <label for="description">Description</label>
        <input type="text" name="description" value="<?php echo $project['description'] ?>" placeholder="Description" required></br>
        <label for="tags">Tags</label>
        <?php foreach($tags as $tag): ?>
            <input type="checkbox" name="tags[]" value="<?php echo $tag['id']; ?>" <?php foreach($currentTags as $currentTag){if($currentTag['name'] === $tag['name']){ echo "checked"; }} ?>>
            <label for="<?php echo $tag['name']; ?>"><?php echo $tag['name']; ?></label>
        <?php endforeach; ?>
        </br><input type="file" name="image" ></br>
        <input type="submit" name="submit" value="Confirm">
    </form>
</body>
</html>