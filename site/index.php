<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'commits/header.inc'; ?>  <!-- use these in each page to make it easier to have consistency across pages --> 
</head>
<body>
    <?php include 'commits/menu.inc';?>
    <p>
        <?php echo "Hello from PHP ".phpversion()."!"; ?>
        <br/>
    </p>
<?php
    include_once("db.php");

    if($conn) {
       echo "Database connected!";
    } else {
        echo "Database couldn't connect .";
    }
?>
<p><a href='addform.php'>Add</a></p>

<?php include 'commits/footer';?>
</body>
</html>

<!-- Just a placeholder to start using GitHub for our #sprint task,
This index will be a front page to explain our goals/tasks. And also direct users to different pages (e.g Add data, read data, export data etc). -->
