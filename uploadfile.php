<?php 
session_start();
if(!isset($_SESSION['sessionID'])) {
    header("location:./login.php?error=login");
}
include './includes/functions.php';
if(isset($_POST['submit'])) {
    if(file_exists($_FILES['fileUpload']['tmp_name']) || is_uploaded_file($_FILES['fileUpload']['tmp_name'])) {
        if($_FILES["fileUpload"]["size"] < 10000000) {      //checks if filesize is less than 10mb
            $uploadFileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES["fileUpload"]["tmp_name"]);
            $fileTypes = ["text/csv", "text/plain"];
            if(in_array($uploadFileType, $fileTypes)) {     //checks filetype
                if(!$_FILES["fileUpload"]["error"] > 0) {   //checks for errors
                    echo $_FILES["fileUpload"]["tmp_name"];
                    echo "<br>";
                    $linesArray = file($_FILES["fileUpload"]["tmp_name"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);   //gets temporary file path and retrieves file contents per line (array)
                    include './includes/database.php';
                    foreach($linesArray as $line) {
                        echo "<br>";
                        $valuesArray = explode(";", $line);
                        $room = $valuesArray[0];
                        // if(validateTime($valuesArray[1])) { THE CHECKS DON'T WORK FOR SOME REASON?
                        $startTime = $valuesArray[1];
                        // }
                        // else {
                        //     var_dump($valuesArray[1]);
                        // }
                        //if(validateTime($valuesArray[2])) {
                        $endTime = $valuesArray[2];
                        //}
                        // else {
                        //     var_dump($valuesArray[2]);
                        // }
                        if(validateDate($valuesArray[3])) {
                            $datetemp = $valuesArray[3];
                            $date = substr($datetemp, 6, 4) . "-" . substr($datetemp, 3, 2)  . "-" . substr($datetemp, 0, 2);
                        }
                        $occupancy = $valuesArray[4];
                        if(is_numeric($occupancy)) {    //Checks if occupancy is numeric so first line in array is ignored
                            echo $room . " " . $startTime . " " . $endTime . " " . $date . " " . $occupancy . " ";
                            $floorNr = intval(substr($room, 0, 1));
                            $roomNr = intval(substr($room, 2, 5));
                            //VALIDATION work in progress!!!!!!!!!!!!!!!!!!!!!
                            $sql = "SELECT id FROM room WHERE room_nr = ? AND floor_nr = ?";
                            
                            if($stmt = mysqli_prepare($conn, $sql)) {
                                mysqli_stmt_bind_param($stmt, "ss", $roomNr, $floorNr);
                                if(mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $roomId);
                                    mysqli_stmt_store_result($stmt);
                                    if(mysqli_stmt_num_rows($stmt) != 0) {
                                        while(mysqli_stmt_fetch($stmt)) {
                                            echo $roomId;
                                        }
                                        echo "<br>";
                                    }
                                    else{
                                        echo "Room does not exist";
                                    }
                                }
                                else{
                                    $error = "Error: " . mysqli_error($conn);
                                    die($error);
                                }
                                mysqli_stmt_close($stmt);
                            }
                            
                            $sql = "INSERT INTO booking (user_id, room_id, occupancy, start_time, end_time, date) VALUES (?,?,?,?,?,?)";
                            
                            if($stmt = mysqli_prepare($conn, $sql)) {
                                mysqli_stmt_bind_param($stmt, "ssssss", $_SESSION['sessionID'], $roomId, $occupancy, $startTime, $endTime, $date);
                                if(!mysqli_stmt_execute($stmt)) {
                                    $error = "Error: " . mysqli_error($conn);
                                    die($error);
                                }
                                echo " Added booking";
                                mysqli_stmt_close($stmt);
                            }
                        }
                    }
                    header('location:./scheduleupload.php?success=upload');
                }
                else{
                    echo "Error: " . $_FILES["fileUpload"]["error"] . "<br />";
                    die();
                }
                mysqli_close($conn);
            }
            else{
                header('location:./scheduleupload.php?error=type');
            }
        }
        else{
            header('location:./scheduleupload.php?error=size');
        }
    }
    else{
        header('location:./scheduleupload.php?error=upload');
    }
}
else{
    header('location:./scheduleupload.php?error=how');
}

?>