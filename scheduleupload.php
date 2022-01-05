<!DOCTYPE html>
<html lang="en">
<head>
    <title>File upload test</title>
    <?php
    	include './includes/head.html';
    ?>
</head>
<body>
    <?php
    include './includes/header.php';
    if(!isset($_SESSION['sessionID'])) {
        header("location:./login.php?error=login");
    }
    if($_SESSION['type'] != 'admin') {
        header("location:./index.php?error=type");
    }
    ?>
    <main>
        <div class="upload">
            <div class="uploadBox">
                <a href="./download/scheduleTemplate.xlsx" download>
                    <button class="smallSquareButton" id="downloadButton">
                        <p>Download template</p>
                    </button>
                </a>
                <form action="./uploadfile.php" method="post" enctype="multipart/form-data">
                    <label for="fileUpload" class="fileUploadButton">
                        <input type="file" name="fileUpload" id="fileUpload" required>
                        <p>Upload file</p>
                    </label>
                    <button type="submit" class="roundButton" name="submit">
                        <img src="./resources/UploadImage.png" class="roundButtonImg" alt="Upload Image">
                    </button>
                </form>
            </div>
            <div class="mainItem">
                <div class="mainItemText">
                    <h2>How to?</h2>
                    <p>You can upload your schedule below. Use the download button at the top of the page to download the template. When you have filled in all bookings, export the file to a <b>.csv</b> file. Any other file type will not work.<br><i>The only accepted file type is <b>.csv</b>.</i></p>
                </div>
                <img src="./resources/Relaxing.png" alt="Generic image">
            </div>
            <?php
            if(isset($_GET['error'])) {
                if($_GET['error'] == 'how') {
                    echo "<p class='warning'>How did we get here?</p>";
                }
                if($_GET['error'] == 'upload') {
                    echo "<p class='warning'>Please upload a file before pressing the upload button.</p>";
                }
                if($_GET['error'] == 'size') {
                    echo "<p class='warning'>Please make sure the size of the file is less than 10Mb!</p>";
                }
                if($_GET['error'] == 'type') {
                    echo "<p class='warning'>Please make sure the uploaded file is a .csv file.</p>";
                }
            }
            if(isset($_GET['success'])) {
                if($_GET['success'] == 'upload') {
                    echo "<p class='success'>Upload successful!</p>";
                }
            }
            if(isset($_GET['exists']) && isset($_GET['attempts']) && isset($_GET['error'])) {
                if(is_numeric($_GET['exists']) && is_numeric($_GET['attempts']) && is_numeric($_GET['error'])) {
                    if($_GET['error'] != 0 || $_GET['exists'] != 0) {
                        echo "<p class='warning'>" . $_GET['error'] + $_GET['exists'] . " out of " . $_GET['attempts'] . " bookings was / were not uploaded.</p>";
                        if($_GET['error'] >=1) {
                            echo "<p class='warning'>" . $_GET['error'] . " rooms were unavailable, please try again with another room.</p>";
                        }
                        if($_GET['exists'] >= 1) {
                            echo "<p class='warning'>" . $_GET['exists'] . " of the " . $_GET['attempts'] . " rooms you entered do / does not exist.";
                        }
                        echo "<p class='warning'>You can check your bookings in the booking section of your profile page to see which bookings were uploaded.</p>";
                    }
                    else {
                        echo "<p class='success'>All " . $_GET['attempts'] . " bookings were uploaded.</p>";
                    }
                }
            }
            ?>
        </div>
    </main>
    <?php
    include './includes/footer.html'; // footer
    ?>
</body>
</html>
