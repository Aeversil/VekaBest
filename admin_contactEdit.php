<div id="admin_contactEdit" style="display: none">
  <h3>&nbsp;Edit contact tekst</h3>
  <form method="post" action="admin_index.php">
    <textarea name="Text" style='min-height: 300px; min-width: 900px; max-height: 300px; max-width: 900px;'><?php
      $con = mysqli_connect($host, $username, $password, $db_name);
      $query = "SELECT text FROM `info` WHERE `page`='contact'";
      if($result = mysqli_query($con, $query))
      {
        while ($row = mysqli_fetch_row($result))
        {
          echo $row[0];
        }
      }
       ?></textarea>
    <input type="submit" name="SaveButton" value="Save" id="SaveButton">
  </form>
</div>
<?php
if (isset($_POST["SaveButton"])) {
  $Contact = $_POST["Text"];
  $con = mysqli_connect($host, $username, $password, $db_name);
  $query = "UPDATE `info` SET `text`='$Contact' WHERE `page`='contact'";
  mysqli_query($con, $query);
}
 ?>
