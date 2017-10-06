<?php
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
   <title>Registratie</title>
   <link href="vekabest.css" rel="stylesheet" type="text/css">
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
    <form action="user_registration.php" method="post">
      <label>Voornaam</label>
    <br>
      <input type="text" placeholder="Voornaam" name="VoorNaam"/>
    <br>
      <label>Achternaam</label>
    <br>
      <input type="text" placeholder="Achternaam" name="AchterNaam"/>
    <br>
      <label>Email (Dit wordt uw inlog naam)</label>
    <br>
      <input type="text" placeholder="Email" name="UsernameText"/>
    <br>
      <label>Wachtwoord</label>
    <br>
      <input type="password" placeholder="Wachtwoord" name="PasswordText" />
    <br>
      <label>Herhaal wachtwoord</label>
    <br>
      <input type="password" placeholder="Wachtwoord" name="ReEnterPasswordText" />
    <br>
      <label>Adres</label>
    <br>
      <input type="text" placeholder="Adres" name="Adres" id="Adres"/>
      <input type="text" placeholder="Huisn." name="HuisNummer" id="HuisNummer"/>
    <br>
      <label>Postcode</label>
    <br>
      <input type="text" placeholder="Postcode" name="PostCode" />
    <br>
      <label>Telefoonnummer</label>
    <br>
      <input type="text" placeholder="Telefoonnummer" name="TelefoonNummer" />
    <br>
    <br>
      <input type="submit" value="Registreren" name="submit"/>
    </form>
  </div>

<?php
  if (isset($_POST['submit'])) {
    //if the username is empty
    if (empty($_POST['UsernameText'])) {
      echo "Voer uw email adres in";
    }
    //if the password is empty
    elseif (empty($_POST['PasswordText'])) {
      echo "Voer een wachtwoord in";
    }
    //if the reentered password is empty
    elseif (empty($_POST['ReEnterPasswordText'])) {
      echo "Voer uw wachtwoord opnieuw in";
    }
    //if the adres is left empty
    elseif (empty($_POST['Adres'])) {
      echo "Voer uw adres in";
    }
    //if field is left empty
    elseif (empty($_POST['HuisNummer'])) {
      echo "Voer uw huisnummer in";
    }
    //if field is left empty
    elseif (empty($_POST['PostCode'])) {
      echo "Voer uw postcode in";
    }
    //if field is left empty
    elseif (empty($_POST['TelefoonNummer'])) {
      echo "Voer uw Telefoonnummer in";
    }
    elseif (empty($_POST['VoorNaam'])) {
      echo "Voer uw voornaam in";
    }
    elseif (empty($_POST['AchterNaam'])) {
      echo "Voer uw achternaam in";
    }
      //initilize
      $VoorNaam = $_POST['VoorNaam'];
      $AchterNaam = $_POST['AchterNaam'];
      $Username = $_POST['UsernameText'];
      $Password = $_POST['PasswordText'];
      $RePassword = $_POST['ReEnterPasswordText'];
      $Adres = $_POST['Adres'];
      $HuisNummer = $_POST['HuisNummer'];
      $PostCode = $_POST['PostCode'];
      $TelefoonNummer = $_POST['TelefoonNummer'];
      //check if the password and the reentered password are t he same
      if($Password == $RePassword) {
        //search for a username in the db with the entered username
        $sql =  "SELECT username FROM `users` WHERE username='$Username'";

        $result = mysqli_query($Connect, $sql);
        $count = mysqli_num_rows($result);

        //if the count is 1 the username already exists and will throw a messages
        if($count == 1) {
          echo "Usename already exists";
        } else {
          //select the last row of the db by id
          $sql =  "SELECT * FROM `users` ORDER BY `id` DESC LIMIT 1;";
          $result = mysqli_query($Connect, $sql);
          $sql1 =  "SELECT * FROM `user_info` ORDER BY `id` DESC LIMIT 1 ;";
          $result1 = mysqli_query($Connect, $sql1);
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
          $sql = "INSERT INTO `users`(`id`, `username`, `password`, `type`) VALUES ('$Id','$Username','$hash','user')";
          $result = mysqli_query($Connect, $sql);
          $sql1 = "INSERT INTO `user_info`(`id`, `adres`, `huisnummer`, `postcode`, `telefoonnummer`, `voornaam`, `achternaam`) VALUES ('$Id','$Adres','$HuisNummer','$PostCode','$TelefoonNummer', '$VoorNaam', '$AchterNaam')";
          $result1 = mysqli_query($Connect, $sql1);
          header("location: index.php");
        }
      } else {
        echo "Passwords are not the same";
      }

  }
 ?>
      </div>
    </body>
 </html>
