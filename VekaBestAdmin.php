<!-- MainPage van VekaBest -->
<?php
  $host="localhost";
  $username="root";
  $password="";
  $db_name="vekabestwebsite";

  $dir = dirname(__FILE__);
  $target = "fotouploads";
  $path = $dir . "\\" . $target . "\\";
  $dbpath = $target . "\\";
  // Create target folder if it doesn't exist yet
  if(!is_dir($path)){
    mkdir($path);
  }else{
    echo "<br>Directory already exists</br>";
  }
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

    <?php
      // var_dump ();
      $conn = new mysqli($host, $username, $password, $db_name);
      if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            // $boekprijs = "";
            // $boekafbeelding = "";
            // $boeknaam = "";
            // $boeksoort = "";
            // $boeksku = "";

            if ($_SERVER['REQUEST_METHOD']== "POST"){
              if (isset($_POST['boekprijs']) && ($_FILES['boekafbeelding']) && ($_POST['boeknaam']) && ($_POST['boeksoort']) && ($_POST['boeksku'])) {

                $boekprijs = $_POST['boekprijs'];
                // $boekafbeelding = ($_FILES['boekafbeelding']);

                $target =  $path . $_FILES['boekafbeelding']['name'];
                $file = $_FILES['boekafbeelding'];
                $dbtarget =  mysql_real_escape_string ($dbpath . $_FILES['boekafbeelding']['name']);
                $boeknaam = $_POST['boeknaam'];
                $boeksoort = $_POST['boeksoort'];
                $boeksku = $_POST['boeksku'];

                file_put_contents($target, $file);
                // $escaped_target = mysql_real_escape_string($target);
                $sql = "INSERT INTO boeken (boekprijs, boekafbeelding, boeknaam, boeksoort, boeksku) VALUES ($boekprijs, '$dbtarget', '$boeknaam', '$boeksoort', $boeksku)";
                if (move_uploaded_file($_FILES['boekafbeelding']['tmp_name'], $target)){
                  echo "the file". basename ($_FILES['boekafbeelding']['name']). "has been uploaded";
                }else{
                  echo "kutzooi";


                }
                if ($conn->query($sql) === TRUE) {
                  // die();

                  ?>
                    <strong>SUCCES</strong>
                  <?php
                }
              }
            }
            mysqli_close($conn);
     ?>
     <!-- DATABASE UPLOAD FORM -->
     <form class="form-horizontal" role="form" action="VekaBestAdmin.php" method="post" enctype="multipart/form-data">
      <input type="VALUES" name="boekprijs" placeholder="boekprijs">
      <input type="hidden" name="size" value="3500000">
      <input type="File" name="boekafbeelding" placeholder="boekprijs">
      <input type="text" name="boeknaam" placeholder="boeknaam">
      <input type="text" name="boeksoort" placeholder="boeksoort">
      <input type="VALUES" name="boeksku" placeholder="boeksku">
      <input type="submit">
     </form>

    <div class="Fullpage">
        <div class="banner"><img src="stockvekafotos/download.jpg"></img></div>
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
          <!-- <button class="WinkelWagen" onclick="openPage('WinkelWagen')">WinkelWagen</button> -->
          <button onclick="openPage('WinkelWagen')">WinkelWagen</button>
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
          //
          // if($conn->connect_error){
          //   die("Connection failed:". $conn->connect_error);
          // }
          // $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'brommer' ORDER BY boeksoort";
          // $result = $conn->query($sql);
          // if($result->num_rows > 0){
          //   while ($row = $result->fetch_assoc()){
          //     echo "<div class='artikel'><img src=".$row["boekafbeelding"]."></img><span>Productnummer: ".$row["boeksku"]. "</span><span>Boek: " .$row["boeknaam"]. "</span><span>Prijs: €" . $row["boekprijs"]."</span></div>";
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
          $conn->close();
        ?>
    </div>
  </body>
</html>
