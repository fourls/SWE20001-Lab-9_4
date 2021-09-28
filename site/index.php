<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta name="description" content="Managing Software projects" />
    <meta name="keywords" content="HTML, CSS" />
    <meta name="author" content="lab 9/ Group 4" />
    <title>People Health Pharmacy</title>
</head>
<body>
    <p> 
        <h2>People Health Pharmacy</p2>
        <p>
           Welcome to People Health Pharmacy, this is a local small Pharmacy in Hawthorn. We offer various medicine, health care products and accessories.
           This pharmacy is currectly really popular in Melbourne as it has ranked number one in leading pharmacies.
        </p>
        <p>This website is an online shopping website that will require you to select products you want to purchase and enter your details so we can send them to you</p>


        <br/>
        Jack.
        <?php echo "Hello from PHP ".phpversion()."!"; ?>
        <br/>
        <?php
include_once("db.php");

if($conn) {
    echo "Database connected!";
} else {
    echo "Database couldn't connect.";
}
        ?>
    </p>
 

</body>
</html>

<!--Just a placeholder to start using GitHub for our #sprint task, 
This index will be a front page to explain our goals/tasks. And also direct users to different pages (e.g Add data, read data, export data etc). -->