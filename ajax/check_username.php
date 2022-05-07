<?php 
    include_once(__DIR__ . "/../classes/User.php");
    session_start();
    if(!empty($_POST)){
        $user = User::getUserByUsername($_POST['username']);

        $response = [
            'status' => 'succes',
            'body' => $user,
            'message' => 'Email checked'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    };

?>