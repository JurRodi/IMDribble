<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    $user = User::getUserByEmail($_SESSION['email']);


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
    
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Project name">
        <label for="teaser">Teaser</label>
        <input type="text" name="teaser" placeholder="Teaser">
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="Description"></br>
        <input type="file" name="image"></br>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>