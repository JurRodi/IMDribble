<?php
    require_once('../bootstrap.php');
    session_start();
    if(!empty($_POST)){
        $user_id = User::getUserByEmail($_SESSION['email'])['id'];
        if(Like::isLiked($_POST['postId'], $user_id) === false){
            Like::saveLike($_POST['postId'], $user_id);
            $total = Like::CountLikes($_POST['postId']);
            
            $response = [
                "status" => "succes",
                "message" => "Like was succesvol",
                "totallikes" => $total
            ];
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else{
            Like::removeLike($_POST['postId'], $user_id);
            $total = Like::CountLikes($_POST['postId']);
            
            $response = [
                "status" => "succes",
                "message" => "Unlike was succesvol",
                "totallikes" => $total
            ];
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }