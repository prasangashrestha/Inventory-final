
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
		  
			<a href="#" class="brand-logo center">Inventory Management</a>
		  
		</div>
	  </nav>
			  <div class="success-messages"></div> <!--/success-messages-->
  
			<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">
  
				<div class="form-group">
				  <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
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
  
				<table id="productTable">
						<tr>			  			
							<th>Product</th>
							<th>Available Quantity</th>
							<th>Quantity</th>			  			
							<th>Total</th>			  			
							<th>others</th>
						</tr>
					<tr>			  				
					  <td>
						   <select class="form-control" name="productName[]" id="productName" onchange="getProductData()" >
								<option value="">~~SELECT~~</option>
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
						  <p id="available_quantity"></p>
						</td>
						<td >
						  <input type="number" name="quantity" id="quantity" min="1"  onkeyup="quantityChange()"/>
						</td>
						<td >		
							<input type="text" name="total" id="total" />
						</td>
						<td>
							<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow()"><i class="glyphicon glyphicon-trash">Delete Row</i></button>
						</td>
					</tr>
			</table>
  
				<div class="col-md-6">
					<div class="form-group">
					  <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
						<input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
					  </div>
					</div> <!--/form-group-->			  
					 <!--/form-group-->			  
					<div class="form-group">
					  <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
						<input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
					  </div>
					</div> <!--/form-group-->			  
					<div class="form-group">
					  <label for="discount" class="col-sm-3 control-label">Discount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
					  </div>
					</div> <!--/form-group-->	
					<div class="form-group">
					  <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
						<input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
					  </div>
					</div> <!--/form-group-->	
					<div class="form-group">
					  <label for="vat" class="col-sm-3 control-label gst">GST 18%</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="vat" name="gstn" readonly="true" />
						<input type="hidden" class="form-control" id="vatValue" name="vatValue" />
					  </div>
					</div>	  		  
				</div> <!--/col-md-6-->
  
				<div class="col-md-6">
					<div class="form-group">
					  <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
					  </div>
					</div> <!--/form-group-->			  
					<div class="form-group">
					  <label for="due" class="col-sm-3 control-label">Due Amount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="due" name="due" disabled="true" />
						<input type="hidden" class="form-control" id="dueValue" name="dueValue" />
					  </div>
					</div> <!--/form-group-->		
					<div class="form-group">
					  <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
					  <div class="col-sm-9">
						<select class="form-control" name="paymentType" id="paymentType">
							<option value="">~~SELECT~~</option>
							<option value="1">Cheque</option>
							<option value="2">Cash</option>
							<option value="3">Credit Card</option>
						</select>
					  </div>
					</div> <!--/form-group-->							  
					<div class="form-group">
					  <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
					  <div class="col-sm-9">
						<select class="form-control" name="paymentStatus" id="paymentStatus">
							<option value="">~~SELECT~~</option>
							<option value="1">Full Payment</option>
							<option value="2">Advance Payment</option>
							<option value="3">No Payment</option>
						</select>
					  </div>
					</div> <!--/form-group-->
				</div> <!--/col-md-6-->
  
  
				<div class="form-group submitButtonFooter">
				  <div class="col-sm-offset-2 col-sm-10">
					  <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>
  
					  <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
  
					  <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
				  </div>
				</div>
			  </form>
			  <script>
				  var price;
				  function getProductData() {
					  var x = document.getElementById("productName").value;
					  console.log(x);
					  var res = x.split("-");
					  document.getElementById("available_quantity").innerHTML = res[2];
					  price = res[1];
				  }
				  function quantityChange(){
					  var qt = document.getElementById("quantity").value;
					  price *= qt;
					  document.getElementById("total").value = price;
				  }
				  function addRow(){
					  var table = document.getElementById("productTable");
					  var row = table.insertRow(2);
					  var cell1= row.insertCell(0);
					  var cell2 = row.insertCell(1);
					  var cell3 = row.insertCell(2);
					  var cell4 = row.insertCell(3);
					  var cell5 = row.insertCell(4);
					  cell1.innerHTML = '<select class="form-control" name="productName[]" id="productName" onchange="getProductData()" ><option value="">~~SELECT~~</option>	\<?php $productSql = "SELECT * FROM item";$productData = mysqli_query($conn, $productSql);while($row =mysqli_fetch_assoc($productData)) {$value = $row["item_id"]."-".$row["price"]."-".$row["quantity"];	$name = $row["name"];echo "<option value=$value>$name</option>";} ?></select>';
					  cell2.innerHTML = '<p id="available_quantity"></p>';
					  cell3.innerHTML = '<input type="number" name="quantity" id="quantity" min="1"  onkeyup="quantityChange()"/>';
					  cell4.innerHTML = '<input type="text" name="total" id="total" />';
					  cell5.innerHTML = '<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow()"><i class="glyphicon glyphicon-trash">Delete Row</i></button>';
				  }
			  </script>
			  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
			  
			  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
			  </div>
			  </body>
			  </html>
  
  