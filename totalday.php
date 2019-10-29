<?php
//Tuan Tu
//Day 5
//Test data correctness
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

$query = "SELECT order_date, SUM(total) as day_total from sales group by order_date";
$result = mysqli_query($conn, $query);
$counter = 0;
$dataPoints = array();
while($row = mysqli_fetch_assoc($result)){
    $dataPoints[$counter] = array("y" => $row[day_total], "label" => $row[order_date]);
    $counter++;
}

/*
$dataPoints = array(
	array("y" => 25, "label" => "Sunday"),
	array("y" => 15, "label" => "Monday"),
	array("y" => 25, "label" => "Tuesday"),
	array("y" => 5, "label" => "Wednesday"),
	array("y" => 10, "label" => "Thursday"),
	array("y" => 0, "label" => "Friday"),
	array("y" => 20, "label" => "Saturday")
);
*/

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Revenue-Date Report"
	},
	axisY: {
		title: "Revenue"
	},
	axisX: {
		title: "Date"
	},
	data: [{
		type: "line",
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