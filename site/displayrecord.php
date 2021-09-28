<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Display Record</title>
</head>
<body>
<h1>Display Record</h1>
<?php
 require("../db.php");
$conn = @mysqli_connect ($host,$user,$pwd,$sql_db);	
	if (!$conn) {
        echo"<p>Database connect failure</p>";
    }
    else{

		$query = "select sale_id, product_id, sale_quantity, sale_date from sales_record";		//Assign appropriate query here
		$result = mysqli_query ($conn, $query);

	    if (!$result) {								
			echo "<p>Something is wrong with", $query, "</p>";
        }
        else{
        	echo "<table border=\"1\">";
			echo "<tr>\n"
				    ."<th scope=\"col\">sale_id</th>\n"
			        ."<th scope=\"col\">product_id</th>\n"
				    ."<th scope=\"col\">sale_quantity</th>\n"
                    ."<th scope=\"col\">sale_date</th>\n"
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
		echo"<p>Database connection successful.</p>";
		mysqli_close($conn);
    }
    echo"<p><a href='index.php'>Manage</a></p>";


?>


</body>
</html>
