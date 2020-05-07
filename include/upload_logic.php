<?php

require '../header.php';
require 'dbh.inc.php';

if(isset($_SESSION['userId'])) {
    $file = $_FILES['file'];


    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    //sets fileExt to the file extension of the file
    $fileExt = explode('.', $fileName);
    //in case the extension is uppcase, set it to lowercase 
    $fileActualExt = strtolower(end($fileExt));

    //sets the allowed extensions to be uploaded
    $allowed = array('m4a');

    //if the extension of the file matches what is allowed it will go to the next if statment
    if(in_array($fileActualExt, $allowed)) {
        //if there was no error in the file continue
        if($fileError === 0) {
            //if the file is less than 500MB start the upload
            if($fileSize < 500000000) {
                $title = $_POST['title'];
                $author = $_POST['author'];
                $description = $_POST['description'];
                $submission_date = $_POST['submission_date'];
                $fileDestination = '../audio_files/'.$title;
                
                $sql= "INSERT INTO audio_files(idTitle, idAuthor, idDesc, idSubDate) VALUES(?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "Error with the sql occurred";
                } else {
                    mysqli_stmt_bind_param($stmt, "ssss", $title, $author, $description, $submission_date);
                    //saves the data in the database
                    mysqli_stmt_execute($stmt);
                    //moves the file to the audio_files directory
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../index.php?success=uploadedfile");
                }
            } else {
            echo "This file is too large";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    }else {
        echo "You can only upload files with an m4a extension!";
    }

} else {
    header("Location: ../index.php");
}

session_destroy();

?>
