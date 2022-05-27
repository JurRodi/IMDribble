<?php 
    
    include_once(__DIR__ . "/../classes/Project.php");
    session_start();
    if(!empty($_POST)){
        
        $project = new Project();
        $project->addToShowcase($_POST["project"]);
       

        $response = [
            'status' => 'succes',
            'message' => 'Added to showcase'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    };

?>