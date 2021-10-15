<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'commits/header.inc'; ?>
 <title>Edit Sales</title>
</head>
<body>
<?php include 'commits/menu.inc';?>
<h2>Edit Sales </h2>
<section class ="sale">
<form action = "action/editrecord.php" method = "post" >
	<fieldset>
		<legend>Details</legend>
		<p><label for="product_id">Product ID: </label> 
			<input type="text" id="product_id" name= "product_id" placeholder="0001" required="required"/>
		</p>
		<p><label for="sale_id">Sale ID: </label> 
			<input type="text" id="sale_id" name= "sale_id" required="required" />
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
<button type="button">Delete!</button>
</section> 
<?php include 'commits/footer.inc'; ?>
</body>
</html>