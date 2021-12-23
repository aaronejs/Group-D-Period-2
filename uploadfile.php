<?php 
if(isset($_POST['submit'])) {
    if(!empty($_POST['fileUpload'])) {
        if($_FILES["fileUpload"]["size"] < 10000000) {
            $fileTypes = ["text/csv"];
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $uploadedFileType = finfo_file($fileInfo, $_FILES["uploadedFile"]["tmp_name"]);

            if(in_array($uploadedFileType, $fileTypes)) {
                if($_FILES["uploadedFile"]["error"] > 0) {
                    echo "Error: " . $_FILES["uploadedFile"]["name"] . "<br />";
                    die();
                }
                else{
                    echo "yay I guess";
                }
            }
        }
        else{
            //header('location:./fileuploadtest.php?error=size');
        }
    }
    else{
      //  header('location:./fileuploadtest.php?error=upload');
    }
}
else{
    //header('location:./fileuploadtest.php?error=how');
}
var_dump($fileInfo, $uploadedFileType);
echo "huh?";
?>