<!-- MainPage van VekaBest -->
<?php
  $host="localhost";
  $username="root";
  $password="";
  $db_name="vekabestwebsite";
 // MAKEN EN MOGELIJK Maken VAN HET UPLOADEN VAN FOTO'S \\
  $dir = dirname(__FILE__);
  $target = "fotouploads";
  $path = $dir . "\\" . $target . "\\";
  $dbpath = $target . "\\";
  // Create target folder if it doesn't exist yet
  if(!is_dir($path)){
    mkdir($path);
  }else{
    // echo "<br>Directory already exists</br>";
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
    <form class="form-horizontal" role="form" action="VekaBestAdmin.php" method="post" enctype="multipart/form-data">
     Boekprijs: <input type="VALUES" name="boekprijs" placeholder="boekprijs">
     <input type="hidden" name="size" value="3500000">
     Foto upload: <input type="File" name="boekafbeelding" placeholder="boekprijs">
     Boeknaam: <input type="text" name="boeknaam" placeholder="boeknaam">
     Maak categorie keuze: <select name="boeksoort">
     <option type="text" value="auto">auto</option>
       <option type="text" value="brommer">brommer</option>
       <option type="text" value="motor">motor</option>
       <option type="text" value="vrachtwagen">vrachtwagen</option>
       <option type="text" value="bus">bus</option>
       <option type="text" value="spiegels">spiegels</option>
     <!-- <input type="text" name="boeksoort" placeholder="boeksoort"> -->
     </select>
     Boeknummer: <input type="VALUES" name="boeksku" placeholder="boeksku">
     <input type="submit" value="Upload">
    </form>
    <?php
      // var_dump ();
      $conn = new mysqli($host, $username, $password, $db_name);
      if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            if ($_SERVER['REQUEST_METHOD']== "POST"){
              if (isset($_POST['boekprijs']) && ($_FILES['boekafbeelding']) && ($_POST['boeknaam']) && ($_POST['boeksoort']) && ($_POST['boeksku'])) {

                $boekprijs = $_POST['boekprijs'];
                $target =  $path . $_FILES['boekafbeelding']['name'];
                $file = $_FILES['boekafbeelding'];
                $dbtarget =  mysql_real_escape_string ($dbpath . $_FILES['boekafbeelding']['name']);
                $boeknaam = $_POST['boeknaam'];
                $boeksoort = $_POST['boeksoort'];
                $boeksku = $_POST['boeksku'];

                file_put_contents($target, $file);
                $escaped_target = mysql_real_escape_string($target);
                $sql = "INSERT INTO boeken (boekprijs, boekafbeelding, boeknaam, boeksoort, boeksku) VALUES ($boekprijs, '$dbtarget', '$boeknaam', '$boeksoort', $boeksku)";
                if (move_uploaded_file($_FILES['boekafbeelding']['tmp_name'], $target)){
                  echo "Uploaden van artikel gelukt";
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


    <div class="Fullpage">
      <!-- <div class="linkerbanner"><img src="stockvekafotos/stockbanner.jpg"></img></div> -->
        <div class="banner"><img src="stockvekafotos/busbanner.jpg"></img></div>
        <!-- NAVIGATIE BALK -->
        <div class="navigation">
          <button class="HomeButton"onclick="openPage('MainPage')">Home</buttons>
          <button onclick="openPage('BioGraphie')">Biographie</button>
          <!-- DROPDOWN MENU MET EEN SCRIPT -->
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
                ?>
                <div class='artikel'>
                <?php
                echo "<img src=".$row["boekafbeelding"]."></img><span>Productnummer: ".$row["boeksku"]. "</span><span>Boek: " .$row["boeknaam"]. "</span><span>Prijs: €" . $row["boekprijs"]."</span>";
                ?>
                <form action="VekaBestAdmin.php" method="$_POST">
                  <button class="verwijder"><img src="stockvekafotos/trashcan.png">
                    <?php
                    if(isset($_POST['delete'])){
                      mysql_query("DELETE FROM boeken WHERE boeksoort = '".$_POST['boeksoort']."'");
                    }
                    ?>
                  </button>
                </form>
              </div>
                <?php
              }
            }else{
              echo "0 resultaten";
            }

            ?>
        </div>
        <div id="WebShopBrommer" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if($conn->connect_error){
            die("Connection failed:". $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'brommer' ORDER BY boeksoort";
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
        <div id="WebShopMotor" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if($conn->connect_error){
            die("Connection failed:". $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'motor' ORDER BY boeksoort";
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
        <div id="WebShopVrachtwagen" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if($conn->connect_error){
            die("Connection failed:". $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'vrachtwagen' ORDER BY boeksoort";
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
        <div id="WebShopBus" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if($conn->connect_error){
            die("Connection failed:". $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'bus' ORDER BY boeksoort";
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
        <div id="Spiegels" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if($conn->connect_error){
            die("Connection failed:". $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'spiegels' ORDER BY boeksoort";
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
        <div id="WinkelWagen" class="pagina">
          <p>Hier komt te staan wat mensen hebben bestelt </p>
        </div>
        <?php
          $conn->close();
        ?>
        <!-- <div class="rechterbanner"><img src="stockvekafotos/stockbanner.jpg"></img></div> -->
    </div>
  </body>
</html>
