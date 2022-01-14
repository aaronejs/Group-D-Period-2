<?php 
session_start();
if(!isset($_SESSION['sessionID'])) {
    header("location:./login.php?error=login");
}
date_default_timezone_set('Europe/Amsterdam');
include './includes/functions.php';
if(isset($_POST['submit'])) {
    if(file_exists($_FILES['fileUpload']['tmp_name']) || is_uploaded_file($_FILES['fileUpload']['tmp_name'])) {
        if($_FILES["fileUpload"]["size"] < 10000000) {      //checks if filesize is less than 10mb
            $uploadFileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES["fileUpload"]["tmp_name"]);
            $fileTypes = ["text/csv", "text/plain"];
            if(in_array($uploadFileType, $fileTypes)) {     //checks filetype
                if(!$_FILES["fileUpload"]["error"] > 0) {   //checks for errors
                    $linesArray = file($_FILES["fileUpload"]["tmp_name"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);   //gets temporary file path and retrieves file contents per line (array)
                    include './includes/database.php';      //database connection
                    $errorNo = 0;                           //sets number of errors to 0 before loop starts
                    $existsNo = 0;                          //number of rooms unavailable at that time
                    $attemptsNo = 0;                        //number of attempts
                    foreach($linesArray as $line) {         //every line of file in array
                        $valuesArray = explode(";", $line); //every value of line in array
                        if(count($valuesArray) == 5) {      //checks if expected amount of values is present
                            if(is_numeric($valuesArray[4]) && validateTime($valuesArray[1]) && validateTime($valuesArray[2]) && validateDate($valuesArray[3])) {    //Checks if occupancy is numeric so first line in array is ignored and so lines are ignored that have incorrect values.
                                $attemptsNo++;
                                if(filter_var($valuesArray[0], FILTER_VALIDATE_FLOAT)) {
                                    $room = $valuesArray[0];
                                }
                                else{
                                    $room = filter_var($valuesArray[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);      //corrects accidental letters and such (rooms with letters are not supported currently)
                                }
                                $startTime = $valuesArray[1];
                                $endTime = $valuesArray[2];
                                $datetemp = $valuesArray[3];
                                $date = substr($datetemp, 6, 4) . "-" . substr($datetemp, 3, 2)  . "-" . substr($datetemp, 0, 2);
                                $occupancy = $valuesArray[4];
                                $floorNr = intval(substr($room, 0, 1));
                                $roomNr = intval(substr($room, 2, 5));
                                $sql = "SELECT id FROM room WHERE room_nr = ? AND floor_nr = ?";
                                if($stmt = mysqli_prepare($conn, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "ss", $roomNr, $floorNr);
                                    if(mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $roomId);
                                        mysqli_stmt_store_result($stmt);
                                        if(mysqli_stmt_num_rows($stmt) != 0) {
                                            mysqli_stmt_fetch($stmt);
                                        }
                                        else{
                                            $existsNo++;                //errors related to room not existing
                                            mysqli_stmt_close($stmt);
                                            continue;
                                        }
                                    }
                                    else{
                                        $error = "Error: " . mysqli_error($conn);
                                        die($error);
                                    }
                                    mysqli_stmt_close($stmt);
                                }

                                $sql = "SELECT id FROM booking WHERE room_id = ? AND (`date` = ?) AND (start_time <= ?) AND (end_time >= ?)";   //checks if room is available for selected time
                                
                                if($stmt = mysqli_prepare($conn, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "ssss", $roomId, $date, $endTime, $startTime);
                                    if(mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $bookingId);
                                        mysqli_stmt_store_result($stmt);
                                        if(mysqli_stmt_num_rows($stmt) != 0) {
                                            $errorNo++;                 //errors related to room not being available at that time
                                            mysqli_stmt_close($stmt);
                                            continue;
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
                                    mysqli_stmt_bind_param($stmt, "iiisss", $_SESSION['sessionID'], $roomId, $occupancy, $startTime, $endTime, $date);
                                    if(!mysqli_stmt_execute($stmt)) {
                                        $error = "Error: " . mysqli_error($conn);
                                        die($error);
                                    }
                                    mysqli_stmt_close($stmt);
                                }
                            }
                            else{
                                continue;
                            }
                        }
                    }
                    header('location:./scheduleupload.php?success=upload&error=' . $errorNo . '&exists=' . $existsNo . '&attempts=' . $attemptsNo);
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