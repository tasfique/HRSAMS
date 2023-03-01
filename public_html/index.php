<?php
	session_start();
	session_unset();
	session_destroy();

?>

<!DOCTYPE html>
<html>

	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Bootstrap 4 links import -->
	    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	    
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	    <!-- Local CSS -->
	    <link rel="stylesheet" type="text/css" href="css/loginStyle.css">

		<title>HR's Application Management System</title>
		<link rel="icon" type="image/png" href="assets/hr.png">
		<link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
		<link rel="shortcut icon" href="assets/favicon.ico">
	    <style>

	        
	    </style>
	</head>
    <body>
        <nav class="navbar navbar-light" style="background-color: #fff7eb;">
         
            <div class="navbar-header">
              <a class="navbar-brand" href="#">
                <img src="assets/hr.png"  class="d-inline-block align-top" alt="" loading="lazy">
                <span class="nav-full-text">Application Management System (AMS)</span>
                <span class="nav-short-text">AMS</span>
              </a>
            </div>
        </nav>

        <div class="login-form" style="background-color:white; margin: 0 auto; margin-top: 2em; border-radius: 30px;">
        	<!-- When a user enters input and submits the inputs, it leads to the loginAction.php using action attribute.  -->
            <form method="post" autocomplete="off" action="loginAction.php"> 
                <div class="form-group" style="margin: 0 auto; width:60%; height:50%;  background-color:white; ">
                    <br /><br />
                    <h2 style="text-align:center;">
                        <img src="assets/hr2.png" style="height: 100%;width: 100%;"></h2><br />
                    
                    <div class="form-group">
						<label for="userType" style="font-size:18px;">User Type:</label>
	                    <div class="dropdown">
							<select id="userType" name="userType" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								<option value="Admin">Admin</option>
							  	<option value="Assessment Staff">Assessment Staff</option>
							    <option value="Manager">Manager</option>
							    <option value="Visa Advisor">Visa Advisor</option>
							</select>
							<small id="emailHelp" class="form-text text-muted">Select the User Type.</small>
						</div>
					</div>

					<div class="form-group">
						<label for="affiliateCode" style="font-size:18px;">Affiliate Code:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" name="affiliateCode" id="affiliateCode" aria-describedby="usernamHelp" placeholder="Enter Affiliate Code">
						<small id="emailHelp" class="form-text text-muted">Must enter Affiliate Code if you have one.</small>
					</div>

					<div class="form-group">
						<label for="username" style="font-size:18px;">Username:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" name="username" id="username" aria-describedby="usernamHelp" placeholder="Enter Username" required="">
						<small id="emailHelp" class="form-text text-muted">Enter username given by admin.</small>
					</div>

					<div class="form-group">
						<label for="password" style="font-size:18px;">Password:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="password" class="form-control" name="password" id="password" aria-describedby="usernamHelp" placeholder="Enter Password" required="">
						<small id="emailHelp" class="form-text text-muted">Enter password given by admin.</small>
					</div>
					<br><br>
                    <p style="text-align:center;">
                    <input name="login" type="submit" value="LOGIN" class="btn btn-danger" style=" border-radius: 10px; width:100%; height:50px; font-size:20px;">
                    
                    </p>
		  
                </div>
            </form>
            <br>
        </div>
	
	    
        <br><br>
    </body>
</html>
