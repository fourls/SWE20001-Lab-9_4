<?php
require("db.php");
require("data/salesreport.php");

// get the start date from the URL (?date=....)
$start_of_month = $_GET["date"];

// if there isn't a ?date in the URL, then return to front page
// maybe change later
if(!isset($_GET["date"])) {
    header("Location: index.php");
    die();
}

// generate the report (see salesreport.php for more)
$report = SalesReport::generate(
    // the MySQL connection
    $conn,
    // the title of the sales report
    "PHP-SRePS sales for the month beginning " . date_format(date_create($start_of_month), "d/m/Y"),
    // the start date of the report
    DateTime::createFromFormat("Y-m-d", $start_of_month),
    // whether the sales report is monthly
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
// if there is an error message in the report, echo it
if (!empty($report->message)) {								
    echo "<p>".$report->message."</p>";
} else {
    echo "<table border=\"1\">";
    echo "<tr>\n"
            ."<th scope=\"col\">Date</th>\n"
            ."<th scope=\"col\">Product</th>\n"
            ."<th scope=\"col\">Quantity</th>\n"
            ."</tr>\n";

    // go through all sales records and echo each row to the page
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
