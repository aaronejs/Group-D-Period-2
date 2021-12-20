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
    ?>
    <main>
        <div class="bigBox">
            <h1>File upload test</h1>
            <form action="./uploadfile.php" method="post" enctype="multipart/form-data">
                <label for="fileUpload" class="fileUploadButton">
                    <input type="file" name="fileUpload" id="fileUpload">
                    <p>Upload file</p>
                </label>
                <button type="submit" class="roundButton">
                    <img src="./resources/UploadImage.png" class="roundButtonImg" alt="Upload Image">
                </button>
            </form>
        </div>
    </main>
    <?php
    include './includes/footer.html'; // footer
    ?>
</body>
</html>
