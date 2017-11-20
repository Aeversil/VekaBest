<div id="webshop_vrachtwagen" style="display: none">
  <div class="panel-color-orange">
    <h1>Webshop Vrachtwagen</h1>
    <?php
    $conn = new mysqli($host, $username, $password, $db_name);

    if ($conn->connect_error) {
        echo("Connection failed:" . $conn->connect_error);
    }
    $sql = "SELECT boeksoort, boeksku, boeknaam, boekafbeelding, boekprijs FROM boeken WHERE boeksoort LIKE 'vrachtwagen' ORDER BY boeksoort";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        ?>
          <div class='artikel'>
              <?php
              echo "<img src=" . $row["boekafbeelding"] . "></img><span>Productnummer: " . $row["boeksku"] . "</span><span>Boek: " . $row["boeknaam"] . "</span><span>Prijs: €" . $row["boekprijs"] . "</span>";
              ?>
              <!-- ACTION MOET WORDEN INGEVULD MET LATERE PHP PAGINA -->
            <form action=".php" method="$_POST">
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
</div>
