<html>
    <head>
    </head>
    <body>
        <form method="POST" action="images_post.php" enctype="multipart/form-data">
            Select the images to upload:
            <input type="file" name="files[]" id="files" multiple>
            <input type="hidden" name="submitform" value="true">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>
</html>