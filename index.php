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
    <title>Website vader van Steffan</title>
    <link href="vekabest.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body id="index" style="background-color: #f0f0f0;">
<div class="banner">
    <img src="stockvekafotos/busbanner.jpg"/>
    <!-- Button temporary disabled -->
    <!-- <div class="login">
    <a href="user_login.php"><button>Log in</button></a> -->
</div>
</div>

<div class="nav2">
    <button onclick="showPage('user_home');" class="edit-color">
        Home page
    </button>
    <button onclick="showPage('user_contact');" class="edit-color">
        Contact
    </button>
    <button onclick="showPage('user_webshop');" class="edit-color">
        Webshop
    </button>
    <button onclick="showPage('user_shopping_cart');" class="edit-color">
        Winkelwagen
    </button>
</div>

<div style="padding-top: 10px;">
    <div class="container">
        <?php include("user_home.php"); ?>
        <?php include("user_profile.php"); ?>
        <?php include("user_edit_profile.php"); ?>
        <?php include("user_contact.php"); ?>
        <?php include("user_webshop.php"); ?>
        <?php include("user_shopping_cart.php"); ?>
        <?php include("webshop_auto.php"); ?>
        <?php include("webshop_brommer.php"); ?>
        <?php include("webshop_bus.php"); ?>
        <?php include("webshop_motor.php"); ?>
        <?php include("webshop_spiegel.php"); ?>
        <?php include("webshop_vrachtwagen.php"); ?>
    </div>
</div>


<script type="text/javascript">
    var pages = ["user_home", "user_profile", "user_edit_profile", "user_contact", "user_webshop", "user_shopping_cart", "webshop_auto", "webshop_brommer", "webshop_motor", "webshop_vrachtwagen", "webshop_bus", "webshop_spiegel"];

    // TODO: Zou chill zijn als de kleurtjes wat smoother overlopen.
    function showPage(pagename) {
        for (var i = 0; i < pages.length; i++) {
            try {
                //Hide all pages.
                var page = document.getElementById(pages[i]);
                page.setAttribute("style", "display: none");
            } catch (err) {
            }
        }

        // Show picked page.
        var showpage = document.getElementById(pagename);
        showpage.setAttribute("style", "display: block");

        //See which buttons need to be changed of color.
        var edit = document.getElementsByClassName('edit-color');
        var aNode = edit[0];
        var arrFromList = Array.prototype.slice.call(edit);

        //Remove all colors from the buttons.
        for (var i = 0; i < edit.length; i++) {
            edit[i].classList.remove("button-color-blue");
            edit[i].classList.remove("button-color-orange");
            edit[i].classList.remove("button-color-yellow");
            edit[i].classList.remove("button-color-green");
            edit[i].classList.remove("button-color-darkblue");
        }

        //Check what the chosen pagename is and change the colors accordingly.
        switch (pagename) {
            case "webshop_vrachtwagen":
                for (var i = 0; i < edit.length; i++) {
                    edit[i].className += " " + "button-color-orange";
                }
                break;
            case "webshop_bus":
                for (var i = 0; i < edit.length; i++) {
                    edit[i].className += " " + "button-color-orange";
                }
                break;
            case "webshop_brommer":
                for (var i = 0; i < edit.length; i++) {
                    edit[i].className += " " + "button-color-yellow";
                }
                break;
            case "webshop_motor":
                for (var i = 0; i < edit.length; i++) {
                    edit[i].className += " " + "button-color-green";
                }
                break;
            case "webshop_auto":
                for (var i = 0; i < edit.length; i++) {
                    edit[i].className += " " + "button-color-darkblue";
                }
                break;
            case "webshop_spiegel":
                for (var i = 0; i < edit.length; i++) {
                    edit[i].className += " " + "button-color-blue";
                }
                break;
            default:
                break;
        }
    }
</script>
<?php
if (isset($_POST["EditUser"]) || isset($_POST["DeleteUser"])) {
    echo '<script>
              showPage("admin_users");
            </script>';
}
?>

</body>
</html>
