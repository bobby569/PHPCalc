<!DOCTYPE html>
<html>
<head>
	<title>Tip Calculator</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="content">
		<h1>Tip Calculator</h1>
		
		<?php
			$error = "";
			if (isset($_POST['submit'])) {
				$subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : '';
				$subtotal_value = floatval($subtotal);
				if ($subtotal_value == 0) {
					$error = "Please enter a valid money amount";
				}
				$percentage = isset($_POST['percentage']) ? $_POST['percentage'] : '';
				if (empty($percentage)) {
					$error = "Please choose the tip percentage";
				}
				$percentage_value = floatval($percentage);
				$tip_value = money_format('%.2n', $subtotal_value * $percentage_value / 100);
				$total_value = money_format('%.2n', $subtotal_value + $tip_value);
			} else {
				$hidden = "hidden";
			}
		 ?>

		<form action="index.php" method="POST">
			<h3>Bill subtotal: $ <input type="text" id="subtotal" name="subtotal" placeholder="0.00"></h3>
			<h3>Tip percentage:</h3>
			<?php 
				$percents = array("10%", "15%", "20%");
				foreach ($percents as $p) {
					echo "<input type=\"radio\" name=\"percentage\" value=\"$p\"> $p";
				}
			 ?>
			 <br>
			 <input type="submit" name="submit">
		</form>

		<div <?php echo $hidden; ?>>
			<?php
				if (empty($error)) {
					echo "<p id=\"tip\">Tip: $tip_value</p>";
					echo "<p id=\"total\">Total: $total_value</p>";
				} else {
					echo "<p id=\"error\">Error: $error</p>";
				}
			 ?>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>