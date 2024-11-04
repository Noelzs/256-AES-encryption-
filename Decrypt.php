<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <!-- External Styles -->
    <style>
        body {
            background-image: url("images/greypattern.jpg");
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
        }

        .nav-link {
            color: white;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.37); /* Transparent white background */
            backdrop-filter: blur(5px); /* Add the glass effect */
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
            padding: 20px;
            margin: 20px auto;
            max-width: 500px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            color: teal;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            background-color: teal;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        #cart-total {
            font-weight: bold;
            color: black;
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Decryption Portal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.html">Back to admin menu</a>
                    </li>
                    <!-- <li class="nav-item"> -->
                        <!-- <a class="nav-link" href="login.html">Login</a> -->
                    <!-- </li> -->
                    <!-- <li class="nav-item active">
                        <a class="nav-link" href="Cart.html">Cart</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <h1 class="text-center"> AES Decryption </h1>
            <!-- <div id="cart-total">Total: $<span id="total-amount">0.00</span></div> -->
            <form method="post">
                <div class="form-group">
                    <label class="againforcolorsake" for="email">Encrypted Card Number</label>
                    <input type="text" id="enccn" name="enccn" placeholder="Enter Encrypted Card Number" required>
                </div>
                <div class="form-group">
                        <label for="card-number">Encrypted Card Holder Name</label>
                        <input type="text" id="encchn" name="encchn" placeholder="Enter Encrypted Card Holder Name" required><br/><br/>
                        <button type="submit" class="btn btn-primary">Decrypt</button>
                    </div>
                <!-- <div class="form-group">
                    <label>Payment Method</label><br>
                    <input type="radio" id="credit" name="payment" value="credit" checked>
                    <label for="credit">Credit Card</label><br>
                    <input type="radio" id="debit" name="payment" value="debit">
                    <label for="debit">Debit Card</label>
                </div> -->

                <!-- <div id="credit-card-details"> -->
                    <!-- <h2>Credit Card or Debit card</h2> -->
                    
                    <!-- <div class="form-group">
                        <label for="card-holder-name">CARD HOLDER NAME</label>
                        <input type="text" id="card-holder-name" name="card_holder_name" placeholder="eg:Jamie Vardy" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry-date">EXPIRY DATE (MM/YY)</label>
                        <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required>
                    </div> -->
                </div>

                
            </form>
        </div>
    </div>
</body>

</html>
<?php
$conn = mysqli_connect("localhost","root","");

$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

//DECRYPT FUNCTION
function decryptthis($data, $key) {
    $encryption_key = base64_decode($key);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

if ($_SERVER["REQUEST_METHOD"]=="POST"){
  $enccn=htmlspecialchars($_POST["enccn"]);
  $encchn=htmlspecialchars($_POST["encchn"]);

//   $var=$_POST['card_number']
  $dec_card_number=decryptthis($enccn, $key);

//   $var=$_POST['card_holder_name']
  $dec_card_holder_name=decryptthis($encchn, $key);

//   $cart_items=htmlspecialchars($_POST[$cartItems]);

  $query="INSERT INTO websitelogin.decrypteddata VALUES('','$dec_card_number','$dec_card_holder_name')";
//   $query1="INSERT INTO websitelogin.transactionlogs VALUES('','$cart_items')";


  mysqli_query($conn,$query);

    echo'<br/>';
    echo '<h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp        
    Decrypted Data</h2></span><br/>';
    echo '<p><h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp      
    Decrypted Card Number: '. $dec_card_number.'</h4></p>';
    echo '<p><h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp       
    Decrypted Card Holder Name: '.$dec_card_holder_name.'</h4></p>';
//   mysqli_query($conn,$query1);
//   echo "<script>alert('Payment succesfull. Your key is sent to your registered email.');window.location.href='Home.html';</script>";
}
?>
