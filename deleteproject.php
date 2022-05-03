<?php
    include_once(__DIR__. "/bootstrap.php");
    $id = $_GET["id"];
    $delete = Project::deleteProject($id);
    header("Location: index.php");
    ?>