<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'commits/header.inc'; ?>
 <title>Add Sales</title>
</head>
<body>
<?php include 'commits/menu.inc';?>
<h2>Addform.php</h2>
<form action = "Addprocess.php" method = "post" >
	<fieldset>
		<legend>Details</legend>
		<!--
			Both product Id and name are required even though the id for each product would be the id(eg 0001), so you have to enter both, acts a "security measure."
		-->
		
		<p><label for="product_id">Product ID: </label> 
				<input type="text" id="product_id" name= "product_id" placeholder="0001" required="required"/>
			</p>

			<p><label for="product_name">Location: </label>
				<select id="product_name" name="product_name" >
				<option value="" selected="selected">---</option>
					<option value="Product 1" id="0001">Product 1</option>
					<option value="Product 2" id="0002">Product 2</option>
					<option value="Product 3" id="0003">Product 3</option>
					<option value="Product 4" id="0004">Product 4</option>
				</select>
			</p>

			<p><label for="sale_quantity">Quantity: </label> 
				<input type="number" name= "sale_quantity" id="sale_quantity" required="required" />
			</p>
			
			<p><label for="sale_id">Sale ID: </label> 
				<input type="text" id="sale_id" name= "sale_id" required="required" />
			</p>
			
			<p><label class="desc">Description: </label></p>  
				<textarea class="desc" name="desc" rows="5" cols="25" placeholder="Enter description of Sale" required="required"></textarea>
						
			<p><label for="sale_date">Sale Date: </label> 
				<input type="text" id="sale_date" name= "sale_date" required="required" value="<?php echo date('d/m/y');?>"/>
			</p>
</fieldset>

<input type = "submit" name = "posted" value = "Post">
<input type = "reset" value = "Reset">
<br>
<br>
<?php
echo "<a href='index.php'>Return Home</a>";
?>

</form>
<?php include 'commits/footer.inc'; ?>
</body>
</html>