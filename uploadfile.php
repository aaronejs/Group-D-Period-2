<?php 

    if($_FILES["uploadedFile"]["size"] < 10000000) {
        $fileTypes = ["text/csv"];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $uploadedFileType = finfo_file($fileInfo, $_FILES["uploadedFile"]["tmp_name"]);

        if(in_array($uploadedFileType, $fileTypes)) {
            if($_FILES["uploadedFile"]["error"] > 0) {
                echo "Error: " . $_FILES["uploadedFile"]["name"] . "<br />";
            }
            else{
                echo "yay I guess";
            }
        }
    }

?>