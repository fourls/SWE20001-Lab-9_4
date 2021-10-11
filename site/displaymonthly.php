<?php
require("db.php");
require("data/salesreport.php");

$start_of_month = $_GET["date"];

if(!isset($_GET["date"])) {
    header("Location: index.php");
    die();
}

$report = SalesReport::generate(
    $conn,
    "PHP-SRePS sales for the month beginning " . date_format(date_create($start_of_month), "d/m/Y"),
    DateTime::createFromFormat("Y-m-d", $start_of_month),
    SALES_REPORT_MONTHLY
);

?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP-SRePS Sales Report</title>
</head>
<body>
<h1>PHP-SRePS Sales Report</h1>
<h2><?php echo $report->report_name ?></h2>
<section class ="sale">
<?php
if (!empty($report->message)) {								
    echo "<p>".$report->message."</p>";
} else {
    echo "<table border=\"1\">";
    echo "<tr>\n"
            ."<th scope=\"col\">Date</th>\n"
            ."<th scope=\"col\">Product</th>\n"
            ."<th scope=\"col\">Quantity</th>\n"
            ."</tr>\n";
    // retrieve current record pointed by the result pointer

    foreach ($report->sales_records as $row) {
        echo "<tr>";
        echo "<td>",$row->sale_date->format("d/m/Y"),"</td>\n";
        echo "<td>",$row->product_name,"(",$row->product_id,")</td>\n";
        echo "<td>",$row->sale_quantity,"</td>\n";
        echo "</tr>";
    }
    echo "</table>\n";
}
?>

</section>
</body>
</html>
