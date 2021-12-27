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
        <div class="bigBox">
            <h1>File upload test</h1>
            <a href="./download/scheduleTemplate.xlsx" download>
                <button class="squareButton" >
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
                    echo "<p class='warning'>Please make sure the file is a .csv file.</p>";
                }
            }
            if(isset($_GET['success'])) {
                if($_GET['success'] == 'upload') {
                    echo "<p class='success'>Upload successful!</p>";
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
