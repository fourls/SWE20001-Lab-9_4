<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'commits/header.inc'; ?>
 <title>Edit Product</title>
</head>
<body>
<?php include 'commits/menu.inc';?>
<h2>Edit Product </h2>
<section class ="product">
<form action = "action/editproduct.php" method = "post" >
	<fieldset>
		<legend>Details</legend>
		<p><label for="product_id">Product ID to edit: </label> 
			<input type="text" id="product_id" name= "product_id" placeholder="0001" required="required"/>
		</p>
		<p><label for="product_name">New product name: </label> 
			<input type="text" id="product_name" name= "product_name" required="required" />
		</p>
			
        <p><label class="product_description">New description: </label></p>  
			<textarea class="product_description" id="product_description" name="product_description" rows="5" cols="25" placeholder="Enter description of product" required="required"></textarea>

		<p><label for="product_quantity">New product quantity: </label> 
			<input type="number" id="product_quantity" name= "product_quantity" required="required" />
		</p>	
		<p><label for="product_price">New product price: </label> 
			<input type="number" id="product_price" name= "product_price" required="required" step=".01" />
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
</section> 
<?php include 'commits/footer.inc'; ?>
</body>
</html>