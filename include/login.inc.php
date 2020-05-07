<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require 'dbh.inc.php';

    $username = $_POST['user'];
    $password = $_POST['pwd'];
    
    //if either the username field or password field are blank, take the user back to ../login.php
    if(empty($username) || empty($password)) {
        header("Location: ../login.html?error=emptyfields&user=".$username);
        exit();
    
    } else {
        //prepared statement to prevent against sqlinjections
        //this code checks if the users credentials are correct
        //these prepared statements check if the users input works with the data base but does not check if the results are empty
        $sql = "SELECT * FROM users WHERE uidUsers=? AND pwdUsers=?";
        
        //initializing with the connection
        $stmt = mysqli_stmt_init($conn);
        //if the statement did not like what it found, it will throw an error
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.html?error=sqlerror");
        
        } else {
            //binds the parameters into the sql statement
            mysqli_stmt_bind_param($stmt, "ss", $username, md5($password));
            
            //execute the statement to get a result from the database
            mysqli_stmt_execute($stmt);
            
            //saves the result into $result
            $result = mysqli_stmt_get_result($stmt);
            
            //checks to make sure it received results and compares it to the database
            if($row = mysqli_fetch_assoc($result)) {
                //if the username and the password hash match 
                if($username == $row['uidUsers'] && md5($password) == $row['pwdUsers']) {
                    //start a session for the user logged in
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    header("Location: ../upload_page.php?successfullogin=".$username);
                    exit();
                } else {
                    header("Location: ../login.html?error=wrongcredentials");
                }
              
            //else statement in the almost non existent chance that the pwd check is neither true or false, send the user back to the main page
            } else { 
                header("Location: ../login.html?error=wrongcredentials");
                exit();

            }
        }
    }

} else {
    header("Location: ../login.html");
    exit();
}

?>
