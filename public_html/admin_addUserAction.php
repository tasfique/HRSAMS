<?php
ob_start();
include("connection.php");

	// CREATE CONNECTION
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

	// CHECK CONNECTION
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
	if (isset($_POST["register"])) {
	 	if (empty($_POST["username"]) || empty($_POST["confirmPassword"]) || empty($_POST["affiliateCode"])) {
	 		echo '<script>alert("All Fields are Required!")</script>';
	 	} else {
	 		$username = mysqli_real_escape_string($conn, $_POST["username"]);
	 		$password = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);
	 		$affiliateCode = mysqli_real_escape_string($conn, $_POST["affiliateCode"]);
	 		$userType = mysqli_real_escape_string($conn, $_POST['userType']);
	 		$password = password_hash($password, PASSWORD_BCRYPT);
	 		$query = "INSERT INTO USERS(username, userType, affiliateCode, password) VALUES ('$username', '$userType', '$affiliateCode', '$password')";

	 		// if (mysqli_query($conn, $query)) {
	 		// 	echo '<script>alert("Registration Done")</script>';
	 		// } else {
	 		// 	echo '<script>alert("Registration Failed")</script>';	
	 		// }
	 	}
	 }
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
			if (mysqli_query($conn, $query)) {
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
	    location.href = "admin_addUser.php";
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
	          <p>Successfully Registered the New User!</p>
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
	          <p>Failed to Create New User.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" onclick=" relocate_home()" data-dismiss="modal">OK</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
	  
</body>
</html>