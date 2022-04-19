<?php 

    include_once(__DIR__. "/bootstrap.php");
    $conn = Db::getConnection();
    $statusMsg = '';
    $targetDir = "images/";

    if(isset($_POST['submit'])){
        if(!empty($_FILES["image"]["name"])){
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif');

            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                    if(isset($_POST['title'])){
                        $user_id = $user['id'];
                        $project_id = Project::addProject($user_id);
                        uploadImage($fileName, $project_id);
                        $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                        header("Loacation: index.php");
                    }elseif(!isset($_POST['title'])){
                        avatarQuery($fileName, $user['id']);
                        $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                    }else{
                        $statusMsg = "File upload failed, please try again.";
                    }
                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            }else{
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        }else{
            $statusMsg = 'Please select a file to upload.';
        }
    }

    function avatarQuery($avatar, $id){
        $conn = Db::getConnection();
        $insert = $conn->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
        $insert->bindValue(':avatar', $avatar);
        $insert->bindValue(':id', $id);
        $insert->execute();
        return true;
    }

    function uploadImage($fileName, $project_id){
        $conn = Db::getConnection();
        $insert = $conn->prepare("INSERT INTO images (fileName, project_id) VALUES (:fileName, :project_id)");
        $insert->bindValue(':fileName', $fileName);
        $insert->bindValue(':project_id', $project_id);
        $insert->execute();
        return true;
    }
?>