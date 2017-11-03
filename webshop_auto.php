<div id="webshop_auto" style="display: none">
  <div class="panel-color-darkblue">
    <h1>Webshop Auto</h1>
      <div class="container" style="width:700px;">
          <?php
          $query = "SELECT * FROM boeken ORDER BY boekid ASC";
          $result = mysqli_query($connect, $query);
          if(mysqli_num_rows($result) > 0)
          {
              while($row = mysqli_fetch_array($result))
              {
                  ?>
                  <div class="col-md-4">
                      <form method="post" action="index.php?action=add&id=<?php echo $row["boekid"]; ?>">
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
                              <img src="<?php echo $row["boekafbeelding"]; ?>" class="img-responsive" /><br />
                              <h4 class="text-info"><?php echo $row["boeknaam"]; ?></h4>
                              <h4 class="text-danger">$ <?php echo $row["boekprijs"]; ?></h4>
                              <input type="text" name="quantity" class="form-control" value="1" />
                              <input type="hidden" name="hidden_name" value="<?php echo $row["boeknaam"]; ?>" />
                              <input type="hidden" name="hidden_price" value="<?php echo $row["boekprijs"]; ?>" />
                              <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                          </div>
                      </form>
                  </div>
                  <?php
              }
          }
          ?>
      </div>
  </div>
</div>
