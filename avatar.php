<?php 

    include_once(__DIR__. "/bootstrap.php");
    $conn = Db::getConnection();
    $statusMsg = '';
    $targetDir = "avatars/";

    if(isset($_POST['submit'])){
        if(!empty($_FILES["avatar"]["name"])){
            $fileName = basename($_FILES["avatar"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif');

            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)){
                    $insert = $conn->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
                    $insert->bindValue(':avatar', $fileName);
                    $insert->bindValue(':id', $user['id']);
                    $insert->execute();
                    if($insert){
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

?>