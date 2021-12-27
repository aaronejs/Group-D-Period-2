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
                    echo "How did we get here?";
                }
                if($_GET['error'] == 'upload') {
                    echo "Please upload a file before pressing the upload button.";
                }
                if($_GET['error'] == 'size') {
                    echo "Please make sure the size of the file is less than 10Mb!";
                }
                if($_GET['error'] == 'type') {
                    echo "Please make sure the file is a .csv file.";
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
