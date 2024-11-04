<?php
 
// require_once('config1/db1.php');
// $query ="select * from encrypteddata";

// $result=mysqli_query($con1,$query);

require_once 'config1/db1.php';
require_once 'config1/function1.php';
$result=display_data();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Transaction Logs</title>
</head>
<body class="bg-dark">
    <div class="container">
      <div class="row mt-5">
        <div class="col">
          <div class="card mt-5">
            <div class="card-header">
              <h2 class="display-6 text-center">Encrypted Data</h2>
            </div>
            <div class="card-body">
              <table class="table table-bordered text-center">
                <tr class="bg-dark text-white">
                  <td> ID </td>
                  <td> Encrypted Card Number </td>
                  <td> Encrypted Card Holder's name </td>
                </tr>
                <tr>
                <?php 

                  while($row = mysqli_fetch_assoc($result))
                  {
                ?>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['enc_card_number']; ?></td>
                  <td><?php echo $row['enc_card_holder_name']; ?></td>
                </tr>
                <?php
                  }
                ?> 
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>