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
    fail("Please provide a description.");
if(!isset($_POST["product_quantity"]))
    fail("Please provide a quantity.");

$stmt = $conn->prepare("INSERT INTO product (product_id, product_name, product_description, product_quantity) VALUES (?,?,?,?)");
$stmt->bind_param("issi",$_POST["product_id"],$_POST["product_name"], $_POST["product_description"], $_POST["product_quantity"]);

$result = $stmt->execute();

if(!$result) {
    fail("Add failed - please provide valid values.");
} else {
    header("Location: ../show.php");
}