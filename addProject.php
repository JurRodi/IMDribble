<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $user = User::getUserByEmail($_SESSION['email']);
    include_once(__DIR__. "/upload.php");
    //Tag::getAllTags()
    $tags = [
        [
            'id' => 1,
            'name' => "Design"
        ],
        [
            'id' => 2,
            'name' => "Development"
        ]
    ];
    //var_dump($tags);

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
        <select name="tags" required>
            <option value="">Select a tag</option>
            <?php foreach($tags as $tag): ?>
                <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
            <?php endforeach; ?>
        <input type="file" name="image" required></br>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>