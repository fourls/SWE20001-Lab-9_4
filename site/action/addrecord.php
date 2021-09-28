<?php

require("../db.php");

function fail($msg) {
    echo "<a href=\"../add.php\">".$msg."</a>";
    die();
}

if(!isset($_POST["product_id"]))
    fail("Please provide a product ID.");
if(!isset($_POST["sale_quantity"]))
    fail("Please provide a quantity sold.");
if(!isset($_POST["sale_date"]))
    fail("Please provide a sale date in Y/m/d format.");

$stmt = $conn->prepare("INSERT INTO sales_record (product_id, sale_quantity, sale_date) VALUES (?,?,?)");
$stmt->bind_param("iis",$_POST["product_id"], $_POST["sale_quantity"], $_POST["sale_date"]);

$result = $stmt->execute();

if(!$result) {
    fail("Add failed - please provide valid values.");
} else {
    header("Location: ../show.php");
}