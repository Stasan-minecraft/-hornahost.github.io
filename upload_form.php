<?php include("header.php"); ?>
<h1>Upload Files for Your Site</h1>
<form id="uploadForm" method="POST" action="upload.php" enctype="multipart/form-data">
    <input type="text" name="site_address" placeholder="Site Address (e.g. fantastik.com)" required><br>
    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required><br>
    <input type="file" id="video" name="video" accept="video/*" required><br>
    <button type="submit">Upload</button>
</form>
<?php include("footer.php"); ?>
