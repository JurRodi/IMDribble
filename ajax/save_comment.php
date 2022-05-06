<?php 
    include_once(__DIR__ . "/../classes/Comment.php");
    include_once(__DIR__ . "/../classes/User.php");
    session_start();
    if(!empty($_POST)){
        $c = new Comment();
        $c->setPostId($_POST['postId']);
        $c->setText($_POST['text']);
        $user = User::getUserByEmail($_SESSION['email']);
        $username = $user['username'];
        $c->setUserId($user['id']);
        $c->save();

        $response = [
            'status' => 'succes',
            'body' => htmlspecialchars($c->getText()),
            'username' => htmlspecialchars($username),
            'message' => 'Comment saved'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    };

?>