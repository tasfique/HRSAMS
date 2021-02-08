<?php
	session_start();
	if (!isset($_SESSION['username']) || empty($_SESSION['affiliateCode']) || $_SESSION['userType'] != "Assessment Staff") {
		header("location:index.php?action=login");
	}

	include("connection.php");

	// CREATE CONNECTION
	$conn = new mysqli($servername, $username, $password, $dbname);

	// CHECK CONNECTION
	if ($conn->connect_error) {
		echo "Connection Failed";
		die("Connection failed: " . $conn->connect_error);
	} 
	$applicantID = $_GET["applicantID"];
// 	The affiliate user cannot view other users update applicants, if they manually change webaddress.
	$sql = "SELECT * FROM APPLICANTS WHERE applicantID = '$applicantID' AND affiliateCode = '{$_SESSION['affiliateCode']}'";
	

	$r = @mysqli_query($conn, $sql);
	


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
	    

	    <!-- Used for dropdown upload -->
	    
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.min.css" integrity="sha512-wHTuOcR1pyFeyXVkwg3fhfK46QulKXkLq1kxcEEpjnAPv63B/R49bBqkJHLvoGFq6lvAEKlln2rE1JfIPeQ+iw==" crossorigin="anonymous" />
	  
	    <!-- Local CSS -->
	    <link rel="stylesheet" type="text/css" href="css/mystyle2.css">

	    <!-- used for External CSS -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" />

		<title>Assessment Staff Update</title>
		<link rel="icon" type="image/png" href="assets/hr.png">
		<link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
		<link rel="shortcut icon" href="assets/favicon.ico">

		<!-- Style for local CSS -->
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
		      	<li class="nav-item active" name="navButtons" title="Add Applicant" onclick="location.href = 'assessmentAffiliate_page.php';">
			      	<a style="margin: 10px;" class="btn btn-success" href="#"><img class="navbar-link" src="assets/application-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
			      	<span class="nav-short-text">New Application</span>
			        <!-- <a class="nav-link" href="#">New Application<span class="sr-only">(current)</span></a> -->
		    	</li>
		      	<li class="nav-item" name="navButtons" title="View Table" onclick="location.href = 'assessmentAffiliate_view.php';">
		      		<a style="margin: 10px;" class="btn btn-primary" href="#"><img class="navbar-link" src="assets/table-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">View Table</span>
		        	<!-- <a class="nav-link" href="#">Table</a> -->
		      	</li>
		      	<li class="nav-item" onclick="window.print()" name="navButtons" title="Print">
		      		<a style="margin: 10px;" class="btn btn-secondary" href="#"><img class="navbar-link" src="assets/print-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">Print</span>
		        	<!-- <a class="nav-link" href="#">Table</a> -->
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
    <?php
		if($r) {
			
			while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		?>
            <form name="myform" method="post" autocomplete="off" enctype="multipart/form-data" action="assessmentAffiliate_updateAction.php"> 
                <div class="form-group" style="margin: 0 auto; width:75%; height:50%;  background-color:white; ">
                    <br /><br />
                    <h2 id="title" style="text-align:center; font-style: oblique;">Update Applicant</h2>
                    <br>
                    
				 
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

			            	<?php
			            		
							    echo "<div class='image-area mt-4' id='img_div'>";
							    echo "<img src='images/".$row['image']."' img id='imageResult' style='height: 200px; width: 200px;' src='#' alt='' class='img-fluid rounded shadow-sm mx-auto d-block'>";
							    echo "</div>";
							    
							?>

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
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141;" type="text" class="form-control" id="ID" name="applicantID" placeholder="Auto ID" readonly="" value="<?php echo $row['applicantID'];?>">
							<!--  $_GET['applicantID'];?> -->
						</div>

						<div class="col-lg-4 form-group">
			                    <label for="DOA" style="font-size:18px;">Date of Application (Auto):</label>
			                    <input id="DOA" name="DOA" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" placeholder="Input not needed." class="form-control" readonly="" value="<?php echo $row['DOA'];?>">
			                    <!-- Script used for auto date, as it doesn't require user input -->
			                    
					    </div>

						<div class="col-lg-4 form-group">
							<label for="passportNo" style="font-size:18px;">Passport No / IC:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="passportNo" name="passportNumber" placeholder="example, K3639262" value="<?php echo $row['passportNumber'];?>" readonly="">
							<small id="emailHelp" class="form-text text-muted">Can only be edited by Admin/Manager</small>
						</div>

					</div>

					<div class="row">
						<div class="col-lg-6 form-group">
							<label for="fName" style="font-size:18px;">First Name:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="fName" name="firstName" placeholder="Enter First Name" value="<?php echo $row['firstName'];?>" required>
						</div>

						<div class="col-lg-6 form-group">
							<label for="lName" style="font-size:18px;">Last Name:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="lName" name="lastName" placeholder="Enter Last Name" value="<?php echo $row['lastName'];?>" required>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-3 form-group">
						    <label for="genderType" style="font-size:18px;">Gender:</label>
		                    <div class="dropdown">
								<select name="selectGenderType" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								  	<option value="M" <?php if($row['selectGenderType']=="M") echo 'selected="selected"'; ?> 
								  	>Male 👨
								  	</option>
									<option value="F" <?php if($row['selectGenderType']=="F") echo 'selected="selected"'; ?> 
									>Female 👩
									</option>
								    <option value="O" <?php if($row['selectGenderType']=="O") echo 'selected="selected"'; ?> 
								    >Others
								    </option>
								</select>

								

							</div>
						</div>

						<div class="col-lg-3 form-group">
		                    <label for="DOB" style="font-size:18px;">DOB:</label>
		                    <input id="DOB" name="DOB" placeholder="MM/DD/YYYY" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" value="<?php echo $row['DOB'];?>" />
						    
					    </div>

					    <div class="col-lg-3 form-group">
							<label for="nationalityType" style="font-size:18px;">Nationality:</label>
		                    <div class="dropdown">							
								<select name="nationality" class="form-control" id="nationality" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">

									<?php foreach($countries as $key => $country) { ?>
								 		<option value="<?php echo $country; ?>" 
								      		<?php echo ($country == $row['nationality']) ? 'selected' :'' ?>
								      		><?php echo $country; ?>
								   		</option>
								   	<?php } ?>

								</select> 
							</div>
						</div>

						<div class="col-lg-3 form-group">
							<label for="languageSkills" style="font-size:18px;">Language(s) Skills:</label>

							<div class="dropdown show">
								<!-- <div class="row"> -->
									<!-- <div class="col-lg-12"> -->
										<!-- <div class="button-group"> -->
											<button id="droppy" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="button" class="form-control btn-outline btn-wrap-text" data-toggle="dropdown">Multiple Selection ▼</button>
											<ul class="dropdown-menu checkbox-menu allow-focus" id="dropdown_languages">



											  <li><a style="color: black;" href="#" class="large" data-value="Chinese" tabIndex="-1">
											  	<input  name="languages[]" value="Chinese" type="checkbox"
											  	<?php

											  	// if($row['languages']=="Chinese") echo 'checked="checked"';
											  	$str = $row['languages'];
											  	if (strpos($str, 'Chinese') !== false) {
													echo 'checked="checked"';
												}
						
											  	?>
											  	/>&nbsp;Chinese</a>
											  </li>
								
											  <li><a style="color: black;" href="#" class="large" data-value="English" tabIndex="-1">
											  	<input  name="languages[]" value="English" type="checkbox"
											  	<?php 

											  	$str = $row['languages'];
											  	if (strpos($str, 'English') !== false) {
													echo 'checked="checked"';
												} 

											  	?>
											  	/>&nbsp;English</a>
											  </li>

											  <li><a style="color: black;" href="#" class="large" data-value="French" tabIndex="-1">
											  	<input  name="languages[]" value="French" type="checkbox"
											  	<?php 

											  		$str = $row['languages'];
											  		if (strpos($str, 'French') !== false) {
														echo 'checked="checked"';
												}  

											  	?>
											  	/>&nbsp;French</a>
											  </li>

											  <li><a style="color: black;" href="#" class="large" data-value="German" tabIndex="-1">
											  	<input  name="languages[]" value="German" type="checkbox"
											  	<?php 

											  		$str = $row['languages'];
											  		if (strpos($str, 'German') !== false) {
														echo 'checked="checked"';
												}  

											  	?>

											  	/>&nbsp;German</a>
											  </li>

											  <li><a style="color: black;" href="#" class="large" data-value="Italian" tabIndex="-1">
											  	<input  name="languages[]" value="Italian" type="checkbox"

											  	<?php 

											  		$str = $row['languages'];
											  		if (strpos($str, 'Italian') !== false) {
														echo 'checked="checked"';
												}  

											  	?>

											  	/>&nbsp;Italian</a>
											  </li>

											  <li><a style="color: black;" href="#" class="large" data-value="Malay" tabIndex="-1">
											  	<input  name="languages[]" value="Malay" type="checkbox"

											  	<?php 

											  		$str = $row['languages'];
											  		if (strpos($str, 'Malay') !== false) {
														echo 'checked="checked"';
												}  

											  	?>

											  	/>&nbsp;Malay</a>
											  </li>

											  <li><a style="color: black;" href="#" class="large" data-value="Spanish" tabIndex="-1">
											  	<input  name="languages[]" value="Spanish" type="checkbox"

											  	<?php 

											  		$str = $row['languages'];
											  		if (strpos($str, 'Spanish') !== false) {
														echo 'checked="checked"';
												}  

											  	?>

											  	/>&nbsp;Spanish</a>
											  </li>


											</ul>
										<!-- </div> -->
									<!-- </div> -->
								<!-- </div> -->
							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-lg-4 form-group">
							<label for="positionCategory" style="font-size:18px;">Position category:</label>
		                    <div class="dropdown">
								<select name="positionCategory" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								  	<option value="NONE" 
								  	<?php if($row['positionCategory']=="NONE") echo 'selected="selected"'; ?>
								  	>None</option>
									<option value="INTERNSHIP" 
									<?php if($row['positionCategory']=="INTERNSHIP") echo 'selected="selected"'; ?>
									>Internship</option>
								    <option value="JOB" 
								    <?php if($row['positionCategory']=="JOB") echo 'selected="selected"'; ?>
								    >Job</option>
								    <option value="PROGRAM" 
								    <?php if($row['positionCategory']=="PROGRAM") echo 'selected="selected"'; ?>
								    >Program</option>
								    <option value="MIGRATION" 
								    <?php if($row['positionCategory']=="MIGRATION") echo 'selected="selected"'; ?>
								    >Migration</option>
								    <option value="GENERAL VISA" 
								    <?php if($row['positionCategory']=="GENERAL VISA") echo 'selected="selected"'; ?>
								    >General Visa</option>
								</select>
							</div>
						</div>
						
						<div class="col-lg-8 form-group">
							<label for="positionTitle" style="font-size:18px;">Position Title:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="positionTitle" name="positionTitle" placeholder="Title of the Position Applying" value="<?php echo $row['positionTitle'];?>">
						</div>

					</div>

					<div class="row">
						<div class="col-lg-4 form-group">
							<label for="paymentID" style="font-size:18px;">Payment ID:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="paymentID" name="paymentID" placeholder="Enter ID from the payment" value="<?php echo $row['paymentID'];?>">
						</div>

						<div class="col-lg-4 form-group">
			                    <label for="DOS" style="font-size:18px;">Date of Submission:</label>
			                    <input id="DOS" name="DOS" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" placeholder="Document submission date."
			                    value="<?php echo $row['DOS'];?>">
							    
					    </div>

					    <div class="col-lg-4 form-group">
							<label for="customerType" style="font-size:18px;">Customer Type:</label>
		                    <div class="dropdown">
								<select name="customerType" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								  	<option value="Normal" 
								  	<?php if($row['customerType']=="NORMAL") echo 'selected="selected"'; ?>
								  	>Normal</option>
									<option value="Paid" 
									<?php if($row['customerType']=="PAID") echo 'selected="selected"'; ?>
									>Paid 💲</option>
								</select>
							</div>
						</div>

				    </div>

					<div class="row">
						<div class="col-lg-4 form-group">
								<label for="phoneNumber" style="font-size:18px;">Phone Number:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="+601234567890 (Include Country Code)" value="<?php echo $row['phoneNumber'];?>">
						</div>

						<div class="col-lg-8 form-group">
							<label for="email" style="font-size:18px;">E-Mail Address:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" value="<?php echo $row['email'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="currentAddress" style="font-size:18px;">Current Address:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="currentAddress" name="currentAddress" placeholder="Building, Street, and etc..." value="<?php echo $row['currentAddress'];?>">
					</div>

					<div class="row">
						<div class="col-lg-3 form-group">
								<label for="cPostalCode" style="font-size:18px;">Postal Code:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="postalCodeC" name="postalCodeC" placeholder="47500 (Current)" 
								value="<?php echo $row['postalCodeC'];?>">
						</div>

						<div class="col-lg-3 form-group">
								<label for="areaC" style="font-size:18px;">Area:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="areaC" name="areaC" placeholder="Subang Jaya (Current)"
								value="<?php echo $row['areaC'];?>">
						</div>

						<div class="col-lg-3 form-group">
								<label for="stateC" style="font-size:18px;">State:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="stateC" name="stateC" placeholder="Selangor (Current)"
								value="<?php echo $row['stateC'];?>">
						</div>


						<div class="col-lg-3 form-group">
							<label for="currentCountry" style="font-size:18px;">Country:</label>
		                    <div class="dropdown">
								<select name="currentCountry" class="form-control" id="currentCountry" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								  	
									<?php foreach($countries as $key => $country) { ?>
								 		<option value="<?php echo $country; ?>" 
								      		<?php echo ($country == $row['currentCountry']) ? 'selected' :'' ?>
								      		><?php echo $country; ?>
								   		</option>
								   	<?php } ?>

								</select>
							</div>
						</div>

					</div>

					<div class="form-group">
						<label for="permanentAddress" style="font-size:18px;">Permanent Address:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="permanentAddress" name="permanentAddress" placeholder="Building, Street, and etc..."
						value="<?php echo $row['permanentAddress'];?>">
					</div>

					<div class="row">
						<div class="col-lg-3 form-group">
								<label for="postalCodeP" style="font-size:18px;">Postal Code:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="postalCodeP" name="postalCodeP" placeholder="47500 (Permanent)"
								value="<?php echo $row['postalCodeP'];?>">
						</div>

						<div class="col-lg-3 form-group">
								<label for="areaP" style="font-size:18px;">Area:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="areaP" name="areaP" placeholder="Subang Jaya (Permanent)"
								value="<?php echo $row['areaP'];?>">
						</div>

						<div class="col-lg-3 form-group">
								<label for="stateP" style="font-size:18px;">State:</label>
								<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="stateP" name="stateP" placeholder="Selangor (Permanent)"
								value="<?php echo $row['stateP'];?>">
						</div>


						<div class="col-lg-3 form-group">
							<label for="permanentCountry" style="font-size:18px;">Country:</label>
		                    <div class="dropdown">
								<select name="permanentCountry" class="form-control" id="permanentCountry" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
								  	
									<?php foreach($countries as $key => $country) { ?>
								 		<option value="<?php echo $country; ?>" 
								      		<?php echo ($country == $row['permanentCountry']) ? 'selected' :'' ?>
								      		><?php echo $country; ?>
								   		</option>
								   	<?php } ?>
								  	
								</select>
							</div>
						</div>

						
					</div>

					<div class="row">
						<div class="col-lg-3 form-group">
							<label for="applicationStatus" style="font-size:18px;">Application Status:</label>
		                    <div class="dropdown">
								<select id="applicationStatus" name="applicationStatus" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
									<option value="NONE" 
									<?php if($row['applicationStatus']=="NONE") echo 'selected="selected"'; ?>
								  	>None</option>
								  	<option value="KIV" 
								  	<?php if($row['applicationStatus']=="KIV") echo 'selected="selected"'; ?>
								  	>KIV (Keep In View)</option>
									<option value="ACCEPTED"
									<?php if($row['applicationStatus']=="ACCEPTED") echo 'selected="selected"'; ?>
									>Accepted ✔</option>
								    <option value="REJECTED"
								    <?php if($row['applicationStatus']=="REJECTED") echo 'selected="selected"'; ?>
								    >Rejected ❌</option>
								</select>
							</div>
						</div>

						<div class="col-lg-3 form-group">
							<label for="applicationStatus" style="font-size:18px;">Visa Status:</label>
		                    <div class="dropdown">
								<select id="visaStatus" name="visaStatus" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" disabled="">
									<option value="NONE" 
								  	<?php if($row['visaStatus']=="NONE") echo 'selected="selected"'; ?>
								  	>None</option>
								  	<option value="PENDING DOCS" 
								  	<?php if($row['visaStatus']=="PENDING DOCS") echo 'selected="selected"'; ?>
								  	>Pending Docs</option>
									<option value="SUBMITTED"
									<?php if($row['visaStatus']=="SUBMITTED") echo 'selected="selected"'; ?>
									>Submitted</option>
									<option value="PENDING PAYMENT" 
									<?php if($row['visaStatus']=="PENDING PAYMENT") echo 'selected="selected"'; ?>
									>Pending Payment</option>
								    <option value="PENDING VISA"
								    <?php if($row['visaStatus']=="PENDING VISA") echo 'selected="selected"'; ?>
								    >Pending Visa</option>
								    <option value="VISA APPROVED" 
								    <?php if($row['visaStatus']=="VISA APPROVED") echo 'selected="selected"'; ?>
								    >Visa Approved ✔</option>
								    <option value="VISA REJECTED"
								    <?php if($row['visaStatus']=="VISA REJECTED") echo 'selected="selected"'; ?>
								    >Visa Rejected ❌</option>
								</select>
							</div>
						</div>

						<div class="col-lg-3 form-group">
							<label for="applicationDocs" style="font-size:18px;">Missing Documents:</label>

							<div class="dropdown show">
											<button id="droppy2" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="button" class="form-control btn-outline btn-wrap-text" data-toggle="dropdown">Multiple Selection ▼</button>
											<ul class="dropdown-menu checkbox-menu allow-focus" id="dropdown_missingDoc">

											<li><a style="color: black;" href="#" class="large" data-value="Academic Transcript" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Academic Transcript" type="checkbox"

											<?php 

											  	$str = $row['missingDocumentsList'];
											  	if (strpos($str, 'Academic Transcript') !== false) {
													echo 'checked="checked"';
												} 

											?>

											/>&nbsp;Academic Transcript</a></li>

											<li><a style="color: black;" href="#" class="large" data-value="Highest Education Certificate" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Highest Education Certificate" type="checkbox"

											<?php 

											  	$str = $row['missingDocumentsList'];
											  	if (strpos($str, 'Highest Education Certificate') !== false) {
													echo 'checked="checked"';
												} 

											?>

											/>&nbsp;Highest Education Certificate</a></li>

											<li><a style="color: black;" href="#" data-value="Internship Letter" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Internship Letter" type="checkbox"

											<?php 

											  	$str = $row['missingDocumentsList'];
											  	if (strpos($str, 'Internship Letter') !== false) {
													echo 'checked="checked"';
												} 

											?>

											/>&nbsp;Internship Letter</a></li>

											<li><a style="color: black;" href="#" class="large" data-value="Passport Copy" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Passport Copy" type="checkbox"

											<?php 

											  	$str = $row['missingDocumentsList'];
											  	if (strpos($str, 'Passport Copy') !== false) {
													echo 'checked="checked"';
												} 

											?>

											/>&nbsp;Passport Copy</a></li>

											<li><a style="color: black;" href="#" class="large" data-value="Updated Resume" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Updated Resume" type="checkbox"

											<?php 

											  	$str = $row['missingDocumentsList'];
											  	if (strpos($str, 'Updated Resume') !== false) {
													echo 'checked="checked"';
												} 

											?>

											/>&nbsp;Updated Resume</a></li>
											
											<li><a style="color: black;" href="#" class="large" data-value="Visa Copy" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Visa Copy" type="checkbox"

											<?php 

											  	$str = $row['missingDocumentsList'];
											  	if (strpos($str, 'Visa Copy') !== false) {
													echo 'checked="checked"';
												} 

											?>

											/>&nbsp;Visa Copy</a></li>
											  
											<li><a style="color: black;" href="#" class="large" data-value="Others" tabIndex="-1">
											<input  name="missingDocumentsList[]" id="missingDocumentsList" value="Others" type="checkbox"

											<?php 

											  	$str = $row['missingDocumentsList'];
											  	if (strpos($str, 'Others') !== false) {
													echo 'checked="checked"';
												} 

											?>

											/>&nbsp;Others</a></li>

											</ul>
							</div>

						</div>

						<div class="col-lg-3 form-group">
							<label for="Others" style="font-size:18px;">‎‎‎‏‏‎ ‎</label>
							<input name="missingDocumentsListOthers" id="missingDocumentsListOthers" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" placeholder="Enter Others" 
								value="<?php echo $row['missingDocumentsListOthers'];?>">	
						</div>

						
					</div>

					<div class="row">

						<div class="col-lg-3 form-group">
			                    <label for="DOE" style="font-size:18px;">Date of Enrolment:</label>
			                    <input id="DOE" name="DOE" placeholder="MM/DD/YYYY" class="form-control" data-date-end-date="0d" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" 
			                    	value="<?php echo $row['DOE'];?>"
			                    />
							    
					    </div>

					    <div class="col-lg-3 form-group">
			                    <label for="DOG" style="font-size:18px;">Date of Graduation:</label>
			                    <input id="DOG" name="DOG" placeholder="MM/DD/YYYY" class="form-control" data-date-end-date="0d" style="border-radius: 10px; border-width: 2px; border-color: #fcb141" 
			                    	value="<?php echo $row['DOG'];?>"
			                    />
							    
					    </div>

					    <div class="col-lg-3 form-group">
							<label for="educationType" style="font-size:18px;">Education Type:</label>
		                    <div class="dropdown">
								<select name="educationType" id="educationType" class="form-control" style="border-radius: 10px; border-width: 2px; border-color: #fcb141">
									<!-- <option value="" selected disabled>Select the Highest</option> -->
								  	<option value="None" 
								  	<?php if($row['educationType']=="NONE") echo 'selected="selected"'; ?>
								  	>None</option>
									<option value="High School"
									<?php if($row['educationType']=="HIGH SCHOOL") echo 'selected="selected"'; ?>
									>High School</option>
								    <option value="Diploma" 
								    <?php if($row['educationType']=="DIPLOMA") echo 'selected="selected"'; ?>
								    >Diploma</option>
								    <option value="Bachelor's" 
								    <?php if($row['educationType']=="BACHELOR'S") echo 'selected="selected"'; ?>
								    >Bachelor's</option>
								    <option value="Master's" 
								    <?php if($row['educationType']=="MASTER'S") echo 'selected="selected"'; ?>
								    >Masters's</option>
								    <option value="PhD" 
								    <?php if($row['educationType']=="PHD") echo 'selected="selected"'; ?>
								    >PhD</option>
								    <option value="Others" 
								    <?php if($row['educationType']=="OTHERS") echo 'selected="selected"'; ?>
								    >Others</option>
								</select>
							</div>

						</div>

						<div class="col-lg-3 form-group" style="display: none;" id="educationOther" name="educationOther">
							<label for="Others" style="font-size:18px;">‎‎‎‏‏‎ ‎</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="educationTypeOthers" name="educationTypeOthers" placeholder="Enter Others" 
							value="<?php echo $row['educationTypeOthers'];?>">
							<small id="emailHelp" class="form-text text-muted">Remove text when deselecting.</small>	
						</div>

					</div>

					<div class="form-group">
							<label for="educationTitle" style="font-size:18px;">Education Title:</label>
							<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="educationTitle" name="educationTitle" placeholder="Highest Qualification"
							value="<?php echo $row['educationTitle'];?>">
					</div>

					<div class="form-group">
						<label for="InstituitionName" style="font-size:18px;">Instituition Name:</label>
						<input style="border-radius: 10px; border-width: 2px; border-color: #fcb141" type="text" class="form-control" id="instituitionName" name="instituitionName" placeholder="Name of the Institute"
						value="<?php echo $row['instituitionName'];?>">
					</div>

					<div class="form-group">

						<label for="remarks">Remarks:</label>
    					<textarea style="border-radius: 10px; border-width: 2px; border-color: #fcb141; height: 100px;" class="form-control" type="text" id="remarks" name="remarks" placeholder="Enter any comments (optional)"
    					><?php echo $row['remarks'];?>
    						
    					</textarea>
					</div>

					
	                <p id="button" class="col-lg-4 form-group" style="margin: auto;">
	                    <input name="sub" type="submit" value="UPDATE" class="btn btn-danger" id="myBtn" style=" border-radius: 10px; width:100%; height:50px;font-size:20px;">
	                </p>

                    <br> <br>
                </div>
            </form>
    <?php
		    }
		}
	?>
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

		if ($('#educationType').val() == 'Others') {
	                $('#educationOther').show();
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
			
			//for date selection
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

        	// used for showing names when page loads for drop down checkbox
			// $("#dropdown_languages input[type=checkbox]").on('change', function() {
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
	        // });

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

	        // used for showing names when page loads for drop down checkbox
	        // $("#dropdown_missingDoc input[type=checkbox]").on('change', function() {
	        let multi_text2 = "";
	          $("#dropdown_missingDoc input[type=checkbox]").each(function() {
	            if ($(this).is(":checked")) {
	              multi_text2 += $(this).val() + " ";
	            } else {}
	            if (multi_text2 !== '') {
	              $("#droppy2").text(multi_text2);
	            } else {
	              $("#droppy2").text("Multiple Selection ▼"); 
	            }
	          });
	        // });

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