<!-- Day 3 -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
  
    $host = "192.185.20.30";
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

    $query = "SELECT * FROM item from prasanga_dp2";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
        echo "<p>row['name']</p>";
        echo "<p>['quantity']</p>";
    }

  ?>
  <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dropdown button
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </div>

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
      <form method = "post">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Add Item</span>
          <form class="col">
            <div class="row">
              <div class="input-field col s4">
                <input type="text" placeholder="Add Item" id="item-name" />
                <label for="item-name">Item</label>
              </div>
              <div class="input-field col s4">
                <input
                  type="number"
                  placeholder="Add Price"
                  id="item-calories"
                />
                <label for="item-calories">Price</label>
              </div>

              <div class="input-field col s4">
                <input
                  type="number"
                  placeholder="Quantity"
                  id="item-quantity"
                />
                <label for="item-quantity">Quantity</label>
              </div>

              <button class="add-btn btn blue darken-3">
                <i class="fa fa-plus"></i> Add Item
              </button>
              <button class="update-btn btn orange">
                <i class="fa fa-pencil-square-o"></i> Update Item
              </button>
              <button class="delete-btn btn red">
                <i class="fa fa-remove"></i> Delete Item
              </button>
              <button class="back-btn btn grey pull-right">
                <i class="fa fa-chevron-circle-left"></i> Back
              </button>
            </div>
          </form>
        </div>
</form>
      </div>

      <!-- Calorie Count -->
      <h3 class="center-align">
        Total Price: <span class="total-calories">0</span>
      </h3>

      <!-- Item List -->
      <ul id="item-list" class="collection">
        <!--
      <li class="collection-item" id="item-0">
        <strong>Steak Dinner: </strong> <em>1200 Calories</em>
        <a href="#" class="secondary-content">
          <i class="edit-item fa fa-pencil"></i>
        </a>
      </li>
      <li class="collection-item" id="item-0">
        <strong>Cookie: </strong> <em>400 Calories</em>
        <a href="#" class="secondary-content">
          <i class="edit-item fa fa-pencil"></i>
        </a>
      </li>
      <li class="collection-item" id="item-0">
        <strong>Eggs: </strong> <em>300 Calories</em>
        <a href="#" class="secondary-content">
          <i class="edit-item fa fa-pencil"></i>
        </a>
      </li>
    -->
      </ul>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>
              <a href="#" class="secondary-content">
                <i class="edit-item fa fa-pencil"></i>
              </a>
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
