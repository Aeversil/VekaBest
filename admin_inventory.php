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
  // MAKEN EN MOGELIJK Maken VAN HET UPLOADEN VAN FOTO'S \
  $dir = @dirname(FILE); //TODO: I suppressed an error here.
  $target = "fotouploads";
  $path = $dir . "/" . $target . "/";
  $dbpath = $target . "/";
  // Create target folder if it doesn't exist yet
  if (!is_dir($path)) {
    mkdir($path);
  } else {
    // echo "<br>Directory already exists</br>";
  }
  ?>
  <button id='add'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'> </i></button>
  <div id="myModal" class="modal">
    <!-- In dit deel van de code kan je artikelen  -->
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <link rel="stylesheet" type="text/css" href="">
      <div id="forminvoer">
        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
          Boekprijs:
          </br>
          <input type="VALUES" name="boekprijs" placeholder="boekprijs"></br>
          <input type="hidden" name="size" value="3500000">
          </br>
          Foto upload:
          </br>
          <input type="File" name="boekafbeelding" placeholder="boekprijs">
          </br>
          Boeknaam:
          </br>
          <input type="text" name="boeknaam" placeholder="boeknaam">
          </br></br>
          Maak categorie keuze:
          </br>
          <select name="boeksoort">
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
          <input type="VALUES" name="boeksku" placeholder="boeksku">
          </br></br>
          <input type="submit" name="toevoegen" value="Toevoegen">
        </form>
      </div>
    </div>
  </div>
  <?php
  // var_dump ();
  $conn = new mysqli($host, $username, $password, $db_name);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if (isset($_POST["Zoeken"])) {
    $boekprijs = $_POST['boekprijs'];
    $target = $path . $_FILES['boekafbeelding']['name'];
    $file = $_FILES['boekafbeelding'];
    $dbtarget = mysql_real_escape_string($dbpath . $_FILES['boekafbeelding']['name']);
    $boeknaam = $_POST['boeknaam'];
    $boeksoort = $_POST['boeksoort'];
    $boeksku = $_POST['boeksku'];

    file_put_contents($target, $file);
    $escaped_target = mysql_real_escape_string($target);
    $sql = "INSERT INTO boeken (boekprijs, boekafbeelding, boeknaam, boeksoort, boeksku) VALUES ($boekprijs, '$dbtarget', '$boeknaam', '$boeksoort', $boeksku)";
    if (move_uploaded_file($_FILES['boekafbeelding']['tmp_name'], $target)) {
      //echo "Uploaden van artikel gelukt";
    } else {
      //echo "";
    }
    if ($conn->query($sql) === TRUE) {
      // die();
    }
  }
  mysqli_close($conn);
  ?>
  <!-- MODAL SCRIPT VOOR TOEVOEGEN ARTIKELEN  -->
  <script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("add");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function () {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

  <?php

  $con = new mysqli($host, $username, $password, $db_name);
  if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }

  // $search = $_POST['search']; //TODO: I suppressed an error here.
  $query = "SELECT * FROM boeken ORDER BY boeksoort ASC";
  // --------NIET VERWIJDEREN-------
  // WHERE (boeksoort LIKE '%$search%')
  // --------NIET VERWIJDEREN-------
  ?>
  <div id="zoeken">
    <form  method="post" id="searchform">
      <h4>Zoek op categorie:</h4>
      <input type="text" id="input-search" name="search" value="">
      <input type="submit" id="btn" name="Zoeken" value="Zoeken">
    </form>
  </div>

  <table>
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
      </div>
    <?php
    // UITLEZEN VAN PRODUCTEN
    if ($result = mysqli_query($con, $query)) {
      // Fetch one and one row
      while ($row = mysqli_fetch_row($result)) {
        $id = $row['0'];
        $name = $row['3'];
        $categorie = $row['4'];
        $afbeelding = $row['2'];
        $prijs = $row['1'];
        $sku = $row['5'];
        printf("<tr>");
        printf("<td>" . $row['3'] . "</td>");
        printf("<td>" . $row['4'] . "</td>");
        printf("<td><img src=" . $row['2'] . " height='120' width='80'></td>");
        printf("<td>" . $row['1'] . "</td>");
        printf("<td>" . $row['5'] . "</td>");
        ?>
        <td><button id="myAboutBtn-<?= $id ?>" onclick="myAboutBtn(<?= $id ?>);"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></button></td>

        <td><button id="myDelBtn-<?= $id ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button></td>

        <?php
        printf("</tr>");
        ?>
        <!-- AANPASSEN VAN PRODUCTEN -->
        <div id="myAboutModal-<?= $id ?>" class="myAboutModal">
          <!-- Modal content -->
          <div class="modal-content2">
            <span id="close2 close2-<?= $id ?>" class="close2-<?= $id ?> close2">&times;</span>
            <link rel="stylesheet" type="text/css" href="">
            <div id="forminvoer">
              <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                Boekprijs:
                </br>
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="VALUES" name="boekprijs2" value="<?= $prijs ?>"></br>
                <input type="hidden" name="size" value="3500000">
                </br>
                Foto upload:
                </br>
                <input type="File" name="boekafbeelding2" value="<?= $afbeelding ?>">
                </br>
                Boeknaam:
                </br>
                <input type="text" name="boeknaam2" value="<?= $name ?>">
                </br></br>
                Maak categorie keuze:
                </br>
                <select name="boeksoort2">
                  <option type="text" value="<?= $categorie ?>"><?= $categorie ?></option>
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
                <input type="VALUES" name="boeksku2" value="<?= $sku ?>">
                </br></br>
                <input type="submit" name="bewerken" value="Bewerken">
              </form>
            </div>
          </div>
        </div>
        <script>
          // Get the modal
          //var myAboutModal = document.getElementById('myAboutModal-<?= $id ?>');

          // Get the button that opens the modal
          var myAboutBtn = document.getElementById("myAboutBtn-<?= $id ?>");

          // Get the <span> element that closes the modal
          var myAboutSpan = document.getElementsByClassName("close2-<?= $id ?>")[0];

          // When the user clicks the button, open the modal
          myAboutBtn.onclick = function () {
            document.getElementById('myAboutModal-<?= $id ?>').style.display = "block";
          }

          // When the user clicks on <span> (x), close the modal
          myAboutSpan.onclick = function () {
            document.getElementById('myAboutModal-<?= $id ?>').style.display = "none";
          }
        </script>

        <!-- DELETE SECTION -->
        <div id="myDelModal-<?= $id ?>" class="myDelModal">
          <!-- Modal content -->
          <div class="modal-content3">
            <span class="close3-<?= $id ?> close3">&times;</span>
            <link rel="stylesheet" type="text/css" href="">
            <div id="forminvoer">
              <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id2" value="<?= $id ?>">
                <h4>Wilt u echt het product verwijderen?</h4>
                </br>
                <input
                <?php
                $conndelete = new mysqli ($host, $username, $password, $db_name);
                if ($conndelete->connect_error){
                  die ("Connection failed: " . $conn->connect_error);
                }
                  $sql = "DELETE FROM boeken WHERE boekid = $id"
                ?>
                 type="submit" name="verwijderen" value="Verwijderen">
              </form>
            </div>
          </div>
        </div>
        <script>
          // Get the modal
          // var myDelModal = document.getElementById('myDelModal-<?= $id ?>');

          // Get the button that opens the modal
          var myDelBtn = document.getElementById("myDelBtn-<?= $id ?>");

          // Get the <span> element that closes the modal
          var myDelSpan = document.getElementsByClassName("close3-<?= $id ?>")[0];

          // When the user clicks the button, open the modal
          myDelBtn.onclick = function () {
            document.getElementById('myDelModal-<?= $id ?>').style.display = "block";
          }

          // When the user clicks on <span> (x), close the modal
          myDelSpan.onclick = function () {
            document.getElementById('myDelModal-<?= $id ?>').style.display = "none";
          }
        </script>
        <?php echo $id ?>
        <?php
      }
      // Free result set
      mysqli_free_result($result);
    }
//mysqli_close($con);
    ?>
    </tbody>
  </table>
</div>
