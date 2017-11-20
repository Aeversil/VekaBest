<?php
@session_start();

$connect = mysqli_connect("localhost", "root", "", "vekabestwebsite");
if (isset($_POST["add_to_cart"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="index.php"</script>';
        }
    } else {
     @   $item_array = array(
            'item_id' => $_GET["boekid"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="index.php"</script>';
            }
        }
    }
}

if (isset($_POST["change_quantity"])) {
    //updateCart($_POST["item_id"], $_POST["quantity"]);
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values["item_id"] == $_POST["product_id"]) {
            $_SESSION["shopping_cart"][$keys]['item_quantity'] = $_POST["c_quantity"];
        }
    }
}
?>

<div id="user_shopping_cart" style="display: none">
    <h1>User shopping cart page</h1>
    <div style="clear:both"></div>
    <br/>
    <h3>Order Details</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="15%">Item Name</th>
                <th width="10%">Quantity</th>
                <th width="10%">Price</th>
                <th width="10%">Total</th>
                <th width="15%">Action</th>

            </tr>
            <?php
            if (!empty($_SESSION["shopping_cart"])) {
                $total = 0;
                foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                    ?>
                    <tr>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td>$ <?php echo $values["item_price"]; ?></td>
                        <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                        <td>
                            <form method="post" id="<?php echo $values["item_id"] ?>">
                                <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info" role="button" type="submit" value="Update"
                                                    name="change_quantity">Wijzig</button>
                                            </span>
                                    <input type="number" name="c_quantity" min="1" class="form-control" placeholder=""
                                           value="<?php echo $values["item_quantity"] ?>">
                                    <input type="hidden" name="product_id" value="<?= $values['item_id']; ?>">
                                    <span class="input-group-btn">
                                            <a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"
                                               class="btn btn-danger" role="button">Verwijder</a>
                                             </span>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <?php
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td align="right">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bestelModal">
                            Bestel
                        </button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>



        <!-- Modal -->
        <div class="modal fade" id="bestelModal" tabindex="-1" role="dialog" aria-labelledby="bestelModal"
             aria-hidden="true">
            <?php

            if (@$_SESSION["Login"] == true) {
                $Username = $_SESSION['Userlogin'];


                $sql_info = "SELECT *
                    FROM (users INNER JOIN user_info ON users.id = user_info.id) 
                    WHERE users.username = '$Username' ";
                $result = mysqli_query($connect, $sql_info);
                while ($row = mysqli_fetch_array($result)) {

                    ?>

                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bestelModalLabel">Checkout</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="index.php" method="post" class="form-horizontal">

                                    <div class="form-group">
                                        <label for="inputFirstname" class="col-sm-2 control-label">Voornaam</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" id="inputFirstname"
                                                       placeholder="Voornaam" value="<?php echo $row ['voornaam']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputLastname" class="col-sm-2 control-label">Achternaam</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" id="inputLastname"
                                                       placeholder="Achternaam"
                                                       value="<?php echo $row ['achternaam']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope"></i></span>
                                                <input type="email" class="form-control" id="inputEmail"
                                                       placeholder="Email" value="<?php echo $row ['username']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPhone" class="col-sm-2 control-label">Telefoon</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-earphone"></i></span>
                                                <input type="tel" class="form-control" id="inputPhone"
                                                       placeholder="06 1234 5678"
                                                       value="<?php echo $row ['telefoon']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-2" align="right">
                                            <label for="inputStreet" class="control-label">Straat</label>
                                            <label for="inputHousenumber" class="control-label">Huis#</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-home"></i></span>
                                                <input type="text" class="form-control" id="inputStreet"
                                                       placeholder="Straatnaam" value="<?php echo $row ['adres']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="inputHousenumber"
                                                   placeholder="Huisnummer" value="<?php echo $row ['huisnummer']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-2" align="right">
                                            <label for="inputZipcode" class="control-label">Postcode</label>
                                            <label for="inputCity" class="control-label">Plaats</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-home"></i></span>
                                                <input type="text" class="form-control" id="inputZipcode" minlength="6"
                                                       maxlength="6" placeholder="Postcode"
                                                       value="<?php echo $row ['postcode']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="inputCity" placeholder="Plaats"
                                                   value="<?php echo $row ['plaatsnaam']; ?>">
                                        </div>
                                    </div>
                                    <?php
//                                    if (isset($_POST['add_to_cart'])) {
//                                        $orderedQuantity = $_POST['quantity'];
//                                    }
                                    $inserts_itemQuantity = $values['item_quantity'];
                                    $inserts_itemId = $values['item_id'];
                                    echo "<pre>";
                                    print_r($values);
                                    echo "</pre>";

                                    //                                    $inserts_itemPrice = $values['item_price'];
                                    $insert_total = $total;
                                    ?>
<!--                                    <input type="hidden" name="quantity" value="--><?//= $orderedQuantity ?><!--">-->
                                    <input type="hidden" name="insert_quantity" value="<?= $inserts_itemQuantity ?>">
                                    <input type="hidden" name="insert_id" value="<?= $inserts_itemId ?>">
<!--                                    <input type="hidden" name="insert_price" value="--><?//= $inserts_itemPrice ?><!--">-->
                                    <input type="hidden" name="insert_total" value="<?= $insert_total ?>">



                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-success" name="order">Bestel</button>

                            </div>
                            </form>
                        </div>
                    </div>
                    <?php


                }
            } else {
                ?>

                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bestelModalLabel">Checkout</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-6 well">

                                    <form method="post" action="user_shopping_cart.php">
                                        <div class="form-group">
                                            <label for="loginInputEmail">Email adres</label>
                                            <input type="email" class="form-control" id="loginInputEmail"
                                                   placeholder="Email@example.com" name="loginModalEmail">
                                        </div>
                                        <div class="form-group">
                                            <label for="loginInputPassword">Password</label>
                                            <input type="password" class="form-control" id="loginInputPassword"
                                                   placeholder="Password" name="loginModalPass">
                                        </div>
                                        <div>
                                            <a href="#">
                                                <small> Forgot Password?</small>
                                                <br><br></a>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block" name="loginModal">
                                            Login
                                        </button>

                                    </form>

                                </div>
                                <div class="col-xs-6">
                                    <p class="lead">Registreer nu voor </p>
                                    <ul class="list-unstyled" style="line-height: 2">
                                        <li><span class="fa fa-check text-success"></span> Snellere checkout</li>
                                        <li><span class="fa fa-check text-success"></span> Al uw bestel gegevens
                                            worden automatisch ingevuld bij elke bestelling
                                        </li>
                                    </ul>
                                    <p><a href="user_registration.php" class="btn btn-info btn-block">Registreer
                                            Nu!</a></p>
                                    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 27px"
                                            data-toggle="modal" data-target="#bestelModalAnon" data-dismiss="modal">
                                        Doorgaan zonder inloggen
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php


            }

            if (isset($_POST['loginModal'])) {
                //If its empty say the Username or password is incorrect else go on
                if (empty($_POST['loginModalEmail'])) {
                    echo "Username or password is incorrect";
                } else {
                    //Get username and password from the boxes
                    $username = $_POST['loginModalEmail'];
                    $password = $_POST['loginModalPass'];

                    //select the password from the username that has been given
                    $sql = "SELECT password FROM `users` WHERE username='$username'";
                    $result = mysqli_query($connect, $sql);
                    $hashed_password = "";
                    //get the info from the rows
                    while ($row = $result->fetch_assoc()) {
                        //put the hashed password in a var
                        $hashed_password = $row['password'];
                    }

                    //check if the given password and the hashed password matches
                    if (password_verify($password, $hashed_password)) {
                        //select everything with a search for the username
                        $sql = "SELECT * FROM `users` WHERE username='$username'";
                        $result = mysqli_query($connect, $sql);
                        //chec how many results
                        $count = mysqli_num_rows($result);

                        //if the result is one then go to the index.php
                        while ($row = mysqli_fetch_row($result)) {
                            if ($count == 1 && $row[3] == "user") {
                                $_SESSION["Userlogin"] = $username;
                                $_SESSION["Login"] = true;
                                header("location: index.php");
                            } else if ($count == 1 && $row[3] == "admin") {
                                $_SESSION["Userlogin"] = $username;
                                $_SESSION["admin"] = true;
                                header("location: admin_index.php");
                            } else {
                                echo "Username or password is incorrect";
                            }
                            mysqli_free_result($result);
                        }
                    }
                }
            }



            if (isset($_POST['order'])) {

                //$connect = mysqli_connect("localhost", "root", "", "vekabestwebsite");
//                foreach ($_SESSION["shopping_cart"] as $keys => $values) {

                    $sql_insert = "
                    INSERT INTO orders(boekid, userid, aantal, totaal, orderstatus, datum)
                    VALUES ('" . $_POST["insert_id"] . "','uid'," . $_POST["insert_quantity"] . "," . $_POST["insert_total"] . ",'inbehandeling',CURRENT_TIMESTAMP)
                    ";
//                    $sql_insert = "
//                    INSERT INTO orders(boekid, userid, aantal, totaal, orderstatus, datum)
//                    VALUES ('".$values["item_id"]."','uid',".$values["item_quantity"]."," . $_POST["insert_total"] . ",'inbehandeling',CURRENT_TIMESTAMP)
//                    ";

//                }
                if (mysqli_query($connect, $sql_insert)) {
                    echo "Records inserted successfully.";
                    echo '<script>("Records inserted successfully")</script>';
                } else {
                    echo "ERROR: Could not able to execute $sql_insert. " . mysqli_error($connect);
                    echo '<script>("ERROR: Could not able to execute '.$sql_insert.' . " . mysqli_error($connect))';
                }

            }
            ?>
        </div>
    </div>
</div>