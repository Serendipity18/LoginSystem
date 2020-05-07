<?php 
require 'include/dbh.inc.php';
?>

<html>

<head>
    <h1 align="center" style="background-color: white;">Audio Files</h1>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--    <link rel="stylesheet" href="style.css">-->
</head>

<body>
    <form id="dropdown" method="GET">
        <label for="order">Order By:</label>
        <select name="order">
            <option value="<?=$descending?>">Descending</option>
            <option value="<?=$ascending?>">Ascending</option>
        </select>

        <input type="submit" name="form" value="Submit">
    </form>


    <center style="background-color: white;">
        <?php
        
    switch($_GET['form']){
        case $descending:
            $query = mysqli_query($conn, "SELECT * FROM audio_files ORDER BY idSubDate DESC;");
            dumpDatabase($query);
            break;
        case $ascending:
            $query = mysqli_query($conn, "SELECT * FROM audio_files ORDER BY idSubDate ASC;");
            dumpDatabase($query);
            break;
        default:
            $query = mysqli_query($conn, "SELECT * FROM audio_files;");
            dumpDatabase($query);
            break;
    }
        
        function dumpDatabase($query){
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                print "<h3>".$row['idTitle']."</h3>\n";
            
                //sets the destination of the current file to where it is stored in audio_files
                $destination = "audio_files/".$row['idTitle'];

                print "<p>".$row['idAuthor']."</p>";
                print "<p>".$row['idDesc']."</p>";
                print "<p>".$row['idSubDate']."</p>";

                //audio player on screen
                print "<audio controls><source src=" ."'$destination'". "type=audio/mpeg></audio>";

                //creates a download attibute to the file
                print "<a href="."'$destination'"."download> download </a>";
            }

        }

?>
    </center>

</body>

</html>
