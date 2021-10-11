<?php

$out = fopen("php://output", "w");

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

