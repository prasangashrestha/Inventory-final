<!-- Day 2 -->
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
    if(isset($_POST['submit'])){
        if (!empty($_POST['name'] && $_POST['price'] && $_POST['quantity'])){
          $name = $_POST["name"];
          $price = $_POST["price"];
          $quantity = $_POST["quantity"];
  
          $query1 = "INSERT into item (item_name, price,quantity) VALUES ('$name', '$price', '$quantity')";
          mysqli_query($conn, $query1);
            echo "Congrat!!!";
            header("Location: product.php");
        }
      }
  

  ?>

    <!-- Navbar -->
    <nav>
      <div class="nav-wrapper blue">
        <div class="container">
          <a href="#" class="brand-logo center">Inventory Management</a>
        </div>
      </div>
    </nav>

    <br />

    <div class="container">
      <!-- Form Card -->
      <form class="col" action="createProduct.php" method="post">
      <div class="card">
        <div class="card-content">
            <span class="card-title">Add Item</span>
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" placeholder="Add Item" name="name" id="item-name" />
                    <label for="item-name">Item</label>
                </div>
                <div class="input-field col s4">
                    <input
                        type="number"
                        placeholder="Add Price"
                        id="item-calories"
                        name="price"
                    />
                    <label for="item-calories">Price</label>
                </div>

                <div class="input-field col s4">
                    <input
                    type="number"
                    placeholder="Quantity"
                    id="item-quantity"
                    name="quantity"
                    />
                    <label for="item-quantity">Quantity</label>
                </div>

                <input type="submit" id="submit" name="submit" class="add-btn btn blue darken-3">
                
            </div>
        </div>
</form>
      </div>
      <a   href="product.php">
        <button class="update-btn btn orange">
          <i class="fa fa-pencil-square-o"></i> BACK
        </button>
      </a>


    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    
  </body>
</html>
