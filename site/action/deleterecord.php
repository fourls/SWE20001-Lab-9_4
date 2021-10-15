<?php


require("../db.php");

function fail($msg) {
    echo "<a href=\"../add.php\">".$msg."</a>";
    die();
}

if(!isset($_POST["sale_id"]))
    fail("Please provide a sale ID.");


$stmt = $conn->prepare("DELETE FROM sales_record WHERE sale_id = ?");
$stmt->bind_param("i", $_POST["sale_id"]);

$result = $stmt->execute();

if(!$result) {
    fail("Delete failed - please provide valid values.");
} else {
    header("Location: ../show.php");
}