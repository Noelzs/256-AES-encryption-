<?php
 
// require_once('config/db.php');
// $query ="select * from transactionlogs";

// $result=mysqli_query($conn,$query);

require_once 'config/db.php';
require_once 'config/function.php';
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
              <h2 class="display-6 text-center">Cart Item Logs</h2>
            </div>
            <div class="card-body">
              <table class="table table-bordered text-center">
                <tr class="bg-dark text-white">
                  <td> ID </td>
                  <td> Title </td>
                  <td> Price </td>
                  <td> Date </td>
                </tr>
                <tr>
                <?php 

                  while($row = mysqli_fetch_assoc($result))
                  {
                ?>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['price']; ?></td>
                  <td><?php echo $row['date']; ?></td>
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