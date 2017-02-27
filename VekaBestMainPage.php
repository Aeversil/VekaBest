<!-- MainPage van VekaBest -->
<?php
  $host="localhost";
  $username="root";
  $password="";
  $db_name="vekabestwebsite";

  mysql_connect($host, $username,$password) or die("database not found");
  mysql_select_db($db_name) or die ("Couldnt find database");
  error_reporting('E_ERROR!E_WORNING');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VekaBest</title>
  <script src="js/Teste.js"></script>
  <link href="VekaBest.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
  <body>
    <div class="Fullpage">
      <form action=VekaBestMainPage.php method=post enctype="multipart/form-data">
      <table border="0" cellspacing="0" align=center cellpadding="3" bordercolor="#cccccc">
      <tr>
      <td>File:</td>
      <td><input type="file" name="filep" size=45></td>
      </tr>
      <tr>
      <td colspan=2><p align=center>
      <input type=submit name=action value="Load">
      </td>
      </tr>
      </table>
      </form>
      <?php
        $folder = "";
          if ($_POST["action"] == "Load")
          {
            $folder = "vekabestfoto/";
            move_uploaded_file($_FILES["filep"]["tmp_name"].$_FILES["filep"]["name"]);

            echo "<p align = center>File".$_FILES["filep"]["name"]."loaded...";

            $result = new mysqli($host, $username, $password, $db_name) or die ("Could not save image name Error: " . mysql_error());

            mysql_select_db("vekabestwebsite") or die("Could not select database");
            mysql_query("INSERT into boeken (boekafbeelding) VALUES('".$_FILES['filep']['name']."')");

            if($result) { echo "Image name saved into database"; }
            else {

            //Gives and error if its not
            echo "Sorry, there was a problem uploading your file.";
            }
          }
          mysql_connect("localhost","root") or die ("could not save image name error". mysql_error());
          mysql_select_db("vekabestwebsite")or die("could not select database");
          $data = mysql_query("SELECT 'URL' FROM boeken") or die(mysql_error());
          $file_path = "http://localhost/vekabest/vekabestfoto/". $_FILES;

          while($row = mysql_fetch_assoc($data)){
            $src = $file_path . $row[''];
            echo "<img src=" . $src . ">";
          }
      ?>
        <div class="image"><img src="vekabestfoto/Placeholder.jpg"></img></div>
        <!-- NAVIGATIE BALK -->
        <div class="navigation">
          <button class="HomeButton"onclick="openPage('MainPage')">Home</buttons>
          <button onclick="openPage('BioGraphie')">Biographie</button>
          <div class="dropdown">
              <button onclick="dropdownmenu()" class="dropbtn">Webshop</button>
              <div id="mydropdown" class="dropdown-content">
              <!-- auto -->
              <a href="#" onclick="openPage('WebShopAuto')">Auto</a>
              <!-- brommer -->
              <a href="#" onclick="openPage('WebShopBrommer')">Brommer</a>
              <!-- motor -->
              <a href="#" onclick="openPage('WebShopMotor')">Motor</a>
              <!-- vrachtwagen -->
              <a href="#" onclick="openPage('WebShopVrachtwagen')">Vrachtwagen</a>
              <!-- bus -->
              <a href="#" onclick="openPage('WebShopBus')">Bus</a>
              <!-- spiegels -->
              <a href="#" onclick="openPage('Spiegels')">Spiegels</a>
            </div>
          </div>
          <button class="WinkelWagen" onclick="openPage('WinkelWagen')">WinkelWagen</button>
        </div>
        <!-- DEZE PAGINA'S WORDT MET JAVASCRIPT UITGEVOERT KIJK IN Teste.js OVER HOE EN WAT -->
        <div id="MainPage" class="pagina">
          <p>VUL HIER TEKST IN</p>
          <p></p>
        </div>
        <div id="BioGraphie" class="pagina">
          <p>HIER KOMT WAT ALLEEN WEET IK NOG NIET WAT</p>
        </div>
        <div id="WebShopAuto" class="pagina">
          <?php
            $conn = new mysqli($host, $username, $password, $db_name);

            if($conn->connect_error){
              die("Connection failed:". $conn->connect_error);
            }
            $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'auto' ORDER BY boeksoort";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
              while ($row = $result->fetch_assoc()){
                echo "<div class='artikel'><img src=".$row["boekafbeelding"]."></img><span>Productnummer: ".$row["boeksku"]. "</span><span>Boek: " .$row["boeknaam"]. "</span><span>Prijs: €" . $row["boekprijs"]."</span></div>";
              }
            }else{
              echo "0 resultaten";
            }
          ?>
        </div>
        <div id="WebShopBrommer" class="pagina">
          <?php
            // $conn = new mysqli($host, $username, $password, $db_name);
            // if($conn->connect_error){
            //   die("Connection failed:". $conn->connect_error);
            // }
            // $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'brommer' ORDER BY boeksoort";
            // $result = $conn->query($sql);
            // if($result->num_rows > 0){
            //   while ($row = $result->fetch_assoc()){
            //     echo "<div class='artikel'><img src='data:image/jpg;base64,".base64_encode($row["boekafbeelding"])."'></img><span>Productnummer: ".$row["boeksku"]. "</span><span>Boek: " .$row["boeknaam"]. "</span><span>Prijs: €" . $row["boekprijs"]."</span></div>";
            //   }
            // }else{
            //   echo "0 resultaten";
            // }
          ?>
        </div>
        <div id="WebShopMotor" class="pagina">
          <p>Dit is de WebShopMotor pagina</p>
        </div>
        <div id="WebShopVrachtwagen" class="pagina">
          <p>Dit is de WebShopVrachtwagen pagina</p>
        </div>
        <div id="WebShopBus" class="pagina">
          <p>Dit is de WebShopBus pagina</p>
        </div>
        <div id="Spiegels" class="pagina">
          <p>Dit is de Spiegels pagina</p>
        </div>
        <div id="WinkelWagen" class="pagina">
          <p>Hier komt te staan wat mensen hebben bestelt </p>
        </div>
        <?php
          $con->close();
        ?>
    </div>
  </body>
</html>
