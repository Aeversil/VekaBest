<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "vekabestwebsite";

$Connect = mysqli_connect($host, $username, $password, $db_name);

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

session_start();
?>
<form action="user_login.php" method="post">
  <label>UserName</label>
  <br>
  <input type="text" placeholder="Username" name="UsernameText"/>
  <br>
  <label>Password</label>
  <br>
  <input type="password" name="PasswordText" />
  <br>
  <br>
  <input type="submit" value="Login" name="submit"/>
</form>
<?php
if (isset($_POST['submit'])) {
  //If its empty say the Username or password is incorrect else go on
  if (empty($_POST['UsernameText'])) {
    echo "Username or password is incorrect";
  } else {
    //Get username and password from the boxes
    $username = $_POST['UsernameText'];
    $password = $_POST['PasswordText'];

    //select the password from the username that has been given
    $sql = "SELECT password FROM `users` WHERE username='$username'";
    $result = mysqli_query($Connect, $sql);
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
      $result = mysqli_query($Connect, $sql);
      //chec how many results
      $count = mysqli_num_rows($result);

      //if the result is one then go to the index.php
      while ($row = mysqli_fetch_row($result)) {
        if ($count == 1 && $row[3] == "user") {
          header("location: index.php");
        } else if ($count == 1 && $row[3] == "admin") {
          $_SESSION["admin"] = true;
          header("location: admin_index.php");
        } else {
          echo "Username or password is incorrect";
        }
        mysqli_free_result($result);
    }
  }
}
}

?>
