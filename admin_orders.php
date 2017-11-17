<style>
  .tr-inv {
    text-align: left;
    padding: 8px;
  }
</style>
<div id="admin_orders" style="display: none">
  <table>
    <thead>
      <tr>
        <th class="th-inv">Order number</th>
        <th class="th-inv">Boek Id</th>
        <th class="th-inv">User Id</th>
        <th class="th-inv">Aantal</th>
        <th class="th-inv">Totaal</th>
        <th class="th-inv">Status</th>
        <th class="th-inv">Datum</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $con = mysqli_connect($host, $username, $password, $db_name);
      $query = "SELECT * FROM ((user_info INNER JOIN orders ON user_info.id = orders.userid) INNER JOIN boeken ON boeken.boekid = orders.boekid)";

      if ($result = mysqli_query($con, $query)) {
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) {
          $row['ordernum'] = $row['7'];
          printf("<tr onclick='Edit(" . $row["9"] . ", \"" . $row["1"] . "\", \"" . $row["2"] . "\", \"" . $row["3"] . "\", \"" . $row["4"] . "\", \"" . $row["5"] . "\", \"" . $row["6"] . "\", \"" . $row["7"] . "\", \"" . $row["18"] . "\", \"" . $row["19"] . "\",)' data-toggle='modal' data-target='#info' class='orders-table'>");
          printf("<td class='tr-inv'>" . $row['7'] . "</td>");
          printf("<td class='tr-inv'>" . $row['8'] . "</td>");
          printf("<td class='tr-inv'>" . $row['9'] . "</td>");
          printf("<td class='tr-inv'>" . $row['10'] . "</td>");
          printf("<td class='tr-inv'>" . $row['11'] . "</td>");
          printf("<td class='tr-inv'>" . $row['12'] . "</td>");
          printf("<td class='tr-inv'>" . $row['13'] . "</td>");
          printf("</tr>");
        }
        // Free result set
        mysqli_free_result($result);
      }
      mysqli_close($con);
      ?>
    </tbody>
  </table>
  <div id="info" class="modal fade" role="dialog">
    <form method="post" action="admin_index.php">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">User Info</h4>
          </div>
          <div class="modal-body" style="height: 300px;">
            <div class="col-md-6" style="height: 24px; margin-left: -14px;">User Id:</div>
            <div class="col-md-6" style="height: 24px;"></div>

            <input readonly class="col-md-6" style="height: 24px;" type="text" id="IdOrder" value="id"/>
            <div class="col-md-6" style="height: 24px;"></div>

            <div class="col-md-6" style="height: 24px; margin-left: -14px;">Straat:</div>
            <div class="col-md-2" style="height: 24px;">Huisnummer:</div>
            <div class="col-md-4" style="height: 24px;"></div>

            <input readonly class="col-md-6" style="height: 24px;" type="text" id="AdresOrder" value="Adres"/>
            <input readonly class="col-md-6" type="text" id="HuisnumOrder" value="Huisnum" style="height: 24px; width: 50px; text-align: left;"/>

            <div class="col-md-6" style="height: 24px; margin-left: -14px;">Postcode:</div>
            <div class="col-md-2" style="height: 24px;">Plaatsnaam:</div>
            <div class="col-md-4" style="height: 24px;"></div>

            <input readonly class="col-md-6" style="height: 24px;" type="text" id="PostCOrder" value="Postcode" />
            <input readonly class="col-md-6" style="height: 24px;" type="text" id="PlaatsN" value="Plaatsnaam"/>

            <div class="col-md-6" style="height: 24px; margin-left: -14px;">Voornaam:</div>
            <div class="col-md-6" style="height: 24px;">Achternaam:</div>

            <input readonly class="col-md-6" style="height: 24px;" type="text" id="VoorNOrder" value="Voornaam" />
            <input readonly class="col-md-6" style="height: 24px;" type="text" id="AchterNOrder" value="Achternaam" />

            <div class="col-md-6" style="height: 24px; margin-left: -14px;">Telefoon nummer:</div>
            <div class="col-md-6" style="height: 24px;"></div>

            <input readonly class="col-md-6" style="height: 24px;" type="text" id="TeleOrder" value="Telefoon" />
            <div class="col-md-6" style="height: 24px;"></div>

            <div class="col-md-6" style="height: 24px; margin-left: -14px;">Boek:</div>
            <div class="col-md-6" style="height: 24px;">Soort:  </div>
            <input readonly class="col-md-6" style="height: 24px;" type="text" id="BoekNaam" value="Boeknaam" />
            <input readonly class="col-md-6" style="height: 24px;" type="text" id="BoekSoort" value="Boeksoort" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  function Edit(id, adres, huisnum, postcode, plaatsnaam, telefoon, voornaam, achternaam, boeknaam, boeksoort) {
    document.getElementById("IdOrder").setAttribute("value", id);
    document.getElementById("AdresOrder").setAttribute("value", adres);
    document.getElementById("HuisnumOrder").setAttribute("value", huisnum);
    document.getElementById("PostCOrder").setAttribute("value", postcode);
    document.getElementById("PlaatsN").setAttribute("value", plaatsnaam);
    document.getElementById("TeleOrder").setAttribute("value", telefoon);
    document.getElementById("VoorNOrder").setAttribute("value", voornaam);
    document.getElementById("AchterNOrder").setAttribute("value", achternaam);
    document.getElementById("BoekNaam").setAttribute("value", boeknaam);
    document.getElementById("BoekSoort").setAttribute("value", boeksoort);
  }
</script>
