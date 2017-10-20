<div id="user_home" style="display: block">
  <h1>User home page</h1>

  <?php
  $con = mysqli_connect($host, $username, $password, $db_name);
  $query = "SELECT text FROM `info` WHERE `page`='home'";
  if($result = mysqli_query($con, $query))
  {
    while ($row = mysqli_fetch_row($result))
    {
      echo $row[0];
    }
  }
   ?>
</div>
