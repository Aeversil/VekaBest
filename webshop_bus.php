<div id="webshop_bus" style="display: none">
  <div class="panel-color-orange">
    <h1>Webshop Bus</h1>
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
</div>
