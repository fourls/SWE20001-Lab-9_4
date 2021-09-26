<?php

require("../db.php");

function fail($msg) {
    echo "<a href=\"add.php\">".$msg."</a>";
    die();
}

if(!isset($_POST["product_id"]))
    fail("Please provide a product ID.");
if(!isset($_POST["sale_quantity"]))
    fail("Please provide a quantity sold.");

$stmt = $conn->prepare("INSERT INTO sales_record (product_id, sale_quantity, sale_date) VALUES (?,?,?,NOW())");
$stmt->bind_param("ii",$_POST["product_id"], $_POST["sale_quantity"]);

$result = $stmt->execute();

if(!$result) {
    fail("Add failed - please provide valid values.");
} else {
    header("Location: show.php");
}