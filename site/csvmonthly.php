<?php
require("db.php");
require("data/salesreport.php");

$start_of_month = $_GET["date"];

if(!isset($_GET["date"])) {
    header("Location: index.php");
    die();
}

header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=report.csv");

$report = SalesReport::generate(
    $conn,
    "PHP-SRePS sales for the month beginning " . date_format(date_create($start_of_month), "d/m/Y"),
    DateTime::createFromFormat("Y-m-d", $start_of_month),
    SALES_REPORT_MONTHLY
);

$out = fopen("php://output", "w");

fputcsv($out, [$report->report_name, $report->start_date->format("d/m/Y")]);
fputcsv($out, ["Sale ID", "Sale Date", "Product Name", "Product ID", "Sale Quantity"]);

foreach ($report->sales_records as $record) {
    $row = [];
    $row[] = $record->sale_id;
    $row[] = $record->sale_date->format("Y-m-d");
    $row[] = $record->product_name;
    $row[] = $record->product_id;
    $row[] = $record->sale_quantity;
    fputcsv($out, $row);
}

fclose($out);