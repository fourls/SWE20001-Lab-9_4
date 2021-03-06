<?php
require("db.php");
require("data/salesreport.php");

function fail($msg) {
    echo $msg . " <a href=\"/displayreport.php\">Return</a>";
    die();
}

// get the start date from the URL (?date=....)

$show_report = isset($_GET["date"]);

if($show_report) {
    $start_of_month = $_GET["date"];
    $report_type = $_GET["report_type"] == "weekly" ? SALES_REPORT_WEEKLY : SALES_REPORT_MONTHLY;

    $start_date = DateTime::createFromFormat("d/m/Y", $start_of_month);

    if(!$start_date) {
        fail("Please write the date in the format d/m/Y.");
    }

    // generate the report (see salesreport.php for more)
    $report = SalesReport::generate(
        // the MySQL connection
        $conn,
        // the title of the sales report
        "PHP-SRePS sales for the ".($report_type == SALES_REPORT_WEEKLY ? "week" : "month")." beginning " . date_format($start_date, "d/m/Y"),
        // the start date of the report
        $start_date,
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
<a href="/displayreport.php">Return to site</a> |
<a href="/csvreport.php?date=<?php echo $start_of_month ?>&report_type=<?php echo $report_type ?>">Download as CSV</a>
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
<h2>Generate a PHP-SRePS sales report</h2>
<form action = "" method = "get" >
	<fieldset>
		<legend>Details</legend>
		<p>
            <label for="date">Starting date (dd/mm/yyyy): </label> 
			<input type="text" id="date" name= "date" placeholder="dd/mm/yyyy" />
            <br/>
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