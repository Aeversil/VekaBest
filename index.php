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
$password = "root";
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
        <div class="login">
        <a href="user_login.php"><button>Log in</button></a>
      </div>
      </div>

    <div class="nav2">
        <button onclick="showPage('user_home');">
          Home page
        </button>
        <button onclick="showPage('user_contact');">
          Contact
        </button>
        <button onclick="showPage('user_webshop');">
          Webshop
        </button>
        <button onclick="showPage('user_shopping_cart');"">
          Winkelwagen
        </button>
    </div>

    <div class="rowcontainer">
      <?php @include("user_home.php"); ?>
      <?php @include("user_profile.php"); ?>
      <?php @include("user_edit_profile.php"); ?>
      <?php @include("user_contact.php"); ?>
      <?php @include("user_webshop.php"); ?>
      <?php @include("user_shopping_cart.php"); ?>

      <!-- Show Javascript custom errors here. -->
      <div id="error-message" class="alert-danger col-md-12 col-md-offset-1" style="display: none;">
      </div>
    </div>
    </div>
    <script>
    var pages = ["user_home", "user_profile", "user_edit_profile", "user_contact", "user_webshop", "user_shopping_cart"];

    function showPage(pagename) {
      for (var i = 0; i < pages.length; i++) {
        try {
          var page = document.getElementById(pages[i]);
          page.setAttribute("style", "display: none");}
        catch(err) {
          document.getElementById("error-message").setAttribute("style", "display: block");
          document.getElementById("error-message").innerHTML = '<h1 class="error-message">404 page not found.</h1>';
        }
      }
      var showpage = document.getElementById(pagename);
      showpage.setAttribute("style", "display: block");
    }
    </script>
  </body>
</html>
