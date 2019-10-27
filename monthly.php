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

$query = "select month(order_date) as month, sum(total) as val from sales WHERE year(order_date) = 2019 group by month(order_date)";

$result = mysqli_query($conn, $query);
$counter = 0;
$dataPoints = array();
while($row = mysqli_fetch_assoc($result)){
    $dataPoints[$counter] = array("label" => $row[month], "y" => $row[val]);
    $counter++;
}

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Monthly Revenue 2019"
	},
	axisY: {
		title: "Revenue (AUD)"
	},
	axisX: {
		title: "Month"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## AUD",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>