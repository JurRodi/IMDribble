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
    $projects = Project::getAmountPerPage($limit, $offset);
    $total = Project::countAll();
    $total_pages = ceil($total[0]['total'] / $limit);

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
    <form action="" method="POST">
        <input type="text" name="searchbalk" placeholder="Search">
        <input type="submit" name="search" value="Search">
    </form>

    <div>
        <?php foreach($projects as $project): ?>
            <?php foreach(Project::getAllImagesOfProject($project['id']) as $image): ?>
                <img src="<?php echo 'images/'.$image['fileName']; ?>" alt="Picture of project">
            <?php endforeach; ?>
            <?php if(isset($user)): $creator = Project::getUser($project['user_id']); ?>
                <a href="">like</a>
                <a href="">comment</a>
                <a href="">save</a>
                <img src="<?php echo 'images/'.$creator['avatar']; ?>" alt="avatar">
                <h4><?php echo $creator['username']; ?></h4>
                <p><?php echo $project['timestamp']; ?></p>
            <?php endif; ?>
            <h3><?php echo $project['title'] ?></h3>
            <p><?php echo $project['teaser'] ?></p>
        <?php endforeach; ?>
    </div>
    <?php if($page_number>=2): ?>
        <a href="?page=<?php echo $page_number-1; ?>">Previous page</a>
    <?php endif; ?>
    <?php for ($i=1; $i<=$total_pages; $i++): ?>
        <?php if ($i == $page_number): ?>
            <a class="active" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php elseif($page_number-2 <= $i && $i <= $page_number+2): ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if($page_number<$total_pages): ?>
        <a href="index.php?page=<?php echo $page_number+1; ?>">Next page</a>
    <?php endif; ?>
</body>
</html>