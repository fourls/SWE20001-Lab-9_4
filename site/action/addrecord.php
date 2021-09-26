<?php

require("../db.php");

function fail($msg) {
    echo "<a href=\"add.php\">".$msg."</a>";
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

$stmt = $conn->prepare("INSERT INTO products (product_id, product_name, description, quantity) VALUES (?,?,?,?)");
$stmt->bind_param("issi",$_POST["product_id"],$_POST["product_name"], $_POST["description"], $_POST["quantity"]);

$result = $stmt->execute();

if(!$result) {
    fail("Add failed - please provide valid values.");
} else {
    header("Location: show.php");
}