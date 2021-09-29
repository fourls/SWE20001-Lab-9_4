<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta name="description" content="Managing Software projects" />
    <meta name="keywords" content="HTML, CSS" />
    <meta name="author" content="lab 9/ Group 4" />
    <title>People Health Pharmacy</title>
    <link href="Styles/Style.css" rel="stylesheet" />
    <a href="edit.php">Go to TopicA</a> 

</head>
<style>
table, th, td {
  border:1px solid black;
}
.main-nav
{
    float:right;
    list-style:none;
    margin-top: -40px;
}
.main-nav li
{
    display:inline-block;
}
.main-nav li a
{
    color:black;
    text-decoration: none;
    padding: 5px 20px;
    font-family:"Roboto",sans-serif;
    font-size:15px;
}
.main-nav li.active a
{
    border:1px solid black;
}

</style>

<body>
<div>
            <ul class="main-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="addform.php">Add product</a></li>
                <li><a href="edit.php">Edit record</a></li>
                <li><a href="show.php">Show product</a></li>
            </ul>
        </div>

    <p> 
        <h2>People Health Pharmacy</p2>
        <p>
           Welcome to People Health Pharmacy, this is a local small Pharmacy in Hawthorn. We offer various medicine, health care products and accessories.
           This pharmacy is currectly really popular in Melbourne as it has ranked number one in leading pharmacies.
        </p>
        <p>This website is an online shopping website that will require you to select products you want to purchase and enter your details so we can send them to you</p>
        
        <p>There will also be some functionally that will read in data from csv files and that will produce visual graphs and charts that will predict the weekly and month sales 
            and it will produce a set of reports that will highlight several meterics of concern.
        </p>

    <p>Some of these metics of concern for last week and last month:</p>
    <ul>
     <li>Sales</li>
     <li>Pre-product category sales</li>
     <li>Pre-product sales</li>
    </ul>  

    <p>Also predictive sales will be provided for next week and next month will be supplied.
       These predictive sales will include:
    </p>
    <ul>
     <li>Products</li>
     <li>Products categories</li>
    </ul>  

    <p>So in summary, this website will allow customers to fill in their details to purchase their products.
       The staff members for People Health Pharmacy will also find the website useful as it will analyse 
       customer's sales, Pre-product category sales and Pre-product sales using graphs and charts to visualise the 
   </p>






<table style="width:100%">
<p>This website is made up of developers that will be using the scrum methodology, these team members are:</p>

  <tr>
    <th>Developer</th>
    <th>Roles</th>
  </tr>
  <tr>
    <td>Jack Fuhrer</td>
    <td>Scrum master & Software developer (PHP & mySQL databasing)</td>
  </tr>
  <tr>
    <td>Elliot Hillary</td>
    <td>Scrum team member & Software Developer</td>
  </tr>

  <tr>
    <td>Ryan Donald</td>
    <td>Scrum team member & Software Developer</td>
 </tr>
 <tr>
    <td>Lachlan Ho</td>
    <td>Scrum team member & Tester</td>
 </tr>
 <tr>
    <td>Atul Sharma</td>
    <td>Scrum team member & Software Developer</td>
 </tr>
</table>
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
