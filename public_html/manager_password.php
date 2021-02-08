<?php
	session_start();
	if (!isset($_SESSION['username']) || empty($_SESSION['affiliateCode']) || $_SESSION['userType'] != "Manager") {
		header("location:index.php?action=login");
	}

?>

<!DOCTYPE html>
<html>

	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Bootstrap 4 links import -->
	    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

	    <script>
						function validatePassword() {
						var newPassword,confirmPassword,output = true;

						newPassword = document.frmChange.newPassword;
						confirmPassword = document.frmChange.confirmPassword;

						if(!newPassword.value) {
						newPassword.focus();
						document.getElementById("newPassword").innerHTML = "required";
						output = false;
						}
						else if(!confirmPassword.value) {
						confirmPassword.focus();
						document.getElementById("confirmPassword").innerHTML = "required";
						output = false;
						}
						if(newPassword.value != confirmPassword.value) {
						newPassword.value="";
						confirmPassword.value="";
						newPassword.focus();
						document.getElementById("confirmPassword").innerHTML = "not same";
						output = false;
						} 	
						return output;
						}
					</script>


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
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #fff7eb;">
		<a class="navbar-brand" href="#">
			<img src="assets/hr.png"  class="d-inline-block align-top" alt="" loading="lazy">
			<span class="nav-full-text">Application Management System (AMS)</span>
			<span class="nav-short-text">AMS</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="nav navbar-nav ml-auto">
		      	<li class="nav-item active" name="navButtons" title="Add Applicant" onclick="location.href = 'manager_page.php';">
			      	<a style="margin: 10px;" class="btn btn-success" href="#"><img class="navbar-link" src="assets/application-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
			      	<span class="nav-short-text">New Application</span>
			        <!-- <a class="nav-link" href="#">New Application<span class="sr-only">(current)</span></a> -->
		    	</li>
		      	<li class="nav-item" onclick="location.href = 'manager_view.php';" name="navButtons" title="View Table">
		      		<a style="margin: 10px;" class="btn btn-primary" href="#"><img class="navbar-link" src="assets/table-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">View Table</span>
		        	<!-- <a class="nav-link" href="#">Table</a> -->
		      	</li>
		      	<li class="nav-item" name="navButtons" title="Change Password">
		      		<a style="margin: 10px;" class="btn btn-warning" href="#"><img class="navbar-link" src="assets/password-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">Change Password</span>
		        	<!-- <a class="nav-link" href="#">Logout</a> -->
		      	</li>
		      	<li class="nav-item" onclick="location.href = 'logoutAction.php';" name="navButtons" title="Logout">
		      		<a style="margin: 10px;" class="btn btn-danger" href="#"><img class="navbar-link" src="assets/logout-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">Logout</span>
		        	<!-- <a class="nav-link" href="#">Logout</a> -->
		      	</li>
		    </ul>
		</div>
	</nav>
	<?php
        echo '<p style="color:white;">Hi, '.$_SESSION["username"].'</p>';
        echo '<p style="color:white;">Affiliate Code: '.$_SESSION["affiliateCode"].'</p>';
    ?>

        <div class="login-form" style="background-color:white; margin: 0 auto; margin-top: 2em; border-radius: 30px;">
        	<!-- When a user enters input and submits the inputs, it leads to the loginAction.php using action attribute.  -->
            <form name="frmChange" method="post" autocomplete="off" onSubmit="return validatePassword()" action="passwordAction.php"> 
                <div class="form-group" style="margin: 0 auto; width:60%; height:50%;  background-color:white; ">
                    <br />
                    <h2 style="text-align: center; font-style: oblique;">Change Password</h2>
                    <br /><br />

					<div class="form-group">
						<label for="username" style="font-size:18px;">Username:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" name="username" id="username" aria-describedby="usernamHelp" placeholder="Enter Username">
						<small id="emailHelp" class="form-text text-muted">Enter username used for registration.</small>
					</div>

					<div class="form-group">
						<label for="password" style="font-size:18px;">New Password:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="password" class="form-control" name="newPassword" id="newPassword" aria-describedby="usernamHelp" placeholder="Enter Password">
						<small id="emailHelp" class="form-text text-muted">Enter your new password.</small>
					</div>

					<div class="form-group">
						<label for="password" style="font-size:18px;">Confirm New Password:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="password" class="form-control" name="confirmPassword" id="confirmPassword" aria-describedby="usernamHelp" placeholder="Enter Password">
						<small id="emailHelp" class="form-text text-muted">Confirm your new password.</small>
					</div>
					<br><br>
                    <p style="text-align:center;">
                    <input name="passwordChangeManager" type="submit" value="UPDATE" class="btn btn-danger" style=" border-radius: 10px; width:100%; height:50px; font-size:20px;">
                    
                    </p>


                    
                </div>
            </form>
            <br>
        </div>
        
        
        <div class="modal fade" id="successModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 class="modal-title">Message</h4>
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	          <p>Password Changed!</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" onclick= "relocate_home()" data-dismiss="modal">Go Back</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>

	  <div class="modal fade" id="errorModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	        	<h4 class="modal-title">Message</h4>
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	          <p>Failed to Change.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" onclick=" relocate_home()" data-dismiss="modal">Go Back</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
	  
	  
        <br><br>
    </body>
</html>