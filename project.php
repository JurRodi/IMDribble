<?php 

    include_once(__DIR__. "/bootstrap.php");
    include_once(__DIR__. "/classes/Comment.php");
    $allComments = Comment::getAll($_GET['p']);

    session_start();
    if(isset($_SESSION['email'])){
        $user = User::getUserByEmail($_SESSION['email']);
    }
    
    $project = Project::getProjectById($_GET['p']);
    $totalLikes = Like::CountLikes($_GET['p']);

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
    
    
    <?php if($user['id'] !== $project['user_id']): ?>
        <a href="#" id="reportitem" class="reportitem" >Report</a> </br>
    <?php endif; ?>


    <?php if($user['id'] === $project['user_id']): ?>
                    <a class="editproject" href="editProject.php?p=<?php echo $project['id'] ?>">✏️</a>
                    <a class="deleteproject" href="deleteProject.php?p=<?php echo $project['id'] ?>">Delete</a>
                    <div id="showcaseButton" data-project="<?php echo $project['id'] ?>" >
                        
                    
                        <?php if(empty(Project::getShowcaseItem($project['id']))):  ?>    
                            <a href="#"  class="showcaseInactive" data-project="<?php echo $project['id'] ?>">Add to showcase</a>
                            
                        <?php else:?>
                            <a href="#" class="showcaseActive" data-project="<?php echo $project['id'] ?>">Remove from showcase</a>
                        <?php endif ?> 
                    </div>
                <?php endif; ?>
    <div class="feed">
    
    
        <div class="project detail-project" >
            <div >
                <div class="projectImageContainer">
                <?php foreach(Project::getAllImagesOfProject($project['id']) as $image): ?>
                    <img class="projectImage" src="<?php echo 'images/'.$image['fileName']; ?>" alt="Picture of project">
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
                            <a href="" class="postAction <?php if(Like::isLiked($_GET['p'], $user['id'])){ echo 'liked'; } ?>" id="like" data-id="<?php echo $project['id'] ?>" data-user="<?php echo $project['user_id'] ?>"><?php echo $totalLikes; ?> likes</a>
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
            <div class="commentSection">
                    <div class="commentForm">
                        <input type="text" id="commentText" placeholder="Write a comment">
                        <a href="#" class="submitComment" data-postid="<?php echo $project['id'] ?>">Post comment</a>
                    </div>
                    <ul class="CommentList">
                        <?php foreach($allComments as $comment): ?>
                            <?php $commentUser = User::getUserById($comment['userid']) ?>
                            <li>
                                <h4 class="detailsText"><a id="postUsername" href="userProfile.php?u=<?php echo $commentUser['id'] ?>"><?php echo $commentUser['username'] ?> commented:</a></h4>
                                <p><?php echo $comment['text'] ?></p>
                                <?php if($_SESSION['email'] === $commentUser['email'] || $_SESSION['email'] === $commentUser['email2']): ?>
                                <a href="#" class="deleteComment" data-commentid="<?php echo $comment['id'] ?>">Delete</a>
                                <?php endif ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
            </div>
              
        </div>
    
    </div>
    <!--modal section -->
    <div class="bg-popup">
       <div class="modal-content2">
       <div class="close" >+</div>
       
       <h1>You are reporting a project</h1>
       
     <form name= "report" id="report">
        <label for="reportSelect">Why are you reporting this project?</label>
        <select id="reportSelect">
            <option value="Scammer">Scammer</option>
            <option value="Bullying">Bullying</option>
            <option value="Pretends to be someone else">Pretends to be someone else</option>
            <option value="Not a student/teacher">Not a student/teacher</option>
            <option value="inapropriate language">inapropriate language</option>
            <option value="inapropriate content">inapropriate content</option>
        </select>
        <input class="report-btn" name="reportuser" type="submit" value="REPORT USER" data-reportuser_id="<?php echo $project['user_id'] ?>" data-project_id="<?php echo $_GET['p'] ?>">
     </form>

   <script src="scripts/reportitem.js"></script>
    <script src="scripts/comments.js"></script>
    <script src="scripts/like.js"></script>
    <script src="scripts/showcase.js"></script></script>
</body>
</html>