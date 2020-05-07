<?php
require 'header.php';

if(isset($_SESSION['userId'])) { ?>
<html>

<head>
    <title>Podcast Upload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <center>
        <form id="podcast_upload" action="include/upload_logic.php" method="post" enctype="multipart/form-data">
            <h1>Submit a New Podcast</h1>
            <input class="form-control" type="text" name="title" placeholder="Title">
            <input class="form-control" type="text" name="author" placeholder="Author">
            <textarea class="form-control" rows="4" cols="50" name="description" id="description">Description for podcast.</textarea>
            <label for="submission_date">Submission Date</label>
            <input type="datetime-local" id="submission_date" name="submission_date">
            <input class="form-control" type="file" name="file">
            <input class="btn btn-dark btn-lg btn-block" type="submit" value="Upload Podcast" name="podcast_file">
        </form>
    </center>

</body>

</html>
<?php
}else { 
    header("Location: index.php");
}
?>
