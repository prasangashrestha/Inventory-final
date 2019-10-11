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
    $id =  $_GET["id"];

    $host = "localhost";
    $user = "root";
    $password = "root";
    $sql_db = "test";

    $conn = @mysqli_connect(
        $host,
        $user,
        $password,
        $sql_db
    );
    if(!$conn){
      echo"<p>Database connection failure</p>";
    }

    $query = "SELECT * FROM item WHERE item_id = ".$id."";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['submit'])){
        if (!empty($_POST['name'] && $_POST['price'] && $_POST['quantity'])){
            $name = $_POST["name"];
            $price = $_POST["price"];
            $quantity = $_POST["quantity"];
            $query1 = "UPDATE item  SET item_name = '$name', price = '$price',quantity = '$quantity' WHERE item_id = '$id'";
            mysqli_query($conn, $query1);
            header("Location: product.php");
        }
    }else{
        echo '    <!-- Navbar -->
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
        <form class="col" action="updateProduct.php?id='.$id.'" method="post">
        <div class="card">
          <div class="card-content">
              <span class="card-title">Edit Item</span>
              <div class="row">
                  <div class="input-field col s4">
                      <input type="text" placeholder="Add Item" name="name" id="item-name" value='.$row[item_name].' />
                      <label for="item-name">Item</label>
                  </div>
                  <div class="input-field col s4">
                      <input
                          type="number"
                          placeholder="Add Price"
                          id="item-calories"
                          name="price"
                          value='.$row[price].'
                      />
                      <label for="item-calories">Price</label>
                  </div>
  
                  <div class="input-field col s4">
                      <input
                      type="number"
                      placeholder="Quantity"
                      id="item-quantity"
                      name="quantity"
                      value='.$row[quantity].'
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

    ';
    }
  ?>
      
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    
  </body>
</html>
