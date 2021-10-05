<?php
require("db.php");

$start_of_month = $_GET["date"];

if(!isset($_GET["date"])) {
    header("Location: index.php");
    die();
}

$stmt = $conn->prepare("SELECT product_name, product_id, sale_quantity, sale_date from sales_record NATURAL JOIN product WHERE sale_date BETWEEN ? AND DATE_ADD(?, INTERVAL 1 MONTH) ORDER BY sale_date ASC");
$stmt->bind_param("ss", $start_of_month, $start_of_month);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP-SRePS Sales Report</title>
</head>
<body>
<h1>PHP-SRePS Sales Report</h1>
<h2>For the month beginning <?php echo date_format(date_create($start_of_month), "d/m/Y"); ?></h2>
<section class ="sale">
<?php
if (!$result) {								
    echo "<p>Something is wrong with", $query, "</p>";
} else {
    echo "<table border=\"1\">";
    echo "<tr>\n"
            ."<th scope=\"col\">Date</th>\n"
            ."<th scope=\"col\">Product</th>\n"
            ."<th scope=\"col\">Quantity</th>\n"
            ."</tr>\n";
    // retrieve current record pointed by the result pointer
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>",$row["sale_date"],"</td>\n";
        echo "<td>",$row["product_name"]," (",$row["product_id"],")</td>\n";
        echo "<td>",$row["sale_quantity"],"</td>\n";
        echo "</tr>";
    }
    echo "</table>\n";
    $result->free();
}

$conn->close();
?>

</section>
</body>
</html>
