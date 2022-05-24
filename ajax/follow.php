<?php 
    include_once(__DIR__ . "/../classes/Follow.php");
    include_once(__DIR__ . "/../classes/User.php");
    session_start();
    if(!empty($_POST)){
        
        $follow = new Follow();
        $user = User::getUserByEmail($_SESSION['email']);
        $follow->setUser1($user['id']);
        $follow->setUser2($_POST['followedUser']);
        $follow->save();

        $response = [
            'status' => 'succes',
            'message' => 'Follow saved'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    };

?>