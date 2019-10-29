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

$query = "SELECT name, SUM(total) as product_total from sales s join item i on s.product_id = i.item_id group by product_id";
$result = mysqli_query($conn, $query);
$counter = 0;
$dataPoints = array();
while($row = mysqli_fetch_assoc($result)){
    $dataPoints[$counter] = array("label" => $row[name], "y" => $row[product_total]);
    $counter++;
}

?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Revenue by Product Sales"
	},
	subtitles: [{
		text: "Currency: Australian Dollar (AUD)"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "AUD#,##0",
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