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

      $query = "SELECT * FROM orders ORDER BY ordernum";
      if ($result = mysqli_query($con, $query)) {
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) {
          $row['ordernum'] = $row['0'];
          printf("<tr class=\"orders-table\" data-toggle=\"modal\" data-target=\"#AdressPopup-" . $row['0'] . "\" ");
          printf("<td class='tr-inv'></td>");
          printf("<td class='tr-inv'>" . $row['0'] . "</td>");
          printf("<td class='tr-inv'>" . $row['1'] . "</td>");
          printf("<td class='tr-inv'>" . $row['2'] . "</td>");
          printf("<td class='tr-inv'>" . $row['3'] . "</td>");
          printf("<td class='tr-inv'>" . $row['4'] . "</td>");
          printf("<td class='tr-inv'>" . $row['5'] . "</td>");
          printf("<td class='tr-inv'>" . $row['6'] . "</td>");
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
