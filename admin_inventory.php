<div id="admin_inventory" style="display: none">
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even){
      background-color: #f2f2f2;
    }

    th {
      background-color: #00adff;
      color: white;
    }
  </style>
  <?php
  $con = mysqli_connect($host, $username, $password, $db_name);
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $query = "SELECT * FROM boeken ORDER BY boeksoort";

  $id = $_POST['id'];
  $boeknaam = $_POST['boeknaam'];
  $categorie = $_POST['categorie'];
  $afbeelding = $_POST['afbeelding'];
  $prijs = $_POST['prijs'];
  $sku = $_POST['sku'];
  mysql_query("INSERT INTO boeken VALUES('$id', '$prijs', '$afbeelding', '$boeknaam', '$categorie', '$sku')");
  ?>
  <button onclick='Add()' id='add'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'> </i></button>
  <table>
    <thead>
      <tr>
        <th>ID </th>
        <th>Boeknaam </th>
        <th>Catergorie </th>
        <th>Afbeelding </th>
        <th>Prijs </th>
        <th>Sku </th>
        <th>Bewerken </th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      // if (is_int($_GET["id"]) {
      //     $query2 = "DELETE FROM boeken WHERE boekid =". $_GET["id"];
      //     $result2 = mysqli_query($con, $query2);
      // }
      if ($result = mysqli_query($con, $query)) {
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) {
          $row['id'] = $row['0'];
          printf("<tr>");
          printf("<td>" . $row['0'] . "</td>");
          printf("<td>" . $row['3'] . "</td>");
          printf("<td>" . $row['4'] . "</td>");
          printf("<td>" . $row['2'] . "</td>");
          printf("<td>" . $row['1'] . "</td>");
          printf("<td>" . $row['5'] . "</td>");
          printf("<td><button onclick='Change()' id='change'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'> </i></button></td>");
          printf("<td><button onclick='Delete()' id='change'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></button></td>");
          printf("</tr>");
        }
        // Free result set
        mysqli_free_result($result);
      }
      mysqli_close($con);
      ?>
    </tbody>
  </table>
</div>
