<?php 

    include_once(__DIR__. "/bootstrap.php");

    session_start();
    if(isset($_SESSION['email'])){
        $user = User::getUserByEmail($_SESSION['email']);
    }

    if(!isset($_GET['page'])){
        $page_number = 1;
    } else {
        $page_number = $_GET['page'];
    }
    $limit = 21;
    $offset = $limit * ($page_number - 1);
    $tags = Tag::getAll();

    if(isset($_GET['tags'])){
        $searched_tag = Tag::getTagByName($_GET['tags']);
        $projects = Project::getProjectsByTags($searched_tag['id'], $limit, $offset);
        $total = Project::countAllByTags($searched_tag['id']);
        $total_pages = ceil($total[0]['total'] / $limit);
        $active = $_GET['tags'];
    } else{ 
        if(isset($_GET['timeline'])){
            $timeline = $_GET['timeline'];
            
            if($timeline ==="feed"){
                $projects = Project::getAmountPerPage($limit, $offset);
            }
            if($timeline ==="following"){
                $projects = Project::getProjectsByFollowing($limit, $offset, $user['id']);
            }
            
        }
        else{
            $projects = Project::getAmountPerPage($limit, $offset);
        }
        
        $total = Project::countAll();
        $total_pages = ceil($total[0]['total'] / $limit);
    }
    

    if(isset($_POST['search']) && !empty($_POST['searchbalk'])){
        $search = $_POST['searchbalk'];
        $searched_project = Project::getProjectbyTitle($search);
        $id = $searched_project['id'];
        header("Location: project.php?p=".$id);
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
   
 <div class="alt-timeline"> 
    <a id="alt-feed" href="<?php echo "?timeline=feed" ?>">Feed</a>
    <a>|</a>
    <a id="alt-following" href="<?php echo "?timeline=following" ?>">Following</a>
</div>
    <div class="search-filter">
        <form action="" method="POST" class="search-form">
            <input type="text" name="searchbalk" placeholder="Search">
            <input type="submit" name="search" value="Search">
        </form>
        <div class="filters">
            <h3>Filters: </h3>
            <?php foreach($tags as $tag): ?>
                <a class="filter <?php if($active === $tag['name']){ echo "active-filter";} ?>" href="?tags=<?php echo $tag['name'] ?>"> <?php echo '#'.$tag['name'] ?></a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="feed">
    <?php foreach($projects as $project): ?>
        <div class="project" >
                <div class="projectImageContainer">
                <?php foreach(Project::getAllImagesOfProject($project['id']) as $image): ?>
                    <a href="project.php?p=<?php echo $project['id'] ?>"><img class="projectImage" src="<?php echo 'images/'.$image['fileName']; ?>" alt="Picture of project"></a>
                <?php endforeach; ?>
                </div>
                <?php if(isset($user)): $creator = Project::getUser($project['user_id']); ?>
                    <div class="firstDetails">
                        <div class="img-details">
                            <img class="avatar" src="<?php echo 'images/'.$creator['avatar']; ?>" alt="avatar">
                            <div class="details">
                                <h4 class="detailsText"><a id="postUsername" href="userProfile.php?u=<?php echo $creator['id'] ?>"><?php echo $creator['username'] ?></a></h4>
                                <p id="postTime" class="detailsText"><?php echo getTimeDiff($project['timestamp']); ?></p>
                            </div>
                        </div>
                        <div class="actions">
                            <a href="project.php?p=<?php echo $project['id'] ?>" class="postAction" id="like">like</a>
                            <a href="project.php?p=<?php echo $project['id'] ?>" class="postAction" id="comment">comment</a>
                            <a href="project.php?p=<?php echo $project['id'] ?>" class="postAction" id="save">save</a>
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
                            <a href="?tags=<?php echo $tag['name'] ?>" class="tag"><?php echo '#'.$tag['name']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
    
        </div>
        <?php endforeach; ?>
    </div>
    <div class="pagination">
        <?php if($page_number>=2): ?>
            <a class="page" href="<?php if(isset($searched_tag)): echo "?tags=".$searched_tag['name']."&"."" ; endif; echo "?page=".$page_number-1 ?>">Previous page</a>
        <?php endif; ?>
        <?php for ($i=1; $i<=$total_pages; $i++): ?>
            <?php if ($i == $page_number): ?>
                <a class="active page" href="<?php if(isset($searched_tag)): echo "?tags=".$searched_tag['name']."&"."" ; endif; echo "?page=".$i ?>"><?php echo $i; ?></a>
            <?php elseif($page_number-2 <= $i && $i <= $page_number+2): ?>
                <a class="page" href="<?php if(isset($searched_tag)): echo "?tags=".$searched_tag['name']."&"."" ; endif; echo "?page=".$i ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if($page_number<$total_pages): ?>
            <a class="page" href="<?php if(isset($searched_tag)): echo "?tags=".$searched_tag['name']."&"."" ; endif; echo "?page=". $page_number+1 ?>" >Next page</a>
        <?php endif; ?>
    </div>
</body>
</html>