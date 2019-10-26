
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
  $date =[];
    $productSql = "SELECT order_date FROM sales ";
    $productData = mysqli_query($conn, $productSql);
    echo "<pre>";
    while($row = mysqli_fetch_assoc($productData)){
          print_r($row);
          
        $a = date_create($row[order_date]);
        $date[] = date_format($a,"Y-m");
    }
    echo "</pre>";
    print_r($date);
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
        
          <a href="#" class="brand-logo center">Order Management</a>
        
      </div>
    </nav>
    <form class="form-horizontal" method="POST" action="" id="createOrderForm">
           <select class="form-control" name="date" id="date" onchange="getSales()" >
            <?php
              $sqlquery = "SELECT DISTINCT year(order_date) as MonthYear FROM sales";
              $sqltran = mysqli_query($conn, $sqlquery)or die(mysqli_error($conn));
              while ($rowList = mysqli_fetch_array($sqltran)) {
                echo "<option value='".$rowList["MonthYear"]."'>" .$rowList["MonthYear"]. "</option>";
              }
            ?>    	        
    		</select>
    		<button type="submit" name="check" id="createOrderBtn" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i>Check</button>
    </form>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </div>
            </body>
            </html>

