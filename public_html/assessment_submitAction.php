<?php
	session_start();
	if (!isset($_SESSION['username']) || empty($_SESSION['affiliateCode']) || $_SESSION['userType'] != "Assessment Staff") {
		header("location:index.php?action=login");
	}

	//connect to the database
	include("connection.php");

	// CREATE CONNECTION
	$conn = new mysqli($servername, $username, $password, $dbname);

	// CHECK CONNECTION
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	//used for setting date to Malaysia
	date_default_timezone_set('Asia/Kuala_Lumpur');
	// $script_tz = date_default_timezone_get();

	// When the PHP reads the input from the HTML input tag, it reads the name attribute not ID.
	// Skipped is used for skipping capitalisation.

	//for image upload and to make sure the image has a unique name.
	if(isset($_POST['sub'])){
        // $image       = $_FILES['image']['name'];        
        $image2 = $_FILES['image']['name'];
        $image = "";
        
        if(isset($image2) and !empty($image2)){
        	$image = date("Y_m_d_H_i_s_") . basename($image2);  
        	$temp_name  = $_FILES['image']['tmp_name'];  
            $location = 'images';
            echo '<script>alert("IMAGE PROCESSED!!")</script>';
            if(move_uploaded_file($temp_name, "$location/$image")){
                // echo 'File uploaded successfully';
                // echo '<script>alert("IMAGE UPLOADED TO DATABASE!!")</script>';
            }
        } else {
            // echo 'You should select a file to upload !!';
            echo '<script>alert("You should select a Picture for the Applicant!")</script>';

        }
	}

	if(isset($_POST['sub'])){
        // $image       = $_FILES['image']['name'];        
        $file2 = $_FILES['file']['name'];
        $file = "";
        
        if(isset($file2) and !empty($file2)){
        	$file = date("Y_m_d_H_i_s_") . basename($file2);  
        	$temp_name  = $_FILES['file']['tmp_name'];  
            $location = 'files';
            //echo '<script>alert("FILE PROCESSED!!")</script>';
            if(move_uploaded_file($temp_name, "$location/$file")){
                //echo 'File uploaded successfully';
                // echo '<script>alert("IMAGE UPLOADED TO DATABASE!!")</script>';
            }
        } else {
            // echo 'You should select a file to upload !!';
            echo '<script>alert("You should upload a ZIP or RAR File for the Applicant!")</script>';

        }
	}

	$affiliateCode = $_SESSION["affiliateCode"];
	$DOA = $_POST['DOA']; //skipped
	$passportNumber = $_POST["passportNumber"];
	$firstName = addslashes($_POST["firstName"]);
	$lastName = addslashes($_POST["lastName"]);
	$selectGenderType = $_POST['selectGenderType'];
	$DOB = $_POST['DOB']; //skipped
	$nationality = addslashes($_POST['nationality']);

	// Used for languages list drop down check box.
	if(isset($_POST['sub']))  
	{
	$checkbox1 = isset($_POST['languages']) ? $_POST['languages'] : '';  
	$languages="";
		if(is_array($checkbox1)){  
			foreach($checkbox1 as $chk1)  
			   {  
			      $languages .= $chk1." , ";  
			   }
		}  
	}

	$positionCategory = $_POST['positionCategory'];
	$positionTitle = $_POST['positionTitle'];
	$paymentID = $_POST['paymentID'];
	$DOS = $_POST['DOS']; //skipped
	$customerType = $_POST['customerType'];
	$phoneNumber = $_POST['phoneNumber']; //skipped 
	$email = addslashes($_POST['email']); //skipped
	$currentAddress = addslashes($_POST['currentAddress']); 
	$postalCodeC = $_POST['postalCodeC']; 
	$areaC = addslashes($_POST['areaC']);
	$stateC = addslashes($_POST['stateC']);
	$currentCountry = addslashes($_POST['currentCountry']);
	$permanentAddress = addslashes($_POST['permanentAddress']);
	$postalCodeP = addslashes($_POST['postalCodeP']);
	$areaP = addslashes($_POST['areaP']);
	$stateP = addslashes($_POST['stateP']);
	$permanentCountry = addslashes($_POST['permanentCountry']);
	$applicationStatus = $_POST['applicationStatus'];
	$visaStatus = $_POST['visaStatus'];

	// Used for Missing document list drop down check box.
	if(isset($_POST['sub']))  
	{
	$checkbox2 = isset($_POST['missingDocumentsList']) ? $_POST['missingDocumentsList'] : '';
	$missingDocumentsList="";
		if(is_array($checkbox2)){  
			foreach($checkbox2 as $chk2)  
			   {  
			      $missingDocumentsList .= $chk2." , ";  
			   }
		}  
	}

	$missingDocumentsListOthers = addslashes($_POST['missingDocumentsListOthers']);	
	$DOE = $_POST['DOE']; //skipped
	$DOG = $_POST['DOG'];  //skipped
	$educationType = addslashes($_POST['educationType']);
	$educationTypeOthers = addslashes($_POST['educationTypeOthers']); 
	$educationTitle = addslashes($_POST['educationTitle']);
	$instituitionName = addslashes($_POST['instituitionName']);
	$remarks = addslashes($_POST['remarks']); //skipped

	// Converting to Capital Letters
	$resultPassportNumber = strtoupper($passportNumber);
	$resultFirstName = strtoupper($firstName);
	$resultLastName = strtoupper($lastName);
	$resultselectGenderType = strtoupper($selectGenderType);
	$resultPositionCategory = strtoupper($positionCategory);
	$resultPositionTitle = strtoupper($positionTitle);
	$resultPaymentID = strtoupper($paymentID);
	$resultCustomerType = strtoupper($customerType);
	$resultCurrentAddress = strtoupper($currentAddress);
	$resultPostalCodeC = strtoupper($postalCodeC);
	$resultAreaC = strtoupper($areaC);
	$resultStateC = strtoupper($stateC);
	$resultPermanentAddress = strtoupper($permanentAddress);
	$resultPostalCodeP = strtoupper($postalCodeP);
	$resultAreaP = strtoupper($areaP);
	$resultStateP = strtoupper($stateP);
	$resultEducationType = strtoupper($educationType);
	$resultEducationTypeOthers = strtoupper($educationTypeOthers);
	$resultApplicationStatus = strtoupper($applicationStatus);
	$resultVisaStatus = strtoupper($visaStatus);
	$resultMissingDocumentsListOthers = strtoupper($missingDocumentsListOthers);
	$resultEducationTitle = strtoupper($educationTitle);
	$resultInstituitionName = strtoupper($instituitionName);

	//INPUTTING INTO THE DATABASE
	$sql = "INSERT INTO APPLICANTS (image, file, affiliateCode, DOA, passportNumber, firstName, lastName, selectGenderType, DOB, 
	nationality, languages,
	positionCategory, positionTitle, paymentID, DOS, customerType, phoneNumber, email, 
	currentAddress, postalCodeC, areaC, stateC, currentCountry,
	permanentAddress, postalCodeP, areaP, stateP, permanentCountry,   
	applicationStatus, visaStatus, missingDocumentsList, missingDocumentsListOthers, DOE, DOG, educationType, educationTypeOthers,
	educationTitle, instituitionName, remarks) VALUES 
	('$image' , '$file' , '$affiliateCode' , '$DOA' , '$resultPassportNumber', '$resultFirstName', '$resultLastName', '$resultselectGenderType' , '$DOB' , 
	'$nationality' , '$languages' , 
	'$resultPositionCategory' , '$resultPositionTitle' , '$resultPaymentID' , '$DOS' , '$resultCustomerType' , '$phoneNumber' , '$email' , 
	'$resultCurrentAddress' , '$resultPostalCodeC' , '$resultAreaC' , '$resultStateC' , '$currentCountry' ,
	'$resultPermanentAddress' , '$resultPostalCodeP' , '$resultAreaP' , '$resultStateP' , '$permanentCountry' ,
	'$resultApplicationStatus' , '$resultVisaStatus' , '$missingDocumentsList' , '$resultMissingDocumentsListOthers' , '$DOE' , '$DOG' , '$resultEducationType' , '$resultEducationTypeOthers' ,
	'$resultEducationTitle' , '$resultInstituitionName' , '$remarks')";

	$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		<?php
			if($result === true) {
		?>
				$("#successModal").modal();
		<?php
			} else {
		?>
				$("errorModal").modal();
		<?php
			}
		?>
	});

	function relocate_home()
	{
	    location.href = "assessment_page.php";
	}
	
</script>
</head>
<body>
	<!-- Modal -->
	  <div class="modal fade" id="successModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          	<h4 class="modal-title">Message</h4>
	          	<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
	        </div>
	        <div class="modal-body">
	          <p>Successfully Added!</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" onclick= "relocate_home()" data-dismiss="modal">OK</button>
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
	          	<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
	        </div>
	        <div class="modal-body">
	          <p>Failed to Add.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" onclick=" relocate_home()" data-dismiss="modal">OK</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
	  
</body>
</html>