<?php
require("db.php");
require("data/salesreport.php");

// get the start date from the URL (?date=....)

$show_report = isset($_GET["date"]);

if($show_report) {
    $start_of_month = $_GET["date"];
    $report_type = $_GET["report_type"] == "weekly" ? SALES_REPORT_WEEKLY : SALES_REPORT_MONTHLY;

    // generate the report (see salesreport.php for more)
    $report = SalesReport::generate(
        // the MySQL connection
        $conn,
        // the title of the sales report
        "PHP-SRePS sales for the month beginning " . date_format(date_create($start_of_month), "d/m/Y"),
        // the start date of the report
        DateTime::createFromFormat("Y-m-d", $start_of_month),
        // whether the sales report is monthly
        $report_type
    );


?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP-SRePS Sales Report</title>
</head>
<body>
<a href="/displaymonthly.php">Return to site</a>
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

<?php
} else { ?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'commits/header.inc'; ?>
    <title>PHP-SRePS Sales Report Generation</title>
</head>
<body>
<?php include 'commits/menu.inc';?>
<h1>Generate a PHP-SRePS sales report</h1>
<form action = "" method = "get" >
	<fieldset>
		<legend>Details</legend>
		<p>
            <label for="date">Starting date: </label> 
			<input type="text" id="date" name= "date" placeholder="YYYY-MM-DD" />
            <label for="report_type">Scale of report: </label> 
            <select name="report_type" id="report_type">
                <option value="monthly">Monthly</option>
                <option value="weekly">Weekly</option>
            </select>
		</p>
	</fieldset>

	<input type = "submit" name = "get" value = "Generate">
	<input type = "reset" value = "Reset">
</form>
<?php include 'commits/footer.inc'; ?>
</body>
</html>
<?php
}