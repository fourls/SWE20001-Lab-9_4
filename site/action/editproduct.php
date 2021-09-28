<?php

require("../db.php");

function fail($msg) {
    echo $msg;
    die();
}
if(!isset($_POST["product_id"]))
    fail("Please provide a product ID.");
if(!isset($_POST["product_name"]))
    fail("Please provide a product name.");
if(!isset($_POST["product_description"]))
    fail("Please provide a product description.");
if(!isset($_POST["product_quantity"]))
    fail("Please provide a product quantity.");
    
$id = $_POST["product_id"];

$id_exists_stmt = $conn->prepare("SELECT count(*) AS count FROM product WHERE product_id = ?");
$id_exists_stmt->bind_param("i", $id);

$exists_ok = $id_exists_stmt->execute();

if(!$exists_ok) {
    fail("Database error.");
} else {
    $id_exists_stmt->bind_result($count);
    $id_exists_stmt->fetch();

    if($count == 0) {
        fail("No product exists with that ID.");
    }
}

$id_exists_stmt->close();

$update_stmt = $conn->prepare("UPDATE product SET product_name = ?, product_description = ?, product_quantity = ? WHERE product_id = ?");
$update_stmt->bind_param("ssii",$_POST["product_name"], $_POST["product_description"], $_POST["product_quantity"], $id);

$update_ok = $update_stmt->execute();

if(!$update_ok) {
    fail("Please provide valid values.");
} else {
    header("Location: show.php");
}