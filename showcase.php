<?php 

    include_once(__DIR__. "/bootstrap.php");
    $projects = Project::getSHowcase();
    // $projects = Project::getAll();

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
    <div id="showcase-logo-container"><a href="index.php" id="showcase-logo"><img class="logo" src="images/logo.png" alt="Logo"> </a></div>
    <div class="feed">
    <?php foreach($projects as $project): ?>
        <div class="project" >
                <div class="projectImageContainer">
                <?php foreach(Project::getAllImagesOfProject($project['id']) as $image): ?>
                    <a href="project.php?p=<?php echo $project['id'] ?>"><img class="projectImage" src="<?php echo 'images/'.$image['fileName']; ?>" alt="Picture of project"></a>
                <?php endforeach; ?>
                </div>
                <div class="secondDetails">
                    <div class="extraDetails">
                        <h3 class="detailsText"><?php echo $project['title'] ?></h3>
                    </div>
                </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>