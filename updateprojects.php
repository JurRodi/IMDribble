<?php
    include_once(__DIR__. "/bootstrap.php");
    $id = $_GET["id"];
    $project = Project::updateProject($id);
    header("Location: index.php");
    ?>



