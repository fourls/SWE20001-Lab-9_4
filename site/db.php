<?php
$db_options = parse_url("mysql://b754661bf9eae6:896c534b@eu-cdbr-west-01.cleardb.com/heroku_3f122bdc916a0ad?reconnect=true");

$conn = mysqli_connect(
    $db_options["eu-cdbr-west-01.cleardb.com/heroku_3f122bdc916a0ad"],
    $db_options[" b754661bf9eae6r"],
    $db_options["896c534b"],
    substr($db_options["heroku_3f122bdc916a0ad"],1)
);