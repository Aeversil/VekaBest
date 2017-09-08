<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$db_name = "vekabestwebsite";
//TODO: Check for admin, let him log in and else redirect away.

if ($_SESSION["admin"] == false) {
  header("location: user_login.php");
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Website vader van Steffan</title>
    <link href="vekabest.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body style="background-color: #f0f0f0;">
    <div class="banner">
      <img src="stockvekafotos/busbanner.jpg" />
      <div class="loguit">
        <a href="index.php"><button>Log uit</button></a>
      </div>
    </div>

    <div class="nav">
      <button onclick="showPage('admin_home');">
        Home page
      </button>
      <button onclick="showPage('admin_contact');">
        Contact
      </button>
      <button onclick="showPage('admin_inventory');">
        Inventaris
      </button>
      <button  onclick="showPage('admin_users');">
        Gebruikers
      </button>
      <button onclick="showPage('admin_orders');">
        Bestellingen
      </button>
    </div>

    <div class="rowcontainer">
      <?php include("admin_inventory.php"); ?>
      <?php include("admin_home.php"); ?>
      <?php include("admin_contact.php"); ?>
      <?php include("admin_users.php"); ?>
      <?php include("admin_orders.php"); ?>
    </div>
    <script>
      var pages = ["admin_home", "admin_contact", "admin_inventory", "admin_users", "admin_orders"];

      function showPage(pagename) {
        for (var i = 0; i < pages.length; i++) {
          try {
            var page = document.getElementById(pages[i]);
            page.setAttribute("style", "display: none");
          } catch (err) {
          }
        }
        var showpage = document.getElementById(pagename);
        showpage.setAttribute("style", "display: block");
      }

    </script>

    <?php
    if (isset($_POST['test'])) {
      echo '<script type="text/javascript">
                showPage("admin_inventory");
              </script>';
    }
    if (isset($_POST['toevoegen'])) {
      echo '<script type="text/javascript">
                showPage("admin_inventory");
              </script>';
    }
    if (isset($_POST['bewerken'])) {
      echo '<script type="text/javascript">
                showPage("admin_inventory");
              </script>';
    }
    if (isset($_POST['verwijderen'])) {
      echo '<script type="text/javascript">
                showPage("admin_inventory");
              </script>';
    }
    ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
