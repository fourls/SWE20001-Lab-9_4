<?php

require("../db.php");

// Sanitise data given by the user by trimming, stripping slashes, removing HTML special characters, 
// and escaping the string using MySQL escaping
function sanitise($data,$conn=null) {
    if(is_array($data)) {
        $data = implode(",",$data);
    }
    
	$data = trim($data);
	$data = stripslashes($data);
    $data = htmlspecialchars($data);
    if($conn != null) {
        $data = $conn->real_escape_string($data);
    }
	return $data;
}

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
$stmt->bind_param("ssds",$_POST["product_name"], $_POST["description"], $_POST["quantity"], $_POST["product_id"]);

$result = $stmt->execute();

if(!$result) {
    fail("Please provide valid values.");
} else {
    header("Location: show.php");
}