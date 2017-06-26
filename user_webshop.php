<div id="user_webshop" style="display: none">
  <?php
    // Create connection
    $conn = new Mysqli($host, $username, $password, $db_name);
    // Check connection
    if ($conn->connect_error) {
      echo "Connection failed: " . $conn->connect_error;
    }


    $sql = "SELECT DISTINCT boeksoort FROM `boeken` WHERE 1;";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_row($result)) {
      echo $row[0];
      echo "<br>";
    }
    mysqli_free_result($result);


    $conn->close();
  ?>
</div>
