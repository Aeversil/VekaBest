<div id="admin_users" style="display: none">
  <?php
    $con= mysqli_connect($host, $username, $password, $db_name);

    if (isset($_POST["EditUser"])) {
      $id = $_POST["editId"];
      $name = $_POST["editName"];
      $type = $_POST["editType"];

      $sql = 'UPDATE `users` SET `username`="' . $name . '",`type`="' . $type . '" WHERE `id`="' . $id . '"';
      mysqli_query($con, $sql);
    }

    if (isset($_POST["DeleteUser"])) {
      $id = $_POST["editId"];

      $sql = 'DELETE FROM `users` WHERE `id` ' . $id;
      mysqli_query($con, $sql);
    }
  ?>
  <table style="width: 100%;">
    <thead>
      <tr>
        <th>ID </th>
        <th>Gebruikersnaam </th>
        <th>Type </th>
        <th>Bewerken</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM users ORDER BY id";

      if ($result = mysqli_query($con, $query)) {
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) {
          $row['id'] = $row['0'];
          printf("<tr>");
          printf("<td>" . $row['0'] . "</td>");
          printf("<td>" . $row['1'] . "</td>");
          printf("<td>" . $row['3'] . "</td>");
          printf("<td><button onclick='Edit(" . $row["0"] . ", \"" . $row["1"] . "\", \"" . $row['3'] . "\")' id='change' data-toggle='modal' data-target='#editModal'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'> </i></button></td>");
          printf("<td><button onclick='Delete(" . $row["0"] . ", \"" . $row["1"] . "\")' id='change' data-toggle='modal' data-target='#deleteModal'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></button></td>");
          printf("</tr>");
        }
        // Free result set
        mysqli_free_result($result);
      }
      mysqli_close($con);
      ?>
    </tbody>
    <!-- Modal -->
    <div id="editModal" class="modal fade" role="dialog">
      <form method="post" action="admin_index.php">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit user</h4>
            </div>
            <div class="modal-body">
              <input type="text" id="editId" name="editId" readonly value="id" style="width: 25px; padding: 2px; text-align: center; color: gray; border: 1px solid gray; background-color: lightgray;"/>
              <input type="text" id="editName" name="editName" placeholder=" name"  style="margin-bottom: 5px;"/><br/>
              <input type="radio" id="editRadioUser" name="editType" value="user">gebruiker</input>
              <input type="radio" id="editRadioAdmin" name="editType" value="admin">administrator</input>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
              <input type="submit" value="Verstuur" name="EditUser" class="btn btn-default" />
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
      <form method="post" action="admin_index.php">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Weet u zeker dat u <i id="deleteShowName">username</i> wilt verwijderen?</h4>
            </div>
            <div class="modal-body">
              <input type="text" id="deleteId" name="deleteId" readonly value="id" style="width: 25px; padding: 2px; text-align: center; color: gray; border: 1px solid gray; background-color: lightgray;"/>
              <input type="text" id="deleteName" name="deleteName" placeholder=" name"  style="margin-bottom: 5px;"/><br/>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
              <input type="submit" value="Verstuur" name="DeleteUser" class="btn btn-default" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </table>
  <!-- Made by Sander Nieuwenhuisen, Sander van Osch is a fraud -->
  <script type="text/javascript">
    function Edit(id, name, type) {
      document.getElementById("editId").setAttribute("value", id);
      document.getElementById("editName").setAttribute("value", name);
      if (type == "admin")
        document.getElementById("editRadioAdmin").setAttribute("checked", "true");
      else
        document.getElementById("editRadioUser").setAttribute("checked", "true");
    }

    function Delete(id, name) {
      document.getElementById("deleteId").setAttribute("value", id);
      document.getElementById("deleteName").setAttribute("value", name);
      document.getElementById("deleteShowName").innerHTML = name;
    }
  </script>
</div>
