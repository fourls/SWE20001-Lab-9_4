<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <meta name="description" content="Sprint 1" />
 <meta name="keywords" content="PHP" />
 <title>Edit Sales</title>
</head>

<body>
<h1>Edit Sales </h1>
<form action = "action/editrecord.php" method = "post" >
	<fieldset>
		<legend>Details</legend>
		<p><label for="product_id">Product ID: </label> 
			<input type="text" id="product_id" name= "product_id" placeholder="0001" required="required"/>
		</p>
		<p><label for="sales_id">Sales ID: </label> 
			<input type="text" id="sales_id" name= "sales_id" required="required" />
		</p>
					
		<p><label for="sale_quantity">Sales Quantity: </label> 
			<input type="number" id="sale_quantity" name= "sale_quantity" required="required" />
		</p>			
	</fieldset>

	<input type = "submit" name = "posted" value = "Post">
	<input type = "reset" value = "Reset">
</form>
<br>
<br>
<?php
echo "<a href='index.php'>Return Home</a>";
?>

</form>
</body>
</html>