<?php
	session_start();
	if (!isset($_SESSION['username']) || empty($_SESSION['affiliateCode']) || $_SESSION['userType'] != "Manager") {
		header("location:index.php?action=login");
	}

	include("connection.php");

	// CREATE CONNECTION
	$conn = new mysqli($servername, $username, $password, $dbname);

	// CHECK CONNECTION
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	date_default_timezone_set('Asia/Kuala_Lumpur');

	// When the PHP reads the input from the HTML input tag, it reads the name attribute not ID.
	$applicantID = $_POST["applicantID"];
	$passportNumber = $_POST["passportNumber"];
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$selectGenderType = $_POST['selectGenderType'];
	$DOB = $_POST['DOB']; //skipped
	$nationality = $_POST['nationality'];

	// Used for languages list drop down check box.
	
	$checkbox1 = isset($_POST['languages']) ? $_POST['languages'] : '';  
	$languages="";
		if(is_array($checkbox1)){  
			foreach($checkbox1 as $chk1)  
			   {  
			      $languages .= $chk1." , ";  
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
	
	$checkbox2 = isset($_POST['missingDocumentsList']) ? $_POST['missingDocumentsList'] : '';
	$missingDocumentsList="";
		if(is_array($checkbox2)){  
			foreach($checkbox2 as $chk2)  
			   {  
			      $missingDocumentsList .= $chk2." , ";  
			   }
		}  
	

	$missingDocumentsListOthers = addslashes($_POST['missingDocumentsListOthers']);
	// $_missingDocumentsListOthers = ($missingDocumentsListOthers);	
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
	// $resultNationality = strtoupper($nationality);
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
	//$resultCurrentCountry = strtoupper($currentCountry);
	//$resultPermanentCountry = strtoupper($permanentCountry);
	$resultEducationType = strtoupper($educationType);
	$resultEducationTypeOthers = strtoupper($educationTypeOthers);
	// $resultApplicationStatus = strtoupper($applicationStatus);
	// $resultVisaStatus = strtoupper($visaStatus);
	$resultMissingDocumentsListOthers = strtoupper($missingDocumentsListOthers);
	$resultEducationTitle = strtoupper($educationTitle);
	$resultInstituitionName = strtoupper($instituitionName);


	$sql = "UPDATE APPLICANTS SET
	passportNumber = '$resultPassportNumber',
	firstName = '$resultFirstName', 
	lastName = '$resultLastName',
	selectGenderType = '$resultselectGenderType',
	DOB = '$DOB',
	nationality = '$nationality',
	languages = '$languages',
	positionCategory = '$resultPositionCategory',
	positionTitle = '$resultPositionTitle',
	paymentID = '$resultPaymentID',
	DOS = '$DOS',
	customerType = '$resultCustomerType',
	phoneNumber = '$phoneNumber',
	email = '$email',
	currentAddress = '$resultCurrentAddress',
	postalCodeC = '$resultPostalCodeC',
	areaC = '$resultAreaC',
	stateC = '$resultStateC',
	currentCountry = '$currentCountry',
	permanentAddress = '$resultPermanentAddress',
	postalCodeP = '$resultPostalCodeP',
	areaP = '$resultAreaP',
	stateP = '$resultStateP',
	permanentCountry = '$permanentCountry',
	applicationStatus = '$applicationStatus',
	visaStatus = '$visaStatus',
	missingDocumentsList = '$missingDocumentsList',
	missingDocumentsListOthers = '$resultMissingDocumentsListOthers',
	DOE = '$DOE',
	DOG = '$DOG',
	educationType = '$resultEducationType',
	educationTypeOthers = '$resultEducationTypeOthers',
	instituitionName = '$resultInstituitionName',
	remarks = '$remarks' 
	-- there might be a comma up there.
	WHERE applicantID = '$applicantID'";

	// The code below has issue, when replacing the image with a new image the name of the image
	// does't not contain date and time, which can cause duplication of the image.
	if(isset($_POST['sub'])){
        $image2 = $_FILES['image']['name'];
        $image = date("Y_m_d_H_i_s_") . basename($image2);  
        $temp_name  = $_FILES['image']['tmp_name'];  
        if(isset($image2) and !empty($image2)){
            $location = 'images/';

            $sql = "UPDATE APPLICANTS SET
			image = '$image',
			passportNumber = '$resultPassportNumber',
			firstName = '$resultFirstName', 
			lastName = '$resultLastName',
			selectGenderType = '$resultselectGenderType',
			DOB = '$DOB',
			nationality = '$nationality',
			languages = '$languages',
			positionCategory = '$resultPositionCategory',
			positionTitle = '$resultPositionTitle',
			paymentID = '$resultPaymentID',
			DOS = '$DOS',
			customerType = '$resultCustomerType',
			phoneNumber = '$phoneNumber',
			email = '$email',
			currentAddress = '$resultCurrentAddress',
			postalCodeC = '$resultPostalCodeC',
			areaC = '$resultAreaC',
			stateC = '$resultStateC',
			currentCountry = '$currentCountry',
			permanentAddress = '$resultPermanentAddress',
			postalCodeP = '$resultPostalCodeP',
			areaP = '$resultAreaP',
			stateP = '$resultStateP',
			permanentCountry = '$permanentCountry',
			applicationStatus = '$applicationStatus',
			visaStatus = '$visaStatus',
			missingDocumentsList = '$missingDocumentsList',
			missingDocumentsListOthers = '$resultMissingDocumentsListOthers',
			DOE = '$DOE',
			DOG = '$DOG',
			educationType = '$resultEducationType',
			educationTypeOthers = '$resultEducationTypeOthers',
			instituitionName = '$resultInstituitionName',
			remarks = '$remarks'
			WHERE applicantID = '$applicantID'";

            // echo '<script>alert("IMAGE PROCESSED!!")</script>';
            if(move_uploaded_file($temp_name, $location.$image)){
                // echo 'File uploaded successfully';
                // echo '<script>alert("IMAGE UPLOADED TO DATABASE!!")</script>';
            }
        } else {
            // echo 'You should select a file to upload !!';
        }

        $file2 = $_FILES['file']['name'];
        $file = date("Y_m_d_H_i_s_") . basename($file2);
        $temp_name  = $_FILES['file']['tmp_name'];

        //for file upload
        if(isset($file2) and !empty($file2)){
            $location = 'files/';

            $sql = "UPDATE APPLICANTS SET
			file = '$file',
			passportNumber = '$resultPassportNumber',
			firstName = '$resultFirstName', 
			lastName = '$resultLastName',
			selectGenderType = '$resultselectGenderType',
			DOB = '$DOB',
			nationality = '$nationality',
			languages = '$languages',
			positionCategory = '$resultPositionCategory',
			positionTitle = '$resultPositionTitle',
			paymentID = '$resultPaymentID',
			DOS = '$DOS',
			customerType = '$resultCustomerType',
			phoneNumber = '$phoneNumber',
			email = '$email',
			currentAddress = '$resultCurrentAddress',
			postalCodeC = '$resultPostalCodeC',
			areaC = '$resultAreaC',
			stateC = '$resultStateC',
			currentCountry = '$currentCountry',
			permanentAddress = '$resultPermanentAddress',
			postalCodeP = '$resultPostalCodeP',
			areaP = '$resultAreaP',
			stateP = '$resultStateP',
			permanentCountry = '$permanentCountry',
			applicationStatus = '$applicationStatus',
			visaStatus = '$visaStatus',
			missingDocumentsList = '$missingDocumentsList',
			missingDocumentsListOthers = '$resultMissingDocumentsListOthers',
			DOE = '$DOE',
			DOG = '$DOG',
			educationType = '$resultEducationType',
			educationTypeOthers = '$resultEducationTypeOthers',
			instituitionName = '$resultInstituitionName',
			remarks = '$remarks'
			WHERE applicantID = '$applicantID'";

            // echo '<script>alert("IMAGE PROCESSED!!")</script>';
            if(move_uploaded_file($temp_name, $location.$file)){
                // echo 'File uploaded successfully';
                // echo '<script>alert("IMAGE UPLOADED TO DATABASE!!")</script>';
            }
        } else {
            // echo 'You should select a file to upload !!';   

        }
	}
	
	if (isset($_POST['emailSub'])) {
		$applicantID = $_POST['applicantID'];
		$passportNumber = $_POST['passportNumber'];
		$billingAmount = $_POST['billingAmount'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$positionCategory = $_POST['positionCategory'];
		$positionTitle = $_POST['positionTitle'];
		$email = $_POST['email'];
		$emailSender = "tormarebaap@gmail.com";

		$to = "tasfique26@gmail.com";
		$subject = "Applicant ID: ".$applicantID." Billing Information";
		$message = "Billing Information of Mr/Mrs: ".$firstName." ".$lastName."\n"."Passport/IC Number: ".$passportNumber."\n"."Position Category: ".$positionCategory."\n"."Position Title: ".$positionTitle."\n"."Total Amount is RM".$billingAmount;
		$headers="From: ".$emailSender;

		if (mail($to, $subject, $message, $headers)) {
			echo '<script>alert("Billing Information Email has been Sent Successfully to the Accounts.")</script>';
		} else {
		    echo '<script>alert("Something went wrong sending an Email to the Accounts. ")</script>';
		}
	}
	
	$result = $conn->query($sql);

	// if($result === true) {
	// 	header("refresh:3;url=http://localhost/hr_ams/manager_update.php?applicantID=$applicantID.php");
	// 	echo '<script>alert("SUCCESSFULLY UPDATED! ")</script>';
	// }
	// else {
	// 	header("refresh:3;url=http://localhost/hr_ams/manager_update.php?applicantID=$applicantID.php");
	// 	echo '<script>alert("Failed to ADD, There might be duplicate Passport Number or Database Issue")</script>';
	// }
	
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
	    window.history.back();
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
	          <p>Successfully Updated!</p>
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
	          <p>Failed to Update.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" onclick=" relocate_home()" data-dismiss="modal">OK</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
	  
</body>
</html>