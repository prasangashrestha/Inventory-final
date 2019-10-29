<?php

//Tuan Tu
//Day 3
//Join data to display daily data (even the day not have any sales)

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

//Tuan Tu
//Day 4
//Display the chart

//Tuan Tu
//Day 5
//Test data correctness
$query = "SELECT 
    cal.my_date        AS order_date, 
    COALESCE(t.total, 0) AS val
FROM 
    ( SELECT 
          s.start_date + INTERVAL (days.d) DAY  AS my_date
      FROM 
          ( SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH
                       AS start_date,
                   LAST_DAY(CURRENT_DATE) 
                       AS end_date
          ) AS s
          JOIN days  
              ON  days.d <= DATEDIFF(s.end_date, s.start_date)
    ) AS cal
    LEFT JOIN sales AS t 
        ON  t.order_date >= cal.my_date 
        AND t.order_date  < cal.my_date + INTERVAL 1 DAY
order by order_date ASC";
$result = mysqli_query($conn, $query);
$counter = 0;
$dataPoints = array();
while($row = mysqli_fetch_assoc($result)){
    $dataPoints[$counter] = array("label" => $row[order_date], "y" => $row[val]);
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
		text: "Daily Revenue October"
	},
	axisY: {
		title: "Revenue (AUD)"
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