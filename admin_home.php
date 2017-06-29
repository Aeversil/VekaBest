<div id="admin_home" style="display: none">

<?php
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

    <form class="form-horizontal" role="form" action="VekaBestAdmin.php" method="post" enctype="multipart/form-data">
     Boekprijs: <input type="VALUES" name="boekprijs" placeholder="boekprijs"></br>
     <input type="hidden" name="size" value="3500000"></br>
     Foto upload: <input type="File" name="boekafbeelding" placeholder="boekprijs"></br>
     Boeknaam: <input type="text" name="boeknaam" placeholder="boeknaam"></br>
     Maak categorie keuze: <select name="boeksoort">
       <option type="text"value="">-</option>
       <option type="text" value="auto">auto</option>
       <option type="text" value="brommer">brommer</option>
       <option type="text" value="motor">motor</option>
       <option type="text" value="vrachtwagen">vrachtwagen</option>
       <option type="text" value="bus">bus</option>
       <option type="text" value="spiegels">spiegels</option>
     <!-- <input type="text" name="boeksoort" placeholder="boeksoort"> -->
     </select></br>
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
        <!-- <div class="banner"><img src="stockvekafotos/busbanner.jpg"></img></div> -->
        <!-- NAVIGATIE BALK -->
        <div class="navigation">
          <button class="HomeButton"onclick="openPage('MainPage')">Home</buttons>
          <button onclick="openPage('Contact')">Contact</button>
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
          <button href="admin_edit.php">Gebruikers</button>
        </div>

    <div id="MainPage" class="pagina">
      <textarea>

      </textarea>
      <button>Verzend</button>

    </div>
    </div>
