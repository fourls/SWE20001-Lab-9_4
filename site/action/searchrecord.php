<?php

require("../db.php");

function fail($msg) {
    echo "<a href=\"../show.php\">".$msg."</a>";
    die();
}

if(!isset($_POST["product_id"]))
    fail("Please provide a product ID.");
if(!isset($_POST["sale_id"]))
    fail("Please provide a sale ID.");

	$stmt = $conn->prepare("INSERT INTO sales_record (product_id, sale_quantity, sale_date) VALUES (?,?,?)");
	$stmt->bind_param("iis",$_POST["product_id"], $_POST["sale_id"]);
	
	$result = $stmt->execute();
	
	if(!$result) {
		fail("Add failed - please provide valid values.");
	} else {
		header("Location: ../show.php");
	}
