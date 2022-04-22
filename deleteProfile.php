<?php
    include_once(__DIR__. "/bootstrap.php");
    session_start();
    $conn = Db::getConnection();
    $user = User::getUserByEmail($_SESSION["email"]);
    $id = $user["id"];
    $statementProject = $conn->prepare("delete * from projects where user_id = :id;");
    $statementLike = $conn->prepare("delete * from likes where user_id = :id;");
    $statementComments = $conn->prepare("delete * comments from users where user_id = :id;");
    $statement = $conn->prepare("delete * from users where email = :email;");
    
    $statementProject->bindValue("id",$id);
    $statementLike->bindValue("id",$id);
    $statementComments->bindValue("id",$id);
    $statement->bindValue("email",$_SESSION["email"]);
   
    $statementProject->execute();
    $statementLike->execute();
    $statementComments->execute();
    $statement->execute();
    header("Location: login.php");
?>


