<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <meta name="description" content="Sprint 1" />
 <meta name="keywords" content="PHP" />
 <title>Edit Sales</title>
</head>

<body>
<h1>Search </h1>
<form action = "action/searchrecord.php" method = "post" >
	<fieldset>
		<legend>Details</legend>
		<p><label for="product_id">Product ID: </label> 
			<input type="text" id="product_id" name= "product_id" placeholder="Ënter Product ID to search" />
		</p>
		<p><label for="sale_id">Sale ID: </label> 
			<input type="text" id="sale_id" name= "sale_id" placeholder="Ënter Product ID to search" />
		</p>
					
				
	</fieldset>

	<input type = "submit" name = "posted" value = "Search">
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