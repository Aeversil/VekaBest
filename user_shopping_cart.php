<?php
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
        $item_array = array(
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
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bestelModal">Bestel</button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="bestelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bestelModalLabel">Checkout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Bestel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
