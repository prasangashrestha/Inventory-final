<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"
    />
    <link
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <title>Inventory Management</title>
  </head>
  <body>

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

    <!-- Navbar -->
    <nav>
      <div class="nav-wrapper blue">
        <div class="container">
          <a href="#" class="brand-logo center">Order Management</a>
        </div>
      </div>
    </nav>

    <br />

      <!-- Calorie Count -->
      <h3 class="center-align">
        Total Price: <span class="total-calories">
            <?php
                $query = "SELECT * from sales";
                $result = mysqli_query($conn, $query);
                $total = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $total += $row[total];
                }
                
                echo "$total";
                
            ?>
            </span>
      </h3>
      <a   href='createOrder.php'>
              <button class='update-btn btn green'>
                <i class='fa fa-pencil-square-o'></i> Add Orders
              </button>
            </a>

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
          <td>
          <a class='secondary-content'>
            <a   href='updateOrder.php?id=".$row['order_id']."'>
              <button class='update-btn btn orange'>
                <i class='fa fa-pencil-square-o'></i> Update Orders
              </button>
            </a>
            <a  href='deleteOrder.php?id=".$row['order_id']."'>
              <button class='delete-btn btn red'>
                <i class='fa fa-remove'></i> Delete Orders
              </button>
            </a>
          </a>

          </td>
        </tr>";
    };
    echo " </tbody>
    </table>
  </div>";

    ?>
      

      


    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    
  </body>
</html>
