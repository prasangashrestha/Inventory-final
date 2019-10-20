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
    $id =  $_GET["id"];

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

    $query = "SELECT * FROM sales WHERE order_id = ".$id."";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    $product_id = $row['product_id'];
    $product_query = "SELECT * FROM item WHERE item_id = ".$product_id."";
    $product_result = mysqli_query($conn, $product_query);
    $product_row = mysqli_fetch_assoc($product_result);
    
    if(isset($_POST['submit'])){
            $product_quantity = $product_row[quantity];
            $product_quantity += $row[quantity];
            
            $product_query = "UPDATE item SET quantity = '$product_quantity' WHERE item_id ='$product_row[item_id]'";
            mysqli_query($conn, $product_query);

            $query1 = "DELETE FROM sales WHERE order_id = '".$id."'";
            mysqli_query($conn, $query1);
            

            echo "<script> location.href='orders.php'; </script>";
              
    }else{
    
    
    echo '
        <div class="container">
            <nav>
                <div class="nav-wrapper blue">
                    <a href="#" class="brand-logo center">Order Management</a>
                </div>
            </nav>
		<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="deleteOrder.php?id='.$row[order_id].'" id="createOrderForm">
            <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			        <input type="date" class="form-control" id="orderDate" name="orderDate" value="'.$row[order_date].'" disabled="true"/>
			    </div>
			</div> <!--/form-group-->
			<div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-10">
			        <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" value="'.$row[client_name].'" disabled="true"/>
			    </div>
			</div> <!--/form-group-->
			<div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
			    <div class="col-sm-10">
			        <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" value="'.$row[client_contact].'" disabled="true"/>
			    </div>
			</div> <!--/form-group-->
						  <table name="productTable"id="productTable">
			  		<tr>			  			
			  			<th>Product</th>
			  			<th>Quantity</th>			  			
			  		</tr>
                  <tr>			  				
                    <td>
  					    <input type="text" name="product_name" id="product_name" disabled="true" value="'.$product_row[name].'" disabled="true"/>
  					    <input type="hidden" class="form-control" id="productName" name="productName" value="'.$product_row[name].'" disabled="true"/>
			  		</td>
			  		<td >
					    <input type="number" name="quantity" id="quantity" min="1" value="'.$row[quantity].'" disabled="true"/>
	  				</td>
  				</tr>
		  </table>
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				        <input type="text" class="form-control" id="totalAmount" name="totalAmount" value="'.$row[total].'" disabled="true"/>
  					    <input type="hidden" class="form-control" id="total" name="total" value="'.$row[total].'" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group submitButtonFooter">
        			    <div class="col-sm-offset-2 col-sm-10">
        			        <button type="submit" name="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Delete</button>
        			    </div>
    			  </div>
			</form>
        <a   href="orders.php">
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
