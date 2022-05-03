<?php
    include_once(__DIR__. "/bootstrap.php");
    session_start();
    $email = $_SESSION["email"];
    $user = User::getUserByEmail($email);
    $id = $user["id"];
    $delete = User::deleteUser($id,$email);
    header("Location: login.php");
?>



