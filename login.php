<?php 

    include_once(__DIR__. "/bootstrap.php");

    $conn = Db::getConnection();
    $stmt = $conn->query("select * from users");
    $users = $stmt->fetchAll();
    var_dump($users);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
</head>
<body>
    <form method="POST" action="">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="email" >
        <label for="password">Password</label>
        <input type="text" name="password" placeholder="password">
    </form>
</body>
</html>