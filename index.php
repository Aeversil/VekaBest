<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "vekabestwebsite";
?>

<h1>Home page, add header and footer here</h1>
<!-- User starts on this page -->
<!-- Clicks the Login button -->
<!-- if user go back to user home -->
<!-- Goes to shopping -->
<!-- Goes to shopping cart -->
<!-- if admin go to admin home -->
<!-- can add/edit/delete admins and users -->
<!-- can add/edit/delete items in the store -->


<?php include("user_home.php"); ?>


<button onclick="showpage('user_home');">user_home</button>

<script>
  function showpage(pagename) {
      var page = document.getElementById(pagename);
      page.setAttribute("style", "display: block");
  }
</script>
<!-- Can admins also login as regular users? -->
<!-- Logins will be done with a modal -->
