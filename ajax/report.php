<?php 
     include_once(__DIR__ . "/../classes/Report.php");
     include_once(__DIR__ . "/../classes/User.php");
     session_start();
    if (!empty($_POST)) {
        $user = User::getUserByEmail($_SESSION['email']);
        $user_id = $user['id'];
        $reportuser_id = $_POST['reportuser_id'];
        $project_id = $_POST['project_id'];
        $complaint = $_POST['complaint'];
        
        $report = new Report();
        $report->setUserId($user_id);
        $report->setReportuserId($reportuser_id);
        $report->setProjectId($project_id);
        $report->setComplaint($complaint);
        $report->sendComplaint($user_id);

        $response = [ 
            "status" => "success",
            "message" => "You have succesfully reported this user/item."
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }      
    
