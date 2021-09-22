<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <meta name="description" content="Sprint 1" />
 <meta name="keywords" content="PHP" />
 <title>Job Vacancy</title>
</head>
<body>
<h1>Addform.php</h1>
<form action = "Addprocess.php" method = "post" >
	<fieldset>
		<legend>Details</legend>
			<p><label for="posID">Position ID: </label> 
				<input type="text" id="posID" name= "posID" placeholder="P0001" required="required"/>
			</p>
			<p><label for="title">Title: </label> 
				<input type="text" id="title" name= "title" required="required"/>
			</p>
			<p><label class="desc">Description: </label></p>  
				<textarea class="desc" name="desc" rows="5" cols="25" required="required"></textarea>
						
			<p><label for="date">Closing Date: </label> 
				<input type="text" id="date" name= "date" required="required" value="<?php echo date('d/m/y');?>"/>
			</p>

			<p><label>Position: </label></p>
			<p><label for="pos">					
				<input type="radio" id="ftime" name="pos" value="Full Time" /> Full Time
				</label><br>
			<label for="pos">
				<input type="radio" id="ptime" name="pos" value="Part Time" /> Part Time
				</label>
			</p>

			<p><label>Contract: </label></p>
			
			<p>
			<label for="contract">					
			<input type="radio" id="contract1" name="contract" value="On-going" /> On-going</label><br>
			<label for="contract">
			<input type="radio" id="contract2" name="contract" value="Fixed Term" /> Fixed Term</label>
			</p>

			<p><label class="jobApp">Application by: </label></p>
			<p>
				<label><input type="checkbox" name="jobApp" value="Post" />Post</label><br>
				<label><input type="checkbox" name="jobApp" value="Mail" />Mail</label>
			</p>

			<p><label for="loc">Location: </label>
				<select id="loc" name="loc" >
				<option value="" selected="selected">---</option>
					<option value="ACT" id="act">ACT</option>
					<option value="NSW" id="nsw">NSW</option>
					<option value="NT" id="nt">NT</option>
					<option value="QLD" id="qld">QLD</option>
					<option value="SA" id="sa">SA</option>
					<option value="TAS" id="tas">TAS</option>
					<option value="VIC" id="vic">VIC</option>
					<option value="WA" id="wa">WA</option>
				</select>
			</p>
</fieldset>

<input type = "submit" name = "posted" value = "Post">
<input type = "reset" value = "Reset">
<br>
<br>
<?php
echo "<a href='index.php'>Return Home</a>";
?>

</form>
</body>
</html>