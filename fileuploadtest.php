<!DOCTYPE html>
<html lang="en">
<head>
  <title>File upload test</title>
<!--
</head>
<body>
-->
    <?php
    include './includes/header.php'; // header
    ?>
    <main>
        <div class="bigBox">
            <h1>File upload test</h1>
            <form action="./fileuploadtest.php" method="post">
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
  </div>
</body>
</html>
