<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$db_name = "vekabestwebsite";
?>
<html lang="en">
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE = edge">
   <meta name="viewport" content="width = device-width, initial-scale = 1">
   <title>login</title>
   <link href="VekaBest.css" rel="stylesheet" type="text/css">
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
 </head>
<body>

<div class="opvulling">

<a href="http://localhost/VekaBest/index.php"><button type="button" class="btn"> <span class="glyphicon glyphicon-home"></span>Home</button></a>

<?php
$Connect = mysqli_connect($host, $username, $password, $db_name);

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<div class="formulier">
  <form action="user_login.php" method="post">
    <label>Email</label>
    <br>
    <input type="text" placeholder="Email" name="UsernameText"/>
    <br>
    <label>Wachtwoord</label>
    <br>
    <input type="password" placeholder="Wachtwoord" name="PasswordText" />
    <br>
    <br>
    <input type="submit" value="Login" name="submit"/>
  </form>
</div>
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
            $_SESSION["Userlogin"] = $username;
            $_SESSION["Login"] = true;
            $_SESSION["LoggedIn"] = true;
          header("location: index.php");
        } else if ($count == 1 && $row[3] == "admin") {
            $_SESSION["Userlogin"] = $username;
            $_SESSION["admin"] = true;
            $_SESSION["Login"] = true;
            $_SESSION["LoggedIn"] = true;
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
    </div>
  </body>
</html>
