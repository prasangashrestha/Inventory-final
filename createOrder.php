<!-- Day 2 -->
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
        if(isset($_POST["orderDate"])&&isset($_POST["clientName"])&&isset($_POST["clientContact"])&&isset($_POST["productName"])&&isset($_POST["quantity"])){
            $orderDate = $_POST['orderDate'];
            $clientName = $_POST['clientName'];
            $clientContact = $_POST['clientContact'];
            $product = explode("-",$_POST['productName']);
            $productId = $product[0];
            $product_quantity = $product[2];
            $quantity = $_POST['quantity'];
            $remain = $product_quantity - $quantity;
            $totalAmount = $_POST['totalAmountValue'];

            $query1 = "INSERT into sales (order_date, client_name,client_contact,product_id,quantity,total) VALUES ('$orderDate', '$clientName', '$clientContact','$productId','$quantity','$totalAmount')";
            mysqli_query($conn, $query1);
            $query2 = "UPDATE item  SET quantity = '$remain' WHERE item_id = '$productId'";
            mysqli_query($conn, $query2);

        }
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
        
          <a href="#" class="brand-logo center">Order Management</a>
        
      </div>
    </nav>
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="createOrder.php" id="createOrderForm">

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="date" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->			  

			  <table name="productTable"id="productTable">
			  		<tr>			  			
			  			<th>Product</th>
			  			<th>Available Quantity</th>
			  			<th>Quantity</th>			  			
			  			<th>Total</th>			  			
			  		</tr>
                  <tr>			  				
                    <td>
                         <select class="form-control" name="productName" id="productName" onchange="getProductData()" >
			  				<option value="none">~~SELECT~~</option>
			  				<?php
			  					$productSql = "SELECT * FROM item";
			  					$productData = mysqli_query($conn, $productSql);
                                	while($row =mysqli_fetch_assoc($productData)) {									 		
			  							echo "<option value='".$row['item_id']."-".$row['price']."-".$row['quantity']."' id='changeProduct".$row['item_id']."'>".$row['name']."</option>";
			  							
									} // /while 
			  				?>
		  				</select>
			  		</td>
					<td >
						<p name="available_quantity"id="available_quantity"></p>
			  		</td>
			  		<td >
					    <input type="number" name="quantity" id="quantity" min="1" onchange="quantityChange()"/>
	  				</td>
	  				<td >		
  					    <input type="text" name="total" id="total" disabled="true"/>
	  				</td>
  				</tr>
		  </table>

				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> <!--/form-group-->			  

			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">

			        <button type="submit" name="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			        <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>
            <script>
                var data;
                function getProductData() {
                    var x = document.getElementById("productName").value;
                    console.log(x);
                    var res = x.split("-");
                    if(x != "none"){
                     document.getElementById("available_quantity").innerHTML = res[2];
                       
                    }
                    data = res;
                }
                function quantityChange(){
                    var qt = document.getElementById("quantity").value;
                    var price = Number(data[1])+5;
                    price *=qt;
                    document.getElementById("total").value = price;
                    document.getElementById("totalAmount").value = price;
                    document.getElementById("totalAmountValue").value = price;
                }
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </div>
            </body>
            </html>

