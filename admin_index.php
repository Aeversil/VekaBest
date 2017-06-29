<!-- User starts on this page -->
  <!-- Clicks the Login button -->
    <!-- if user go back to user home -->
  <!-- Goes to shopping -->
  <!-- Goes to shopping cart -->
    <!-- if admin go to admin home -->
      <!-- can add/edit/delete admins and users -->
      <!-- can add/edit/delete items in the store -->

<!-- Can admins also login as regular users? -->

<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "vekabestwebsite";
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Novaict Afspraken</title>
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

    <div class="row">
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

      <?php @include("admin_home.php"); ?>
      <?php @include("admin_contact.php"); ?>
      <?php @include("admin_inventory.php"); ?>
      <?php @include("admin_users.php"); ?>
      <?php @include("admin_orders.php"); ?>

      <div id="error-message" class="alert-danger col-md-12 col-md-offset-1" style="display: none;">
      </div>
    <script>
    var pages = ["admin_home", "admin_contact", "admin_inventory", "admin_users", "admin_orders"];

    function showPage(pagename) {
      for (var i = 0; i < pages.length; i++) {
        try {
          var page = document.getElementById(pages[i]);
          page.setAttribute("style", "display: none");}
        catch(err) {
          }
      }
      var showpage = document.getElementById(pagename);
      showpage.setAttribute("style", "display: block");
    }

    </script>
    </div>
    </div>
  </body>
</html>
