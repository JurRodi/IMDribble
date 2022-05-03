<?php 

    include_once(__DIR__. "/bootstrap.php");

    session_start();
    if(isset($_SESSION['email'])){
        $user = User::getUserByEmail($_SESSION['email']);
    }
    
    $project = Project::getProjectById($_GET['p']);

    if(isset($_POST['search'])){
        $search = $_POST['searchbalk'];
        $searched_project = Project::getProjectbyTitle($search);
        var_dump($searched_project);
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
    <form action="<?php echo "index.php?project=".$searched_project['id']; ?>" method="POST">
        <input type="text" name="searchbalk" placeholder="Search">
        <input type="submit" name="search" value="Search">
    </form>
    <div class="feed">
        <div class="project" >
                <div class="projectImageContainer">
                <?php foreach(Project::getAllImagesOfProject($project['id']) as $image): ?>
                    <a href="project.php"><img class="projectImage" src="<?php echo 'images/'.$image['fileName']; ?>" alt="Picture of project"></a>
                <?php endforeach; ?>
                </div>
                <?php if(isset($user)): $creator = Project::getUser($project['user_id']); ?>
                    <div class="firstDetails">
                        <img class="avatar" src="<?php echo 'images/'.$creator['avatar']; ?>" alt="avatar">
                        <div class="details">
                            <h4 class="detailsText"><a id="postUsername" href="userProfile.php?u=<?php echo $creator['id'] ?>"><?php echo $creator['username'] ?></a></h4>
                            <p id="postTime" class="detailsText"><?php echo getTimeDiff($project['timestamp']); ?></p>
                        </div>
                        <div class="actions">
                            <a href="" class="postAction" id="like">like</a>
                            <a href="" class="postAction" id="comment">comment</a>
                            <a href="" class="postAction" id="save">save</a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="secondDetails">
                    <div class="extraDetails">
                        <h3 class="detailsText"><?php echo $project['title'] ?></h3>
                        <p class="detailsText"><?php echo $project['teaser'] ?></p> 
                    </div>
                    <div class="tags">
                        <?php foreach(Project::getTagsOfProject($project['id']) as $tag): ?>
                            <a href="" class="tag"><?php echo '#'.$tag['name']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
        </div>
    </div>
</body>
</html>