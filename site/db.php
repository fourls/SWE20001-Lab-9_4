<?php
$db_options = parse_url(getenv("DATABASE_URL"));

$conn = mysqli_connect(
    $db_options["host"],
    $db_options["user"],
    $db_options["pass"],
    substr($db_options["path"],1)
);