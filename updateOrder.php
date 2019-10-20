<!-- Day 3 -->
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
        if(isset($_POST["orderDate"])&&isset($_POST["clientName"])&&isset($_POST["clientContact"])&&isset($_POST["quantity"])){
            $orderDate = $_POST['orderDate'];
            $clientName = $_POST['clientName'];
            $clientContact = $_POST['clientContact'];
            $name = $_POST['productName'];
            $quantity = $_POST['quantity'];
            $total = $_POST['total'];
            

            echo $orderDate." ".$clientName." ".$clientContact." ".$name." ".$quantity." ".$total;
            $sales_query = "UPDATE sales SET order_date = '$orderDate',client_name = '$clientName',client_contact = '$clientContact',product_id = '$product_row[item_id]',quantity = '$quantity',total = '$total' WHERE order_id = '$id'";
            mysqli_query($conn, $sales_query);
            $product_query = "UPDATE item SET quantity = '' WHERE item_id ='$product_row[item_id]'";
            
            $original_quantity = $row[quantity];
            $product_quantity = $product_row[quantity];
            if($original_quantity > $quantity){
                $add = $original_quantity - $quantity;
                $product_quantity += $add;
                $product_query = "UPDATE item SET quantity = '$product_quantity' WHERE item_id ='$product_row[item_id]'";
                mysqli_query($conn, $product_query);
            }else if($original_quantity < $quantity){
                $deduct = $quantity - $original_quantity ;
                $product_quantity -= $deduct;
                $product_query = "UPDATE item SET quantity = '$product_quantity' WHERE item_id ='$product_row[item_id]'";
                mysqli_query($conn, $product_query);
            }
        }
    }
    
    $query = "SELECT * FROM sales WHERE order_id = ".$id."";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    $product_id = $row['product_id'];
    $product_query = "SELECT * FROM item WHERE item_id = ".$product_id."";
    $product_result = mysqli_query($conn, $product_query);
    $product_row = mysqli_fetch_assoc($product_result);

    
    echo '
        <div class="container">
            <nav>
                <div class="nav-wrapper blue">
                    <a href="#" class="brand-logo center">Order Management</a>
                </div>
            </nav>
		<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="updateOrder.php?id='.$row[order_id].'" id="createOrderForm">
            <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			        <input type="date" class="form-control" id="orderDate" name="orderDate" value="'.$row[order_date].'" />
			    </div>
			</div> <!--/form-group-->
			<div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-10">
			        <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" value="'.$row[client_name].'" />
			    </div>
			</div> <!--/form-group-->
			<div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
			    <div class="col-sm-10">
			        <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" value="'.$row[client_contact].'" />
			    </div>
			</div> <!--/form-group-->
						  <table name="productTable"id="productTable">
			  		<tr>			  			
			  			<th>Product</th>
			  			<th>Quantity</th>			  			
			  		</tr>
                  <tr>			  				
                    <td>
  					    <input type="text" name="product_name" id="product_name" disabled="true" value="'.$product_row[name].'" />
  					    <input type="hidden" class="form-control" id="productName" name="productName" value="'.$product_row[name].'"/>
			  		</td>
			  		<td >
					    <input type="number" name="quantity" id="quantity" min="1" value="'.$row[quantity].'" onchange="quantityChange()"/>
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
        			        <button type="submit" name="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Updates</button>
        			    </div>
    			  </div>
			</form>
        <a   href="orders.php">
        <button class="update-btn btn orange">
          <i class="fa fa-pencil-square-o"></i> BACK
        </button>
      </a>

                    <script>
                        function quantityChange(){
                            var qt = document.getElementById("quantity").value;
                            var price = Number('.$product_row[price].')+5;
                            price *=qt;
                            document.getElementById("totalAmount").value = price;
                            document.getElementById("total").value = price;
                        }
                    </script>

    ';
  ?>

    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    
  </body>
</html>
