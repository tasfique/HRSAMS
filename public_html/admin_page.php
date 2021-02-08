<?php
	session_start();
	if (!isset($_SESSION['username']) || empty($_SESSION['affiliateCode']) || $_SESSION['userType'] != "Admin") {
		header("location:index.php");
	}
?>

<!-- Used for importing the country lists. -->
<?php include 'scripts/countries.php';
?>
<!DOCTYPE html>
<html>

	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- Bootstrap 4 links import -->
	    <!-- CSS -->
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
	   
	    <!-- Used for dropdown upload -->
	   
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.min.css" integrity="sha512-wHTuOcR1pyFeyXVkwg3fhfK46QulKXkLq1kxcEEpjnAPv63B/R49bBqkJHLvoGFq6lvAEKlln2rE1JfIPeQ+iw==" crossorigin="anonymous" />


	    <!-- New code for drop down -->

	    <!-- Used for Date picking in the UI -->
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" />

	    <!-- Local CSS -->
	    <link rel="stylesheet" type="text/css" href="css/mystyle2.css">

		<title>Admin Add</title>
		<link rel="icon" type="image/png" href="assets/hr.png">
		<link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
		<link rel="shortcut icon" href="assets/favicon.ico">

		<!-- Style for local CSS -->
		<!-- Used for select colours in text boxes -->
	    <style>

			textarea:focus,
			input[type="text"]:focus,
			input[type="password"]:focus,
			input[type="datetime"]:focus,
			input[type="datetime-local"]:focus,
			input[type="date"]:focus,
			input[type="month"]:focus,
			input[type="time"]:focus,
			input[type="week"]:focus,
			input[type="number"]:focus,
			input[type="email"]:focus,
			input[type="url"]:focus,
			input[type="search"]:focus,
			input[type="tel"]:focus,
			input[type="color"]:focus,
			input[id="datePicker"]:focus,
			button[type="button"]:focus,
			textarea[type="text"]:focus,
			select[class="form-control"]:focus,
			select[id="nationality"]:focus,
			select[form="user-type"]:focus,
			.uneditable-input:focus {   
			  border-color: #fcb141 !important;
			  box-shadow: 0 1px 1px #740f12 inset, 0 0 8px #740f12 !important;
			  outline: 0 none !important;

			}

			/*For Drop Down Button check box to make the text wrap up*/
			.btn-outline {
			    background-color: transparent;
			    color: inherit;
			    transition: all .5s;
			}

			.btn-wrap-text {
			    overflow: hidden;
			  white-space: nowrap;
			  display: inline-block;
			  text-overflow: ellipsis;
			}
	       
	    </style>

	    <!-- Printing settings. -->
	    <style type="text/css"  media="print">
	    	#fileUpload {
	    		display: none;
	    	}
	    	
	    	#fileUploadTwo {
	    		display: none;
	    	}

	    	#button {
	    		display: none;
	    	}

	    	#imageText {
	    		display: none;
	    	}

	    	#title {
	    		display: none;
	    	}

	    	#emailHelp {
	    		display: none;
	    	}
	    	
	    	input,
	    	select,
	    	button,
            textarea {
                border: none !important;
                box-shadow: none !important;
                outline: none !important;
              }
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
		      	<li class="nav-item active" onclick="location.href = 'admin_page.php';" name="navButtons" title="Add Applicant">
			      	<a style="margin: 10px;" class="btn btn-success" href="#"><img class="navbar-link" src="assets/application-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
			      	<span class="nav-short-text">New Application</span>	        
		    	</li>
		      	<li class="nav-item" onclick="location.href = 'admin_view.php';" name="navButtons" title="View Table">
		      		<a style="margin: 10px;" class="btn btn-primary" href="#"><img class="navbar-link" src="assets/table-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">View Table</span>
		      	</li>
		      	<li class="nav-item" onclick="window.print()" name="navButtons" title="Print">
		      		<a style="margin: 10px;" class="btn btn-secondary" href="#"><img class="navbar-link" src="assets/print-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">Print</span>
		      	</li>
		      	<li class="nav-item" name="navButtons" title="Add Users" onclick="location.href = 'admin_addUser.php';">
		      		<a style="margin: 10px;" class="btn btn-dark" href="#"><img class="navbar-link" src="assets/user-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">Add User</span>
		      	</li>
		      	<li class="nav-item" name="navButtons" title="Change Password" onclick="location.href = 'admin_password.php';">
		      		<a style="margin: 10px;" class="btn btn-warning" href="#"><img class="navbar-link" src="assets/password-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">Change Password</span>
		      	</li>
		      	<li class="nav-item" onclick="location.href = 'logoutAction.php';" name="navButtons" title="Logout">
		      		<a style="margin: 10px;" class="btn btn-danger" href="#"><img class="navbar-link" src="assets/logout-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">Logout</span>
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
            <form name="myform" method="post" autocomplete="off" enctype="multipart/form-data" action="admin_submitAction.php"> 
                <div class="form-group" style="margin: 0 auto; width:75%; height:50%;  background-color:white; ">
                    <br /><br />
                    <h2 id="title" style="text-align:center; font-style: oblique;">New Applicant</h2><br>
				 
				    <div class="row py-4">
				        <div class="col-lg-6 mx-auto">
				            
				            <!-- Upload image input-->
				            <div id="fileUpload" class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
				                <input id="upload" name="image" type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control border-0">
				                <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose Image</label>
				                <div class="input-group-append">
				                    <label style="border-radius: 10px; border-width: 2px; border-color: #fcb141" for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose Image</small></label>
				                </div>
				            </div>

				            <!-- Uploaded image area-->
				            <p id="imageText" style="text-align: center;">The image will be loaded below.</p>
				            <div class="image-area mt-4">
				            	<img id="imageResult" style="height: 200px; width: 200px;" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
				            </div>

				            <!--File Upload-->
				            <br><br>
				            <div id="fileUploadTwo">
    				            <label>Select a ZIP or RAR File</label>
    				            <div class="custom-file">
                                    <input name="file" type="file" class="custom-file-input" id="customFile" accept=".zip,.rar,.7zip">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>

				        </div>
				    </div>

	            	<br>


                    <div class="row">
	                    <div class="col-lg-4 form-group">
							<label style="text-align: center;" for="ID" style="font-size:18px;">Applicant ID:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141;" type="text" class="form-control" id="ID" placeholder="Auto ID" readonly="">
						</div>

						<div class="col-lg-4 form-group">
			                    <label for="datePicker" style="font-size:18px;">Date of Application (Auto):</label>
			                    <input id="datePicker" name="DOA" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" placeholder="Input not needed." class="form-control" readonly="">
			                    <!-- Script used for auto date, as it doesn't require user input -->
							    <!-- <script>
							       
							        var date = new Date();
									var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
									var optComponent = {
									  
									  container: '#datePicker',
									  orientation: 'auto top',
									  todayHighlight: true,
									  autoclose: true
									};
									// COMPONENT
									$('#datePicker').datepicker(optComponent);
									$('#datePicker').datepicker('setDate', today);
							        
							    </script> -->
					    </div>

						<div class="col-lg-4 form-group">
							<label for="passportNo" style="font-size:18px;">Passport No / IC:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="passportNo" name="passportNumber" placeholder="example, K3639262" required>
							<small id="emailHelp" class="form-text text-muted">Can only be edited by Admin/Manager</small> 
						</div>

					</div>

					<div class="row">
						<div class="col-lg-6 form-group">
							<label for="fName" style="font-size:18px;">First Name:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="fName" name="firstName" placeholder="Enter First Name" required>
						</div>

						<div class="col-lg-6 form-group">
							<label for="lName" style="font-size:18px;">Last Name:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="lName" name="lastName" placeholder="Enter Last Name" required>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-3 form-group">
						    <label for="genderType" style="font-size:18px;">Gender:</label>
		                    <div class="dropdown">
								<select name="selectGenderType" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								  	<option value="M">Male 👨</option>
									<option value="F">Female 👩</option>
								    <option value="O">Others</option>
								</select>
							</div>
						</div>

						<div class="col-lg-3 form-group">
		                    <label for="DOB" style="font-size:18px;">DOB:</label>
		                    <input id="DOB" name="DOB" placeholder="MM/DD/YYYY" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" />
						    <!-- <script>
						        $('#DOB').datepicker({
						            uiLibrary: 'bootstrap4'
						        });
						        $('#DOB').datepicker({
					                format: "mm/dd/yyyy"
					            });
						    </script> -->
					    </div>

					    <div class="col-lg-3 form-group">
							<label for="nationalityType" style="font-size:18px;">Nationality:</label>
		                    <div class="dropdown">							
								<select name="nationality" class="form-control" id="nationality" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								<?php foreach($countries as $key => $country) { ?>
									<option value="<?php echo $country; ?>"><?php echo $country; ?>

								   	</option>
								   <?php } ?>
								</select> 
							</div>

						</div>

						<div class="col-lg-3 form-group">
							<label for="applicationDocs" style="font-size:18px;">Language(s) Skills:</label>

							<div class="dropdown show">
								
								<button id="droppy" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="button" class="form-control btn-outline btn-wrap-text" data-toggle="dropdown">Multiple Selection ▼</button>
								<ul class="dropdown-menu checkbox-menu allow-focus" id="dropdown_languages">

									<li><a style="color: black;" href="#" class="large" data-value="Chinese" tabIndex="-1">
										<input  name="languages[]" value="Chinese" type="checkbox"/>&nbsp;Chinese</a>
									</li>

									<li><a style="color: black;" href="#" class="large" data-value="English" tabIndex="-1">
										<input  name="languages[]" value="English" type="checkbox"/>&nbsp;English</a>
									</li>

									<li><a style="color: black;" href="#" class="large" data-value="French" tabIndex="-1">
										<input  name="languages[]" value="French" type="checkbox"/>&nbsp;French</a>
									</li>

									<li><a style="color: black;" href="#" class="large" data-value="German" tabIndex="-1">
										<input  name="languages[]" value="German" type="checkbox"/>&nbsp;German</a>
									</li>

									<li><a style="color: black;" href="#" class="large" data-value="Italian" tabIndex="-1">
										<input  name="languages[]" value="Italian" type="checkbox"/>&nbsp;Italian</a>
									</li>

									<li><a style="color: black;" href="#" class="large" data-value="Malay" tabIndex="-1">
										<input  name="languages[]" value="Malay" type="checkbox"/>&nbsp;Malay</a>
									</li>

									<li><a style="color: black;" href="#" class="large" data-value="Spanish" tabIndex="-1">
										<input  name="languages[]" value="Spanish" type="checkbox"/>&nbsp;Spanish</a>
									</li>

								</ul>
										
							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-lg-4 form-group">
							<label for="positionCategory" style="font-size:18px;">Position category:</label>
		                    <div class="dropdown">
								<select name="positionCategory" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								  	<option>None</option>
									<option>Internship</option>
								    <option>Job</option>
								    <option>Program</option>
								    <option>Migration</option>
								    <option>General Visa</option>
								</select>
							</div>
						</div>
						
						<div class="col-lg-8 form-group">
							<label for="positionTitle" style="font-size:18px;">Position Title:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="positionTitle" name="positionTitle" placeholder="Title of the Position Applying">
						</div>

					</div>

					<div class="row">
						<div class="col-lg-4 form-group">
							<label for="paymentID" style="font-size:18px;">Payment ID:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="paymentID" name="paymentID" placeholder="Enter ID from the payment">
						</div>

						<div class="col-lg-4 form-group">
			                    <label for="DOS" style="font-size:18px;">Date of Submission:</label>
			                    <input id="DOS" name="DOS" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" placeholder="Document submission date.">
							    <!-- <script>
							        $('#DOS').datepicker({
							            uiLibrary: 'bootstrap4'
							        });
							    </script> -->
					    </div>

					    <div class="col-lg-4 form-group">
							<label for="customerType" style="font-size:18px;">Customer Type:</label>
		                    <div class="dropdown">
								<select name="customerType" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								  	<option value="Normal">Normal</option>
									<option value="Paid">Paid 💲</option>
								</select>
							</div>
						</div>

				    </div>

					<div class="row">
						<div class="col-lg-4 form-group">
								<label for="phoneNumber" style="font-size:18px;">Phone Number:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="+601234567890 (Include Country Code)">
						</div>

						<div class="col-lg-8 form-group">
							<label for="email" style="font-size:18px;">E-Mail Address:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
						</div>
					</div>

					<div class="form-group">
						<label for="currentAddress" style="font-size:18px;">Current Address:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="currentAddress" name="currentAddress" placeholder="Building, Street, and etc...">
					</div>

					<div class="row">
						<div class="col-lg-3 form-group">
								<label for="cPostalCode" style="font-size:18px;">Postal Code:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="postalCodeC" name="postalCodeC" placeholder="47500 (Current)">
						</div>

						<div class="col-lg-3 form-group">
								<label for="areaC" style="font-size:18px;">Area:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="areaC" name="areaC" placeholder="Subang Jaya (Current)">
						</div>

						<div class="col-lg-3 form-group">
								<label for="stateC" style="font-size:18px;">State:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="stateC" name="stateC" placeholder="Selangor (Current)">
						</div>


						<div class="col-lg-3 form-group">
							<label for="currentCountry" style="font-size:18px;">Country:</label>
		                    <div class="dropdown">
								<select name="currentCountry" class="form-control" id="currentCountry" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
									
									<?php foreach($countries as $key => $country) { ?>
									<option value="<?php echo $country; ?>"><?php echo $country; ?>
									
								   	</option>
								   <?php } ?>
										
								</select>
							</div>
						</div>

					</div>

					<div class="form-group">
						<label for="permanentAddress" style="font-size:18px;">Permanent Address:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="permanentAddress" name="permanentAddress" placeholder="Building, Street, and etc...">
					</div>

					<div class="row">
						<div class="col-lg-3 form-group">
								<label for="postalCodeP" style="font-size:18px;">Postal Code:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="postalCodeP" name="postalCodeP" placeholder="47500 (Permanent)">
						</div>

						<div class="col-lg-3 form-group">
								<label for="areaP" style="font-size:18px;">Area:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="areaP" name="areaP" placeholder="Subang Jaya (Permanent)">
						</div>

						<div class="col-lg-3 form-group">
								<label for="stateP" style="font-size:18px;">State:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="stateP" name="stateP" placeholder="Selangor (Permanent)">
						</div>


						<div class="col-lg-3 form-group">
							<label for="permanentCountry" style="font-size:18px;">Country:</label>
		                    <div class="dropdown">
								<select name="permanentCountry" class="form-control" id="permanentCountry" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
									
									<?php foreach($countries as $key => $country) { ?>
									<option value="<?php echo $country; ?>"><?php echo $country; ?>
									
								   	</option>
								   <?php } ?>

								</select>
							</div>
						</div>

						
					</div>

					<!-- <div class="row">
						
						here
						
						
					</div> -->


					<div class="row">
						<div class="col-lg-3 form-group">
							<label for="applicationStatus" style="font-size:18px;">Application Status:</label>
		                    <div class="dropdown">
								<select id="applicationStatus" name="applicationStatus" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
									<option value="NONE">None</option>
								  	<option value="KIV">KIV (Keep In View)</option>
									<option value="ACCEPTED">Accepted ✔</option>
								    <option value="REJECTED">Rejected ❌</option>
								</select>
							</div>
						</div>

						<div class="col-lg-3 form-group">
							<label for="applicationStatus" style="font-size:18px;">Visa Status:</label>
		                    <div class="dropdown">
								<select id="visaStatus" name="visaStatus" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
									<option value="NONE">None</option>
								  	<option value="PENDING DOCS">Pending Docs</option>
									<option value="SUBMITTED">Submitted</option>
									<option value="PENDING PAYMENT">Pending Payment</option>
								    <option value="PENDING VISA">Pending Visa</option>
								    <option value="VISA APPROVED">Visa Approved ✔</option>
								    <option value="VISA REJECTED">Visa Rejected ❌</option>
								</select>
							</div>
						</div>

						<div class="col-lg-3 form-group">
							<label for="applicationDocs" style="font-size:18px;">Missing Documents:</label>

							<div class="dropdown show">
											<button id="droppy2" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="button" class="form-control btn-outline btn-wrap-text" data-toggle="dropdown">Multiple Selection ▼</button>
											<ul class="dropdown-menu checkbox-menu allow-focus" id="dropdown_missingDoc">

											<li><a style="color: black;" href="#" class="large" data-value="Academic Transcript" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Academic Transcript" type="checkbox"/>&nbsp;Academic Transcript</a></li>

											<li><a style="color: black;" href="#" class="large" data-value="Highest Education Certificate" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Highest Education Certificate" type="checkbox"/>&nbsp;Highest Education Certificate</a></li>

											<li><a style="color: black;" href="#" data-value="Internship Letter" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Internship Letter" type="checkbox"/>&nbsp;Internship Letter</a></li>

											<li><a style="color: black;" href="#" class="large" data-value="Passport Copy" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Passport Copy" type="checkbox"/>&nbsp;Passport Copy</a></li>

											<li><a style="color: black;" href="#" class="large" data-value="Updated Resume" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Updated Resume" type="checkbox"/>&nbsp;Updated Resume</a></li>
											
											<li><a style="color: black;" href="#" class="large" data-value="Visa Copy" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Visa Copy" type="checkbox"/>&nbsp;Visa Copy</a></li>
											  
											<li><a style="color: black;" href="#" class="large" data-value="Others" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Others" type="checkbox"/>&nbsp;Others</a></li>

											</ul>
							</div>

						</div>

						<div class="col-lg-3 form-group">
							<label for="Others" style="font-size:18px;">‎‎‎‏‏‎ ‎</label>
							<input name="missingDocumentsListOthers" id="missingDocumentsListOthers" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" placeholder="Enter Others" >	
						</div>

						
					</div>

					<div class="row">

						<div class="col-lg-3 form-group">
			                    <label for="DOE" style="font-size:18px;">Date of Enrolment:</label>
			                    <input id="DOE" name="DOE" placeholder="MM/DD/YYYY" class="form-control" data-date-end-date="0d" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" />
							    <!-- <script>
							        $('#DOE').datepicker({
							            uiLibrary: 'bootstrap4'
							        });
							        
							    </script> -->
					    </div>

					    <div class="col-lg-3 form-group">
			                    <label for="DOG" style="font-size:18px;">Date of Graduation:</label>
			                    <input id="DOG" name="DOG" placeholder="MM/DD/YYYY" class="form-control" data-date-end-date="0d" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" />
							    <!-- <script>
							    	$('#DOG').datepicker({
							            uiLibrary: 'bootstrap4'
							        });
			
							    </script> -->
					    </div>

					    <div class="col-lg-3 form-group">
							<label for="educationType" style="font-size:18px;">Education Type:</label>
		                    <div class="dropdown">
								<select name="educationType" id="educationType" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
									<!-- <option value="" selected disabled>Select the Highest</option> -->
								  	<option value="None">None</option>
									<option value="High School">High School</option>
								    <option value="Diploma">Diploma</option>
								    <option value="Bachelor's">Bachelor's</option>
								    <option value="Master's">Masters's</option>
								    <option value="PhD">PhD</option>
								    <option value="Others">Others</option>
								</select>
							</div>

						</div>

						<div class="col-lg-3 form-group" style="display: none;" id="educationOther" name="educationOther">
							<label for="Others" style="font-size:18px;">‎‎‎‏‏‎ ‎</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="educationTypeOthers" name="educationTypeOthers" placeholder="Enter Others" >	
						</div>

					</div>

					<div class="form-group">
							<label for="educationTitle" style="font-size:18px;">Education Title:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="educationTitle" name="educationTitle" placeholder="Highest Qualification">
					</div>

					<div class="form-group">
						<label for="InstituitionName" style="font-size:18px;">Instituition Name:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="instituitionName" name="instituitionName" placeholder="Name of the Institute">
					</div>

					<div class="form-group">
						<!-- <label for="remarks" style="font-size:18px;">Remarks:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141; height: 100px;" type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter any comments (optional)"> -->


						<label for="remarks">Remarks:</label>
    					<textarea style="border-radius: 10px; border-width: 2px; border-color: #fcb141; height: 100px;" class="form-control" type="text" id="remarks" name="remarks" placeholder="Enter any comments (optional)" rows="3">
    						
    					</textarea>
					</div>

					
	                <p id="button" class="col-lg-4 form-group" style="margin: auto;">
	                    <input name="sub" type="submit" value="SUBMIT" class="btn btn-success" id="myBtn" style=" border-radius: 10px; width:100%; height:50px;font-size:20px;">
	                </p>

                    <br> <br>
                </div>
            </form>
        </div>
        <br>

		<!-- Jquery imports. -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- multi select -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js" integrity="sha512-ljeReA8Eplz6P7m1hwWa+XdPmhawNmo9I0/qyZANCCFvZ845anQE+35TuZl9+velym0TKanM2DXVLxSJLLpQWw==" crossorigin="anonymous"></script>

		<!-- Date picker -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

		<!-- Popper JS -->
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" integrity="sha512-ubuT8Z88WxezgSqf3RLuNi5lmjstiJcyezx34yIU2gAHonIi27Na7atqzUZCOoY4CExaoFumzOsFQ2Ch+I/HCw==" crossorigin="anonymous"></script> -->

		<!-- Bootstrap imports. -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

		

		<script type="text/javascript">//<![CDATA[
		/*  ==========================================
		    SHOW UPLOADED IMAGE
		* ========================================== */
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#imageResult')
		                .attr('src', e.target.result);
		        };
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$(function () {
		    $('#upload').on('change', function () {
		        readURL(input);
		    });
		});

		/*  ==========================================
		    SHOW UPLOADED IMAGE NAME
		* ========================================== */
		var input = document.getElementById( 'upload' );
		var infoArea = document.getElementById( 'upload-label' );

		input.addEventListener( 'change', showFileName );
		function showFileName( event ) {
		  var input = event.srcElement;
		  var fileName = input.files[0].name;
		  infoArea.textContent = 'File name: ' + fileName;
		}

		$(document).ready(function () {
	        $('#educationType').change(function () {
	            if ($('#educationType').val() == 'Others') {
	                $('#educationOther').show();
	            }
	            else {
	                $('#educationOther').hide();
	            }
	        });
    	});

		</script>

		

		<!-- For dropdown checkboxes. -->
		<script>

			var date = new Date();
			var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
			var optComponent = {
			  
			  container: '#datePicker',
			  orientation: 'auto top',
			  todayHighlight: true,
			  autoclose: true
			};
			// COMPONENT
			$('#datePicker').datepicker(optComponent);
			$('#datePicker').datepicker('setDate', today);

			 $('#DOB').datepicker({
						            uiLibrary: 'bootstrap4'
						        });
						        $('#DOB').datepicker({
					                format: "mm/dd/yyyy"
					            });

					            
							        $('#DOS').datepicker({
							            uiLibrary: 'bootstrap4'
							        });

							        $('#DOE').datepicker({
							            uiLibrary: 'bootstrap4'
							        });

							        $('#DOG').datepicker({
							            uiLibrary: 'bootstrap4'
							        });
							    

			// tell the embed parent frame the height of the content
			if (window.parent && window.parent.parent){
			  window.parent.parent.postMessage(["resultsFrame", {
			    height: document.body.getBoundingClientRect().height,
			    slug: "zd357psy"
			  }], "*")
			}

			// always overwrite window.name, in case users try to set it manually
			window.name = "result"
			
			// File Upload name will show up with this script
            $(".custom-file-input").on("change", function() {
              var fileName = $(this).val().split("\\").pop();
              $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

        </script>

        <script>
			$("#dropdown_languages input[type=checkbox]").on('change', function() {
	        let multi_text = "";
	          $("#dropdown_languages input[type=checkbox]").each(function() {
	            if ($(this).is(":checked")) {
	              multi_text += $(this).val() + " ";
	            } else {}
	            if (multi_text !== '') {
	              $("#droppy").text(multi_text);
	            } else {
	              $("#droppy").text("Multiple Selection ▼"); 
	            }
	          });
	        });

	        // $("#dropdown_doc1")

	        $("#dropdown_missingDoc input[type=checkbox]").on('change', function() {
	        let multi_text = "";
	          $("#dropdown_missingDoc input[type=checkbox]").each(function() {
	            if ($(this).is(":checked")) {
	              multi_text += $(this).val() + " ";
	            } else {}
	            if (multi_text !== '') {
	              $("#droppy2").text(multi_text);
	            } else {
	              $("#droppy2").text("Multiple Selection ▼"); 
	            }
	          });
	        });

	        $('[data-toggle="tooltip"]').tooltip(); 
			
		</script>
        

    </body>
</html>