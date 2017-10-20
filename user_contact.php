<div id="user_contact" style="display: none">
  <h1>User contact page</h1>
  <?php
  $con = mysqli_connect($host, $username, $password, $db_name);
  $query = "SELECT text FROM `info` WHERE `page`='contact'";
  if($result = mysqli_query($con, $query))
  {
    while ($row = mysqli_fetch_row($result))
    {
      echo $row[0];
    }
  }
   ?>
</div>
