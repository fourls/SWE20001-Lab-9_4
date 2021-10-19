<?php
require("db.php");
require("data/salesreport.php");

// get the start date from the URL (?date=....)
$start_of_month = $_GET["date"];
$report_type = $_GET["report_type"] == "weekly" ? SALES_REPORT_WEEKLY : SALES_REPORT_MONTHLY;

// if there isn't a ?date in the URL, then return to front page
// maybe change later
if(!isset($_GET["date"])) {
    header("Location: displayreport.php");
    die();
}

// set HTML headers to make it a downloadable csv file (got this from the internet, seems to work)
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=report.csv");

// generate the sales report
$report = SalesReport::generate(
    // the MySQL connection
    $conn,
    // the title of the sales report
    "PHP-SRePS sales for the ".($report_type == SALES_REPORT_WEEKLY ? "week" : "month")." beginning " . date_format(date_create($start_of_month), "d/m/Y"),
    // the start date of the report
    DateTime::createFromFormat("d/m/Y", $start_of_month),
    // whether the sales report is monthly
    $report_type
);

// open the webpage being built rn as a file stream (??? why does PHP let you do this)
$out = fopen("php://output", "w");

// echo the report title and the start date as a CSV row
fputcsv($out, [$report->report_name, $report->start_date->format("d/m/Y")]);
// echo header rows for the sales records as a CSV row
fputcsv($out, ["Sale ID", "Sale Date", "Product Name", "Product ID", "Sale Quantity"]);

// echo each sales record as a CSV row
foreach ($report->sales_records as $record) {
    $row = [];
    $row[] = $record->sale_id;
    $row[] = $record->sale_date->format("Y-m-d");
    $row[] = $record->product_name;
    $row[] = $record->product_id;
    $row[] = $record->sale_quantity;

    // echo as a CSV row
    fputcsv($out, $row);
}

// close file stream
fclose($out);