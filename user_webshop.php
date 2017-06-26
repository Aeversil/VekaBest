<div id="user_webshop" style="display: none">
  <?php
    // Create connection
    $conn = new mysqli($db_name, $username, $password);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Create database
    $sql = "SELECT DISTINCT boeksoort FROM `boeken`  WHERE 1 ";
    if ($conn->query($sql) === TRUE) {
      $result = $conn->query($sql);
    } else {
      echo "Error creating database: " . $conn->error;
    }

    $conn->close();
  ?>
</div>
