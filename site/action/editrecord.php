<?php

require("../db.php");

function fail($msg) {
    echo "<a href=\"edit.php\">".$msg."</a>";
    die();
}
if(!isset($_POST["product_id"]))
    fail("Please provide a product ID.");
if(!isset($_POST["product_name"]))
    fail("Please provide a product name.");
if(!isset($_POST["description"]))
    fail("Please provide a description.");
if(!isset($_POST["quantity"]))
    fail("Please provide a quantity.");

ini_set('display_errors', '1');
error_reporting(E_ALL);

$id = $_POST["product_id"];

$id_exists_stmt = $conn->prepare("SELECT count(*) AS count FROM products WHERE product_id = ?");
$id_exists_stmt->bind_param("i", $id);

$result = $id_exists_stmt->execute();

if(!$result) {
    fail("Database error.");
} else {
    $fetch = $result->fetch_assoc();

    if($fetch["count"] == 0) {
        fail("No product exists with that ID.");
    }
}

$stmt = $conn->prepare("UPDATE PRODUCTS SET product_name = ?, description = ?, quantity = ? WHERE product_id = ?");
$stmt->bind_param("ssii",$_POST["product_name"], $_POST["description"], $_POST["quantity"], id);

$result = $stmt->execute();

if(!$result) {
    fail("Please provide valid values.");
} else {
    header("Location: show.php");
}