<div id="admin_homeEdit" style="display: none">
  <h3>&nbsp;Edit Home tekst</h3>
  <form method="post" action="admin_index.php">
    <textarea name="Text2" style='min-height: 300px; min-width: 900px; max-height: 300px; max-width: 900px;'><?php
      $con = mysqli_connect($host, $username, $password, $db_name);
      $query = "SELECT text FROM `info` WHERE `page`='home'";
      if($result = mysqli_query($con, $query))
      {
        while ($row = mysqli_fetch_row($result))
        {
          echo $row[0];
        }
      }
       ?></textarea>
    <input type="submit" name="SaveButton2" value="Save" id="SaveButton">
  </form>
</div>
<?php
if (isset($_POST["SaveButton2"])) {
  $Home = $_POST["Text2"];
  $con = mysqli_connect($host, $username, $password, $db_name);
  $query = "UPDATE `info` SET `text`='$Home' WHERE `page`='home'";
  mysqli_query($con, $query);
}
 ?>
