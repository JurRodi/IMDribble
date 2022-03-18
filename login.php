<?php 

    include_once(__DIR__. "/bootstrap.php");

    $conn = Db::getConnection();
    $stmt = $conn->query("select * from users");
    $data = $stmt->fetchAll();
    var_dump($data);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
</head>
<body>
    
</body>
</html>