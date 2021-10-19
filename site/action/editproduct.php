<?php

require("../db.php");

function fail($msg) {
    echo $msg;
    die();
}

// make sure all the required fields exist
if(!isset($_POST["product_id"]))
    fail("Please provide a product ID.");
if(!isset($_POST["product_name"]))
    fail("Please provide a product name.");
if(!isset($_POST["product_description"]))
    fail("Please provide a product description.");
if(!isset($_POST["product_quantity"]))
    fail("Please provide a product quantity.");
if(!isset($_POST["product_price"]))
    fail("Please provide a product price.");

// Check if the product ID already exists or not - it needs to
$id = $_POST["product_id"];
$id_exists_stmt = $conn->prepare("SELECT count(*) AS count FROM product WHERE product_id = ?");
$id_exists_stmt->bind_param("i", $id);

$exists_ok = $id_exists_stmt->execute();

if(!$exists_ok) {
    fail("Database error.");
} else {
    $id_exists_stmt->bind_result($count);
    $id_exists_stmt->fetch();
    
    // if there were no products with that product ID, fail - we're editing, not creating
    if($count == 0) {
        fail("No product exists with that ID.");
    }
}

// close ID exists statements
$id_exists_stmt->close();

// prepare the update statement - see salesreport.php for link on prepared statements
$update_stmt = $conn->prepare("UPDATE product SET product_name = ?, product_desc = ?, product_quantity = ?, product_price = ? WHERE product_id = ?");
// bind the params
$update_stmt->bind_param("ssidi",$_POST["product_name"], $_POST["product_description"], $_POST["product_quantity"], $_POST["product_price"], $id);
// execute the statement
$update_ok = $update_stmt->execute();

// if the update failed, let the user know, otherwise direct to show.php
if(!$update_ok) {
    fail("Please provide valid values.");
} else {
    header("Location: ../show.php");
}