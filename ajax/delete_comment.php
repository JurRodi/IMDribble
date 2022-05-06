<?php 
    include_once(__DIR__ . "/../classes/Comment.php");
    include_once(__DIR__ . "/../classes/User.php");
    session_start();
    if(!empty($_POST)){
        $c = new Comment();
        $c->setId($_POST['commentId']);
        $c->delete();

        $response = [
            'status' => 'succes',
            'message' => 'Comment deleted'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    };

?>