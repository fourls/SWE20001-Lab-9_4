<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <p>
        Hey you there! from HTML.
        <br/>
        Jack. K
        <?php echo "Hello from PHP ".phpversion()."!"; ?>
        <br/>
        <?php
include_once("db.php");

if($conn) {
    echo "Database connected!";
} else {
    echo "Database couldn't connect .";
}
        ?>
    </p>
</body>
</html>

<!--Just a placeholder to start using GitHub for our #sprint task,
This index will be a front page to explain our goals/tasks. And also direct users to different pages (e.g Add data, read data, export data etc). -->
