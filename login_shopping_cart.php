<?php
/**
 * Created by PhpStorm.
 * User: duncc
 * Date: 11/9/2017
 * Time: 12:55 PM
 */

echo 'Bob will be filled by Steffan';
if (isset($_POST['loginModal'])) {
    //If its empty say the Username or password is incorrect else go on
    if (empty($_POST['loginModalEmail'])) {
        echo "Username or password is incorrect";
    } else {
        //Get username and password from the boxes
        $username = $_POST['loginModalEmail'];
        $password = $_POST['loginModalPass'];

        //select the password from the username that has been given
        $sql = "SELECT password FROM `users` WHERE username='$username'";
        $result = mysqli_query($connect, $sql);
        $hashed_password = "";
        //get the info from the rows
        while ($row = $result->fetch_assoc()) {
            //put the hashed password in a var
            $hashed_password = $row['password'];
        }

        //check if the given password and the hashed password matches
        if (password_verify($password, $hashed_password)) {
            //select everything with a search for the username
            $sql = "SELECT * FROM `users` WHERE username='$username'";
            $result = mysqli_query($connect, $sql);
            //chec how many results
            $count = mysqli_num_rows($result);

            //if the result is one then go to the index.php
            while ($row = mysqli_fetch_row($result)) {
                if ($count == 1 && $row[3] == "user") {
                    $_SESSION["Userlogin"] = $username;
                    $_SESSION["Login"] = true;
//                                header("location: index.php");
                } else if ($count == 1 && $row[3] == "admin") {
                    $_SESSION["Userlogin"] = $username;
                    $_SESSION["admin"] = true;
                    $_SESSION["Login"] = true;
//                                header("location: admin_index.php");
                } else {
                    echo "Username or password is incorrect";
                }
                mysqli_free_result($result);
            }
        }
    }
}