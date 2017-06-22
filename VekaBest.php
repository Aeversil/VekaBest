<!-- MainPage van VekaBest -->

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
        <!-- <div class="linkerbanner"><img src="stockvekafotos/stockbanner.jpg"></img></div> -->
      <div class="banner"><img src="stockvekafotos/busbanner.jpg"></img></div>
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
          <button onclick="openPage('WinkelWagen')">WinkelWagen</button>
      </div>

      <!-- DEZE PAGINA'S WORDT MET JAVASCRIPT UITGEVOERT KIJK IN Teste.js OVER HOE EN WAT -->
      <div id="MainPage" class="pagina">
        <p>VUL HIER TEKST IN</p>
        <p></p>
      </div>
      <div id="Contact" class="pagina">
        <p>CONTACT INFORMATIE</p>
      </div>
      <div id="WebShopAuto" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'auto' ORDER BY boeksoort";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              ?>
            <div class='artikel'>
                <?php
                echo "<img src=" . $row["boekafbeelding"] . "></img><span>Productnummer: " . $row["boeksku"] . "</span><span>Boek: " . $row["boeknaam"] . "</span><span>Prijs: €" . $row["boekprijs"] . "</span>";
                ?>
              <form action="VekaBest.php" method="$_POST">
                Aantal:<input type="text" name="aantal">
                <input type="image" src="stockvekafotos/winkelmand.png" width="25px" height="25px" border="0" alt="Submit" value="aantal"/>
              </form>
            </div>
            <?php
          }
        } else {
          echo "0 resultaten";
        }
        ?>
      </div>
      <div id="WebShopBrommer" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'brommer' ORDER BY boeksoort";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='artikel'><img src=" . $row["boekafbeelding"] . "></img><span>Productnummer: " . $row["boeksku"] . "</span><span>Boek: " . $row["boeknaam"] . "</span><span>Prijs: €" . $row["boekprijs"] . "</span></div>";
            }
          } else {
            echo "Er zijn op dit moment geen artikelen";
          }
          ?>
      </div>
      <div id="WebShopMotor" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'motor' ORDER BY boeksoort";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='artikel'><img src=" . $row["boekafbeelding"] . "></img><span>Productnummer: " . $row["boeksku"] . "</span><span>Boek: " . $row["boeknaam"] . "</span><span>Prijs: €" . $row["boekprijs"] . "</span></div>";
            }
          } else {
            echo "0 resultaten";
          }
          ?>
      </div>
      <div id="WebShopVrachtwagen" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'vrachtwagen' ORDER BY boeksoort";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='artikel'><img src=" . $row["boekafbeelding"] . "></img><span>Productnummer: " . $row["boeksku"] . "</span><span>Boek: " . $row["boeknaam"] . "</span><span>Prijs: €" . $row["boekprijs"] . "</span></div>";
            }
          } else {
            echo "0 resultaten";
          }
          ?>
      </div>
      <div id="WebShopBus" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'bus' ORDER BY boeksoort";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='artikel'><img src=" . $row["boekafbeelding"] . "></img><span>Productnummer: " . $row["boeksku"] . "</span><span>Boek: " . $row["boeknaam"] . "</span><span>Prijs: €" . $row["boekprijs"] . "</span></div>";
            }
          } else {
            echo "0 resultaten";
          }
          ?>
      </div>
      <div id="Spiegels" class="pagina">
          <?php
          $conn = new mysqli($host, $username, $password, $db_name);

          if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
          }
          $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'spiegels' ORDER BY boeksoort";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='artikel'><img src=" . $row["boekafbeelding"] . "></img><span>Productnummer: " . $row["boeksku"] . "</span><span>Boek: " . $row["boeknaam"] . "</span><span>Prijs: €" . $row["boekprijs"] . "</span></div>";
            }
          } else {
            echo "0 resultaten";
          }
          ?>
      </div>
      <div id="WinkelWagen" class="pagina">
        <p>Hier komt te staan wat mensen hebben bestelt </p>
        <p>Kijken of we met cookies aan het werk moeten gaan, zodat we bestellingen vast kunnen zetten en kunnen dumpen naardat bestel compleet is.</p>

      </div>
      <?php
      $conn->close();
      ?>
      <!-- <div class="rechterbanner"><img src="stockvekafotos/stockbanner.jpg"></img></div> -->
    </div>
  </body>
</html>
