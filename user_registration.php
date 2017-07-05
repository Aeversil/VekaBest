<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "vekabestwebsite";

$Connect = mysqli_connect($host, $username, $password, $db_name);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<form action="user_registration.php" method="post">
    <label>UserName</label>
  <br>
    <input type="text" placeholder="Username" name="UsernameText"/>
  <br>
    <label>Password</label>
  <br>
    <input type="password" name="PasswordText" />
  <br>
    <label>Reenter Password</label>
  <br>
    <input type="password" name="ReEnterPasswordText" />
  <br>
  <br>
    <input type="submit" value="Login" name="submit"/>
</form>
<?php
  if (isset($_POST['submit'])) {
    //if the username is empty
    if (empty($_POST['UsernameText'])) {
      echo "Please fill in a Username";
    }
    //if the password is empty
    elseif (empty($_POST['PasswordText'])) {
      echo "Please fill in a Password";
    }
    //if the reentered password is empty
    elseif (empty($_POST['ReEnterPasswordText'])) {
      echo "Please reenter your password";
    }
    else {
      //initilize
      $username = $_POST['UsernameText'];
      $password = $_POST['PasswordText'];
      $RePassword = $_POST['ReEnterPasswordText'];
      //check if the password and the reentered password are the same
      if($password === $RePassword) {
        //search for a username in the db with the entered username
        $sql =  "SELECT username FROM `users` WHERE username='$username'";

        $result = mysqli_query($Connect, $sql);
        $count = mysqli_num_rows($result);

        //if the count is 1 the username already exists and will throw a messages
        if($count == 1) {
          echo "Usename already exists";
        } else {
          //select the last row of the db by id
          $sql =  "SELECT * FROM `users` ORDER BY `id` DESC LIMIT 1;";

          $result = mysqli_query($Connect, $sql);
          $Id = "";

          //put the id in a var
          while($row = $result->fetch_assoc()) {
            $Id = $row['id'];
          }

          //add 1 to the id so its unique
          $Id = $Id + 1;

          //hash the password
          $hash = password_hash($password, PASSWORD_DEFAULT);
          //and insert it into the database
          $sql = "INSERT INTO `users`(`id`, `username`, `password`, `type`) VALUES ('$Id','$username','$hash','user')";
          $result = mysqli_query($Connect, $sql);
          header("location: index.php");
        }
      } else {
        echo "Passwords are not the same";
      }
    }
  }
 ?>
