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

$stmt = $conn->prepare("UPDATE PRODUCTS SET product_name = ?, description = ?, quantity = ? WHERE product_id = ?");
$stmt->bind_param("ssii",$_POST["product_name"], $_POST["description"], $_POST["quantity"], $_POST["product_id"]);

$result = $stmt->execute();

if(!$result) {
    fail("Please provide valid values.");
} else {
    header("Location: show.php");
}