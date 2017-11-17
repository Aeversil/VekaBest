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
      background-color: #f2f2f2
    }

    th {
      background-color: #00adff;
      color: white;
    }
  </style>
  <?php
    $rootDir = @dirname(FILE); //TODO: I suppressed an error here.
    $photoFolder = "fotouploads/";
    $photoUpPath = $rootDir . "/" . $photoFolder;
    //$path = $photoUpPath.
    //$dbpath = $photoFolder.


    // Create target folder if it doesn't exist yet
    if (!is_dir($photoUpPath)) {
      mkdir($photoUpPath);
    }
  ?>
  <button id='add' data-toggle='modal' data-target='#AddModel'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'> </i></button>
  <div id="AddModel" class="modal fade" role="dialog">
    <form action="admin_index.php" enctype="multipart/form-data" method="post">
      <div class="modal-dialog">
    <!-- Modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Boek toevoegen</h4>
          </div>
          <div class="modal-body">
              Boekprijs:
            <br />
              <input required type="values" name="boekprijs" placeholder="boekprijs">
            <br />
              <input required type="hidden" name="size" value="3500000">
            <br />
              Foto upload:
            <br />
              <input required type="file" name="boekafbeelding">
            <br />
              Boeknaam:
            <br />
              <input required type="text" name="boeknaam" placeholder="boeknaam">
            <br /><br />
              Maak categorie keuze:
            <br />
            <select required name="boeksoort">
              <option type="text" value="">-</option>
              <option type="text" value="auto">auto</option>
              <option type="text" value="brommer">brommer</option>
              <option type="text" value="motor">motor</option>
              <option type="text" value="vrachtwagen">vrachtwagen</option>
              <option type="text" value="bus">bus</option>
              <option type="text" value="spiegels">spiegels</option>
            </select>
          </br></br>
            Boeknummer:
          </br>
            <input required type="values" name="boeksku" placeholder="boeksku">
            <div class="modal-footer">
              <input type="submit" name="toevoegen" value="Toevoegen"  class="btn btn-default">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <?php
    $con= mysqli_connect($host, $username, $password, $db_name);

    if (isset($_POST["toevoegen"])) {
      $boeknaam = $_POST['boeknaam'];
      $boeksoort = $_POST['boeksoort'];

      $target = $photoUpPath . $_FILES['boekafbeelding']['name'];
      $file = $_FILES['boekafbeelding'];

      $photoPath = mysql_real_escape_string($photoFolder . $_FILES['boekafbeelding']['name']);
      //$target = $photoPath.

      $boekprijs = $_POST['boekprijs'];
      $boeksku = $_POST['boeksku'];

      print_r($_FILES['boekafbeelding']);

      move_uploaded_file( $_FILES['boekafbeelding']['tmp_name'], $target);

      $sql = "INSERT INTO boeken (boekprijs, boekafbeelding, boeknaam, boeksoort, boeksku) VALUES ('$boekprijs', '$photoPath', '$boeknaam', '$boeksoort', $boeksku)";
      mysqli_query($con, $sql);
    }

    if (isset($_POST["EditUser"])) {
      $id = $_POST["editId"];
      $name = $_POST["editName"];
      $type = $_POST["editType"];

      $sql = 'UPDATE `users` SET `username`="' . $name . '",`type`="' . $type . '" WHERE `id`="' . $id . '"';
      mysqli_query($con, $sql);
    }

    if (isset($_POST["DeleteBoek"])) {
      $id = $_POST["deleteBoekId"];

      $sql = 'DELETE FROM `boeken` WHERE `boekid`=' . $id;
      mysqli_query($con, $sql);
    }
  ?>
  <table style="width: 100%;">
    <thead>
      <tr>
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
      $query = "SELECT * FROM boeken ORDER BY `boekid`";

      if ($result = mysqli_query($con, $query)) {
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) {
          $row['id'] = $row['0'];
          printf("<tr>");
          printf("<td>" . $row['3'] . "</td>");
          printf("<td>" . $row['4'] . "</td>");
          printf("<td><img src=" . $row['2'] . " height='120' width='80'></td>");
          printf("<td>" . $row['1'] . "</td>");
          printf("<td>" . $row['5'] . "</td>");
          printf("<td><button onclick='BoekEdit(" . $row["1"] . ",\"" . $row['3'] . "\",\"" . $row['5'] . "\",\"" . $row['0'] . "\")' id='change' data-toggle='modal' data-target='#EditBoekModel'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'> </i></button></td>");
          printf("<td><button onclick='Delete(" . $row["0"] . ", \"" . $row["3"] . "\")' id='change' data-toggle='modal' data-target='#deleteModal2'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></button></td>");
          printf("</tr>");
        }
        // Free result set
        mysqli_free_result($result);
      }

      if(isset($_POST['BoekEdit'])) {
        $id = $_POST["EditBoekId"];
        $prijs = $_POST["EditBoekPrijs"];
        $naam = $_POST["EditBoekNaam"];
        $sku = $_POST["EditBoekSku"];

        $sql = 'UPDATE `boeken` SET `boekprijs`="' . $prijs . '",`boeknaam`="' . $naam . '", `boeksku`="' . $sku . '" WHERE `boekid`="' . $id . '"';
        mysqli_query($con, $sql);
      }
      ?>
    </tbody>

    <!-- Modal -->
    <div id="EditBoekModel" class="modal fade" role="dialog">
      <form action="admin_index.php" enctype="multipart/form-data" method="post">
        <div class="modal-dialog">
      <!-- Modal content -->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Boek bijwerken</h4>
            </div>
            <div class="modal-body">
                Boek Id:
              <br />
                <input required readonly id="EditBoekId" type="text" name="EditBoekId" placeholder="boek id" style="width: 25px; padding: 2px; text-align: center; color: gray; border: 1px solid gray; background-color: lightgray;">
              <br /><br />
                Boekprijs:
              <br />
                <input required id="EditBoekPrijs" type="text" name="EditBoekPrijs" placeholder="boekprijs">
              <br />
                <input required type="hidden" name="size" value="3500000">
              <br />
                Boeknaam:
              <br />
                <input required id="EditBoekNaam" type="text" name="EditBoekNaam" placeholder="boeknaam">
            <br /><br />
              Boeknummer:
            </br>
              <input required id="EditBoekSku" type="text" name="EditBoekSku" placeholder="boeksku">
              <div class="modal-footer">
                <input type="submit" name="BoekEdit" value="Bijwerken"  class="btn btn-default">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- Modal -->
    <div id="deleteModal2" class="modal fade" role="dialog">
      <form method="post" action="admin_index.php">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Weet u zeker dat u <i id="deleteShowName">boek</i> wilt verwijderen?</h4>
            </div>
            <div class="modal-body">
              <input type="text" id="deleteId" name="deleteBoekId" readonly value="id" style="width: 25px; padding: 2px; text-align: center; color: gray; border: 1px solid gray; background-color: lightgray;"/>
              <input type="text" id="deleteName" name="deleteBoekName" placeholder=" name"  style="margin-bottom: 5px;"/><br/>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
              <input type="submit" value="Verstuur" name="DeleteBoek" class="btn btn-default" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </table>
  <script type="text/javascript">
    function BoekEdit(prijs, naam, sku, id) {
      document.getElementById("EditBoekPrijs").setAttribute("value", prijs);
      document.getElementById("EditBoekNaam").setAttribute("value", naam);
      document.getElementById("EditBoekSku").setAttribute("value", sku);
      document.getElementById("EditBoekId").setAttribute("value", id);
    }

    function Delete(id, name) {
      document.getElementById("deleteBoekId").setAttribute("value", id);
      document.getElementById("deleteBoekName").setAttribute("value", name);
      document.getElementById("deleteShowName").innerHTML = name;
    }
  </script>
</div>
