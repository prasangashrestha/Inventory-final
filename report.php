<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

<?php
  
$host = "localhost";
    $user = "prasanga_1";
    $password = "Leon2012";
    $sql_db = "prasanga_dp2";

  $conn = @mysqli_connect(
      $host,
      $user,
      $password,
      $sql_db
  );
  if(!$conn){
    echo"<p>Database connection failure</p>";
  }





?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<link
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <title>Inventory Management</title>
  </head>
  <body>
      <div class="container">
    <nav>
      <div class="nav-wrapper blue">
        
          <a href="#" class="brand-logo center">Report</a>
        
      </div>
    </nav>
    
    <div>
    <h5>Low in stock!!!</h5>
<?
$query = "SELECT name, quantity from item where quantity < 50";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)){
    echo "<p>";
    echo "<strong>";
    echo $row[name];
    echo ": </strong>";
    echo $row[quantity];
    echo " items";
    echo "</p>";
}
?>
</div>
<div>
    <h5>Reports</h5>
    <a href="totalday.php" >All Orders Report</a> <br />
    <a href="daily.php" >Daily Report</a> <br />
    <a href="monthly.php" >Monthly Report</a> <br />
    <a href="totalproduct.php">Product Sales Report</a>
</div>
<h5>All Orders</h5>
<?php 
    $query = "SELECT * FROM sales";
    $result = mysqli_query($conn, $query);

    echo"<table class='table'>
      <thead>
        <tr>
          <th>#</th>
          <th>Date</th>
          <th>Client Name</th>
          <th>Client Contact</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Total Price</th>
          <th></th>
        </tr>
      </thead>";

    while($row = mysqli_fetch_assoc($result)){

    echo "
      <tbody>
        <tr>
          <td>",$row['order_id'],"</td>
          <td>",$row['order_date'],"</td>
          <td>",$row['client_name'],"</td>
          <td>",$row['client_contact'],"</td>
          <td>",$row['product_id'],"</td>
          <td>",$row['quantity'],"</td>
          <td>",$row['total'],"</td>
        </tr>";
    };
    echo " </tbody>
    </table>
  </div>";

    ?>
    
    
    <div>
        <form class="form-horizontal" action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <input type="submit" name="Export" class="btn btn-success" value="export to excel"/>
                </div>
           </div>                    
        </form>           
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>
</body>
</html>

