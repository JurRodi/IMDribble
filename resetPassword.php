<?php 

    include_once(__DIR__. "/bootstrap.php");
    
    if(!isset($_GET['code'])){
        exit("Can't find page");
    }

    $code = $_GET['code'];

    $conn = DB::getConnection();
    $statement = $conn->prepare("SELECT * FROM resetPassword WHERE code = :code");
    $statement->bindValue(":code", $code);
    $statement->execute();
    $reset_info = $statement->fetch();

    if($statement->rowCount() == 0){
        exit("Can't find page");
    }

    if(strtotime($reset_info['request_time']) + 86400 < strtotime(date("Y-m-d H:i:s"))){
        $delete = $conn->prepare("DELETE FROM resetPassword WHERE code = :code");
        $delete->bindValue(":code", $code);
        $delete->execute();
        exit("Your link has expired");
    }

    if(isset($_POST['password'])){
        $password = $_POST['password'];
        $options = [ 
            'cost' => 14
        ];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT, $options);

        if(strlen($password)<=6){
            throw new Exception("Your password has to be at least 6 characters long");
        }

        $email = $statement->fetch()['email'];
        $stmt = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
        $stmt->bindValue(":password", $hashed_password);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $stmt1 = $conn->prepare("DELETE FROM resetPassword WHERE code = :code");
        $stmt1->bindValue(":code", $code);
        $stmt1->execute();
        header("Location: login.php");
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
</head>
<body>
    <form action="#" method="POST">
        <input type="password" name="password" placeholder="New password">
        <input type="submit" name="submit" value="Reset password">
    </form>
</body>
</html>