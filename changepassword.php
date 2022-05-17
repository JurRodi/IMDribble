<?php 

    include_once(__DIR__. "/bootstrap.php");

    //modal section
    if(isset($_POST['ChangePassword'])){
        $oldPassword = $_POST['oldPwd'];
        $newPassword = $_POST['newPwd'];
        $passwordConfirm = $_POST['confirmPwd'];

        if(password_verify($oldPassword, $user['password'])){
            if($newPassword === $passwordConfirm){
                User::changePassword($user["email"], $newPassword);
            }
            else{
                $error = "Passwords do not match!";
            }
        }
        else{
            $error = "Old password is incorrect";
        }
    }


?>