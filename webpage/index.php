<?php
//This line will make the page auto-refresh each 15 seconds
//$page = $_SERVER['PHP_SELF'];
//$sec = "15";
?>


<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

	<title>Glasshaus</title>

	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">	

	<script src="//cdn.amcharts.com/lib/4/core.js"></script>
	<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
	<script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>	

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

	<style>
		@import url("https://fonts.googleapis.com/css?family=Archivo+Narrow");

		body {
		  font-family: "Archivo Narrow";
		}
		#chartdiv {
		  width: 100%;
		  height: 100%;
		}
	</style>
	
</head>
	
	
<body>    
<div class="container">
        <h3>Glasshaus Webapp</h3>
        <div class="row">
			<div class="col-6">
				<div>Wasserniveau:</div>
				<div id="chartdiv"></div>
			</div>
			<div class="col-6">
				<div>Temperatur:</div>
				<div id="chartdiv_temp"></div>
			</div>

        </div>
        <br>
		<div class="col">

	<?php
	
		include("database_connect.php");

		$unit_id = $row['id'];

		$act1 = "act1";
		$act2 = "act2";
		$act3 = "act3";
		$act4 = "act4";
		
		$current_act_1 = $row['act1'];
		$current_act_2 = $row['act2'];
		$current_act_3 = $row['act3'];
		$current_act_4 = $row['act4'];

		if($current_act_1 == 1){
		$inv_current_act_1 = 0;
		$text_current_act_1 = "ON";
		$color_current_act_1 = "#6ed829";
		$button_class_act_1 = "btn btn-success";
		}
		else{
		$inv_current_act_1 = 1;
		$text_current_act_1 = "OFF";
		$color_current_act_1 = "#e04141";
		$button_class_act_1 = "btn btn-danger";
		}
		
		
		if($current_act_2 == 1){
		$inv_current_act_2 = 0;
		$text_current_act_2 = "ON";
		$color_current_act_2 = "#6ed829";
		$button_class_act_2 = "btn btn-success";
		}
		else{
		$inv_current_act_2 = 1;
		$text_current_act_2 = "OFF";
		$color_current_act_2 = "#e04141";
		$button_class_act_2 = "btn btn-danger";
		}
		
		
		if($current_act_3 == 1){
		$inv_current_act_3 = 0;
		$text_current_act_3 = "ON";
		$color_current_act_3 = "#6ed829";
		$button_class_act_3 = "btn btn-success";
		}
		else{
		$inv_current_act_3 = 1;
		$text_current_act_3 = "OFF";
		$color_current_act_3 = "#e04141";
		$button_class_act_3 = "btn btn-danger";
		}
		
		
		if($current_act_4 == 1){
		$inv_current_act_4 = 0;
		$text_current_act_4 = "ON";
		$color_current_act_4 = "#6ed829";
		$button_class_act_4 = "btn btn-success";
		}
		else{
		$inv_current_act_4 = 1;
		$text_current_act_4 = "OFF";
		$color_current_act_4 = "#e04141";
		$button_class_act_4 = "btn btn-danger";
		}

		echo "<hr>";
		echo "<h3>Actuators</h3>";
		echo "<div class='row' >";
		echo "<div class='col'>
		<form action= update_values.php method= 'post'>
		<p>Act 1:</p>
		<input type='hidden' name='value2' value=$current_act_1  >	
		<input type='hidden' name='value' value=$inv_current_act_1 >	
		<input type='hidden' name='unit' value=$unit_id >
		<input type='hidden' name='column' value=$act1 >
		<input type= 'submit' name= 'change_but' class = '$button_class_act_1' value='$text_current_act_1'></form>
		</div>";

		echo "<div class='col'>
		<form action= update_values.php method= 'post'>
		<p>Act 2:</p>
		<input type='hidden' name='value2' value=$current_act_2   size='15' >	
		<input type='hidden' name='value' value=$inv_current_act_2  size='15' >	
		<input type='hidden' name='unit' value=$unit_id >
		<input type='hidden' name='column' value=$act2 >
		<input type= 'submit' name= 'change_but' class = '$button_class_act_2' value=$text_current_act_2></form>
		</div>";
		
		
		echo "<div class='col'>
		<form action= update_values.php method= 'post'>
		<p>Act 3:</p>
		<input type='hidden' name='value2' value=$current_act_3   size='15' >	
		<input type='hidden' name='value' value=$inv_current_act_3  size='15' >	
		<input type='hidden' name='unit' value=$unit_id >
		<input type='hidden' name='column' value=$act3 >
		<input type= 'submit' name= 'change_but' class = '$button_class_act_3' value=$text_current_act_3></form>
		</div>";
		
		
		echo "<div class='col'>
		<form action= update_values.php method= 'post'>
		<p>Act 4:</p>
		<input type='hidden' name='value2' value=$current_act_4   size='15' >	
		<input type='hidden' name='value' value=$inv_current_act_4  size='15' >	
		<input type='hidden' name='unit' value=$unit_id >
		<input type='hidden' name='column' value=$act4 >
		<input type= 'submit' name= 'change_but' class = '$button_class_act_4' value=$text_current_act_4></form>
		</div>";
		

		echo "</div><hr>";
		echo "<h3>Behälter</h3>";

		echo "<div class='row'>";
		
		$behaelterMax = "behelterMax";
		$behaelterMin = "behelterMin";
		$tempMax = "tempMax";
		$tempMin = "tempMin";
		
		$current_BehaelterMax = $row['behelterMax'];
		$current_BehaelterMin = $row['behelterMin'];
		$current_TempMax = $row['tempMax'];
		$current_TempMin = $row['tempMin'];
		
		
		echo "<div class='col-sm'>
		<form action= update_values.php method= 'post'>
		<p>Behälter Min:</p>
		<div class='progress' style='height: 40px;'>

		<div class='progress-bar bg-warning progress-bar-striped progress-bar-animated' role='progressbar' style='width: $current_BehaelterMin%;' aria-valuenow='$current_BehaelterMin' aria-valuemin='0' aria-valuemax='100'>$current_BehaelterMin%</div>
		</div><br>

		<input type='range' name='value' class='form-range' min='0' max='100' step='5' value=$current_BehaelterMin id='customRange2'>

		<input type='hidden' name='unit' style='width: 120px;' value=$unit_id >
		<input type='hidden' name='column' style='width: 120px; width: 120px;' value=$behaelterMin >
		<input type= 'submit' name= 'change_but' style='width: 120px; text-align:center;' value='Ändern'></form>
		</div>";


		echo "<div class='col-sm'>
		<form action= update_values.php method= 'post'>
		<p>Behälter Max:</p>
		<div class='progress' style='height: 40px;'>
		<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' style='width: $current_BehaelterMax%;' aria-valuenow='$current_BehaelterMax' aria-valuemin='0' aria-valuemax='100'>$current_BehaelterMax%</div>
		</div><br>

		<input type='range' name='value' class='form-range' min='0' max='100' step='5' value=$current_BehaelterMax id='customRange2'>
		
		<input type='hidden' name='unit' style='width: 120px;' value=$unit_id >
		<input type='hidden' name='column' style='width: 120px;' value=$behaelterMax >
		<input type= 'submit' name= 'change_but' style='width: 120px; text-align:center;' value='Ändern'></form>
		</div>";
		

		echo "</div>";
		echo"<hr>";
		echo "<div class='row'>";
		echo "<h3>Temperatur</h3>";
		
		
		
		echo "<div class='col-sm'>
		<form action= update_values.php method= 'post'>
		<p>Temperatur Min:</p>
		<div class='progress' style='height: 15px;'>
		<div class='progress-bar bg-warning progress-bar-striped progress-bar-animated' role='progressbar' style='width: $current_TempMin%;' aria-valuenow='$current_TempMin' aria-valuemin='0' aria-valuemax='100'>$current_TempMin °C</div>
		</div><br>

		<input type='range' name='value' class='form-range' min='0' max='100' value=$current_TempMin id='customRange2'>

		<input type='hidden' name='unit' style='width: 120px;' value=$unit_id >
		<input type='hidden' name='column' style='width: 120px;' value=$tempMin >
		<input type= 'submit' name= 'change_but' style='width: 120px; text-align:center;' value='Ändern'></form>
		</div>";

		echo "<div class='col-sm'>
		<form action= update_values.php method= 'post'>
		<p>Temperatur Max:</p>
		<div class='progress' style='height: 15px;'>
		<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' style='width: $current_TempMax%;' aria-valuenow='$current_TempMax' aria-valuemin='0' aria-valuemax='100'>$current_TempMax °C</div>
		</div><br>

		<input type='range' name='value' class='form-range' min='0' max='100' value=$current_TempMax id='customRange2'>

		<input type='hidden' name='unit' style='width: 120px;' value=$unit_id >
		<input type='hidden' name='column' style='width: 120px;' value=$tempMax >
		<input type= 'submit' name= 'change_but' style='width: 120px; text-align:center;' value='Ändern'></form>
		</div>";
		
		
		echo "</div><hr>";

	?>

		</div>
	</div>
</div>


<script src="gauge.js"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>