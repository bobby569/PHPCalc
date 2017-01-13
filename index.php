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
				if (strcmp($percentage, "custom") == 0) {
				    $percentage = isset($_POST['custom']) ? $_POST['custom'] : '';
				    if (empty($percentage)) {
				        $error = "Please enter the customized percentage";
                    }
                }
                $percentage_value = floatval($percentage);

                $people = isset($_POST['person']) ? $_POST['person'] : '';
                $people_value = floatval($people);
                if ($people_value == 0) {
                    $people_value = 1;
                }

				$tip_value = money_format('%.2n', $subtotal_value * $percentage_value / 100);
				$total_value = money_format('%.2n', $subtotal_value + $tip_value);
                $average_value = money_format('%.2n', $total_value / $people_value);
			} else {
				$hidden = "hidden";
			}
		 ?>

		<form id="myForm" action="index.php" method="POST">
			<h3>Bill subtotal: $ <input class="textbox" type="text" name="subtotal" placeholder="0.00" value="<?php echo $_POST['subtotal']; ?>"></h3>
			<h3>Tip percentage:</h3>
			<?php 
				$percents = array("10%", "15%", "20%");
				foreach ($percents as $p) {
					if (isset($_POST['percentage']) && $_POST['percentage']) {
						if (strchr($_POST['percentage'], $p)) {
							echo "<input type=\"radio\" name=\"percentage\" value=\"$p\" checked=\"checked\"> $p";
						} else {
							echo "<input type=\"radio\" name=\"percentage\" value=\"$p\"> $p";
						}
					} else {
						echo "<input type=\"radio\" name=\"percentage\" value=\"$p\"> $p";
					}
					
				}
			 ?>
            <br>
            <p><input type="radio" name="percentage" value="custom"> Customize: <input class="textbox" id="custom" type="text" name="custom" placeholder="0" value="<?php echo $_POST['custom']; ?>" disabled>%</p>
            <p>Split by: <input class="textbox" type="text" name="person" value="<?php echo $_POST['person']; ?>" placeholder="0"></p>
            <p id="submit"><input type="submit" name="submit"></p>
		</form>

		<div <?php echo $hidden; ?>>
			<?php
				if (empty($error)) {
					echo "<p id=\"tip\">Tip: $$tip_value</p>";
					echo "<p id=\"total\">Total: $$total_value</p>";
                    echo "<p id=\"people\">#people: $people_value</p>";
					echo "<p id=\"average\">Per person: $$average_value</p>";
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