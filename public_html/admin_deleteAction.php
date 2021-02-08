<?php
	session_start();
	if (!isset($_SESSION['username']) || empty($_SESSION['affiliateCode']) || $_SESSION['userType'] != "Admin") {
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
	// When the PHP reads the input from the HTML input tag, it reads the name attribute not ID.
	$applicantID = $_GET["applicantID"];

	$sql = "DELETE FROM APPLICANTS WHERE applicantID = '$applicantID'";
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
	    location.href = "admin_view.php";
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
	          <p>Successfully Deleted!</p>
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
	          <p>Failed to Delete.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" onclick=" relocate_home()" data-dismiss="modal">OK</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
	  
</body>
</html>