<!DOCTYPE html>
<html>
<head>
<?php include 'commits/header.inc'; ?>
    <title>Display Record</title>
</head>
<body>
<?php include 'commits/menu.inc';?>
	<h1>Search </h1>
<form action = "show.php" method = "get" >
	<fieldset>
		<legend>Details</legend>
		<p><label for="product_id">Product ID: </label> 
			<input type="text" id="product_id" name= "product_id" placeholder="Ënter Product ID to search" />
		</p>
		<p><label for="sale_id">Sale ID: </label> 
			<input type="text" id="sale_id" name= "sale_id" placeholder="Ënter Product ID to search" />
		</p>
					
				
	</fieldset>

	<input type = "submit" name = "get" value = "Search">
	<input type = "reset" value = "Reset">
</form>
<h2>Display Record</h2>
<section class ="sale">
<?php
 require("db.php");

	if (!$conn) {
        echo"<p>Database connect failure</p>";
    }
    else{

		$Sid = $_GET["sale_id"];
		$Pid = $_GET["product_id"];
		
		if(isset($_GET["sale_id"]) && $_GET["sale_id"] != ""){

			$query = "select sale_id, product_id, sale_quantity, sale_date from sales_record where sale_id like '%$Sid'";
		}
		if(isset($_GET["product_id"]) && $_GET["product_id"] != ""){
			$query = "select sale_id, product_id, sale_quantity, sale_date from sales_record where product_id like '%$Pid'";

		}
		
		if($_GET["sale_id"] == "" && $_GET["product_id"] == ""){
			$query = "select sale_id, product_id, sale_quantity, sale_date from sales_record";		//Assign appropriate query here
		}
		
		$result = mysqli_query ($conn, $query);

	    if (!$result) {								
			echo "<p>Something is wrong with", $query, "</p>";
        }
        else{
        	echo "<table border=\"1\">";
			echo "<tr>\n"
				    ."<th scope=\"col\">Sale ID</th>\n"
			        ."<th scope=\"col\">Product ID</th>\n"
				    ."<th scope=\"col\">Quantity sold</th>\n"
                    ."<th scope=\"col\">Date sold</th>\n"
				    ."</tr>\n";
			// retrieve current record pointed by the result pointer
			
			while ($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>",$row["sale_id"],"</td>\n";
				echo "<td>",$row["product_id"],"</td>\n";  
				echo "<td>",$row["sale_quantity"],"</td>\n";
				echo "<td>",$row["sale_date"],"</td>\n";
				echo "</tr>";
			}
			echo "</table>\n";
			mysqli_free_result($result);
		} 
		mysqli_close($conn);
    }
?>

</section>

<?php include 'commits/footer.inc'; ?>
</body>
</html>
