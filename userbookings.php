<!DOCTYPE html>
<html lang="en">
<head>
  <title>BookIT Stenden</title>
  <?php include './includes/head.html'; ?>
</head>
<body>
    <?php
    include './includes/header.php'; // header
    if(!isset($_SESSION['sessionID'])){
        header("location:./login.php?error=login");
    }
    ?>
    <main>
      <div class="bigBox">
        <h1>Bookings</h1>
        <?php
        include './includes/database.php';
        $sql = "SELECT B.room_id, B.start_time, B.end_time, B.date, R.room_nr, R.floor_nr
                FROM booking B 
                JOIN room R ON B.room_id=R.id
                WHERE B.user_id=?
                ORDER BY B.date ASC, B.start_time ASC;";
        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $_SESSION['sessionID']);
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $roomId, $startTime, $endTime, $date, $roomNr, $floorNr);
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) != 0) {
                    echo "<p>Number of bookings: " . mysqli_stmt_num_rows($stmt);
                    echo "<table id='userBookings'>";
                    echo "<th>   </th><th>   </th><th>   </th><th>   </th>";
                    while(mysqli_stmt_fetch($stmt)) {
                        $zeros = strlen($roomNr);
                        if($zeros == 1) {
                            $zero = "00";
                        }
                        elseif($zeros == 2) {
                            $zero = "0";
                        }
                        else{
                            $zero = "";
                        }
                        echo "<tr>";
                        echo "<td>" . $floorNr . "." . $zero.$roomNr . "</td>";
                        echo "<td>" . $startTime . "</td>";
                        echo "<td>" . $endTime . "</td>";
                        echo "<td>" . $date . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                else{
                    echo "<p class='warning'>No bookings found</p>";
                }
            }
            else{
                $error = "Error: " . mysqli_error($conn);
                die($error);
            }
            mysqli_stmt_close($stmt);
        }
        ?>
      </div>
    </main>
    <?php
    include './includes/footer.html'; // footer
    ?>
</body>
</html>
