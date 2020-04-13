<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <?php
        $query = "SELECT cost FROM orders";

        $query = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($query)) {
            $cost = $row['cost'];
        }
    ?>

    <!-- <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script> -->
	<script src="js/bootstrap.min.js"></script>
  <script>
    function myFunction() {
      alert("Payment successful! Your tickets are booked.");
      window.location= "index.php";
    }
  </script>

    <div class="container" style="margin-bottom: 30px; margin-top: 3%; width: 300px; align-content: center;">
        <div class="cost">
            <h3>Total Cost: Rs. <?php echo $cost; ?></h3>
        </div>
        <div class="payment_mode" style="margin-top: 40px; align-content: center;">
            <h3 style="text-align: center; align-self: center;">Select payment mode</h3>
            <br>
            <div class="form-check" style="text">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                <label class="form-check-label" for="exampleRadios1">
                  Cash on Delivery
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                <label class="form-check-label" for="exampleRadios1">
                  Debit/Credit Card
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                <label class="form-check-label" for="exampleRadios1">
                  Net Banking
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                <label class="form-check-label" for="exampleRadios1">
                  UPI
                </label>
              </div>
        </div>
    </div>
    <div class="container" style="margin-bottom: 30px; width: 400px; align-content: center;">
        <div class="card-details" style="margin-top: 40px; text-align: center;">
            <h3 style="text-align: left; align-self: center;"> Enter card details</h3>
            <br>
            <form>
                <div class="form-group row">
                  <label for="card-number" class="col-sm-4 col-form-label">Card Number</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="card-number">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="card-name" class="col-sm-4 col-form-label">Card Holder's Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="card-name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expiry" class="col-sm-4 col-form-label">Expiry Date</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="expiry">
                    </div>
                 </div>
                <div class="form-group row">
                  <label for="cvv" class="col-sm-4 col-form-label">CVV</label>
                  <div class="col-sm-3">
                    <input type="password" class="form-control" id="cvv">
                  </div>
                </div>
              </form>
              <br>
              <button type="button" onclick="myFunction()" class="btn btn-outline-success btn-lg" data-toggle="modal" data-target="#otpModal">Proceed to Payment</button>
        </div>
    </div>
    <!-- </div> -->

<?php include "includes/footer.php"; ?>