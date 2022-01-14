<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload Profile pic</title>
    </head>
    <body>
    <?php
        $uploadedFileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES["uploadedFile"]["tmp_name"]);
        $acceptedFileTypes = ["image/jpg", "image/jpeg", "image/png"];
        $fileinfo = @getimagesize($_FILES["uploadedFile"]["tmp_name"]);
        $width = $fileinfo[0];
        $height = $fileinfo[1];

        if(in_array($uploadedFileType, $acceptedFileTypes)) {
            if ($_FILES["uploadedFile"]["error"] > 0) {
                echo "Error: " . $_FILES["uploadedFile"]["error"] . "<br />";
            }elseif ($_FILES["uploadedFile"]["size"] > 20000000) {
                echo "Your file is too large.";
            }elseif (strlen($_FILES["uploadedFile"]["name"])<=50000000) {
                echo "File name is too large";
            }elseif ($width > "800" && $height > "800") {
                echo "Image dimension should be within 800X800."; 
            }elseif (file_exists("./resources/profile_pictures/" . $_FILES["uploadedFile"]["name"])){
                echo $_FILES["uploadedFile"]["name"] . " already exists. ";
            }elseif(move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], "./resources/profile_pictures/". $_FILES["uploadedFile"]["tmp_name"])){
                echo "Profile photo uploaded";
            }else{
                echo "Something went wrong while uploading.";
            }
        }else{
            echo "Invalid file type. Must be png, jpg or jpeg.";
        }
    ?>
    </body>
</html>
