<?php

require("../db.php");

function fail($msg) {
    echo "<a href=\"../edit.php\">".$msg."</a>";
    die();
}

if(!isset($_POST["sale_id"]))
    fail("Please provide a sale ID.");
if(!isset($_POST["product_id"]))
    fail("Please provide a product ID.");
if(!isset($_POST["sale_quantity"]))
    fail("Please provide a quantity sold.");
    
$id = $_POST["sale_id"];

$id_exists_stmt = $conn->prepare("SELECT count(*) AS count FROM sales_record WHERE sale_id = ?");
$id_exists_stmt->bind_param("i", $id);

$exists_ok = $id_exists_stmt->execute();

if(!$exists_ok) {
    fail("Database error.");
} else {
    $id_exists_stmt->bind_result($count);
    $id_exists_stmt->fetch();

    if($count == 0) {
        fail("No sales record exists with that ID.");
    }
}

$id_exists_stmt->close();

$update_stmt = $conn->prepare("UPDATE sales_record SET product_id = ?, sale_quantity = ? WHERE product_id = ?");
$update_stmt->bind_param("iii",$_POST["product_id"], $_POST["sale_quantity"], $id);

$update_ok = $update_stmt->execute();

if(!$update_ok) {
    fail("Please provide valid values.");
} else {
    header("Location: show.php");
}