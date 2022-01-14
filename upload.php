<?php
session_start();
include './includes/database.php';
if(!isset($_SESSION['sessionID'])){
  header("location:./login.php?error=login");
}
$uploadedFileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES["uploadedFile"]["tmp_name"]);
$acceptedFileTypes = ["image/jpg", "image/jpeg", "image/png"];
$fileinfo = @getimagesize($_FILES["uploadedFile"]["tmp_name"]);
$width = $fileinfo[0];
$height = $fileinfo[1];

if(in_array($uploadedFileType, $acceptedFileTypes)) {
    if ($_FILES["uploadedFile"]["error"] > 0) {
        header("location: ./index.php?error=image");
    }elseif ($_FILES["uploadedFile"]["size"] > 20000000) {
        header("location: ./index.php?error=image_size");
    }elseif (strlen($_FILES["uploadedFile"]["name"])>=20) {
        header("location: ./index.php?error=image");
    }elseif ($width > "800" && $height > "800") {
        header("location: ./index.php?error=image_dimension");
    }elseif (file_exists("./resources/profilePictures/" . $_FILES["uploadedFile"]["name"])){
        header("location: ./index.php?error=image");
    }elseif(move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], "./resources/profilePictures/". $_FILES["uploadedFile"]["name"])){
        $sql = "UPDATE `user` SET `image` = ? WHERE `user`.`id` = ?;";
        if($stmt = mysqli_prepare($conn, $sql)){
          mysqli_stmt_bind_param($stmt, "ss", $_FILES["uploadedFile"]["name"], $_SESSION['sessionID']);
          if(!mysqli_stmt_execute($stmt)){
						$error = "Error executing query" . mysqli_error($conn);
						die();
          }else{
            mysqli_stmt_close($stmt); //close statement
            mysqli_close($conn); //close connection
            header("location: ./profile.php");
          }
        }
    }else{
        header("location: ./index.php?error=image");
    }
}else{
    header("location: ./index.php?error=image_type");
}
?>
