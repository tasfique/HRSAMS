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

		function relocate_home() {
			location.href = "index.php";
		}

		$(document).ready(function() {
			<?php
			if (isset($_POST["login"])) {
				if (empty($_POST["username"]) || empty($_POST["password"])) {
					?>
					$("#emptyFieldError").modal();
					<?php
				} else {
					$userType = mysqli_real_escape_string($conn, $_POST['userType']);
				// 	$query = "SELECT * FROM USERS WHERE userType = '$userType'";
					$affiliateCode = mysqli_real_escape_string($conn, $_POST['affiliateCode']);
				// 	$query = "SELECT * FROM USERS WHERE affiliateCode = 'affiliateCode'";
					$username = mysqli_real_escape_string($conn, $_POST["username"]);
					$password = mysqli_real_escape_string($conn, $_POST["password"]);
					$query = "SELECT * FROM USERS WHERE username = '$username' AND affiliateCode = '$affiliateCode'";
					$result = mysqli_query($conn, $query);
					if($_POST["userType"]=="Admin" && strpos($username, 'admin') !== false) {
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_array($result)) {
								if (password_verify($password, $row["password"])) {
		 					//return true;
									$_SESSION['username'] = $username;
									$_SESSION['userType'] = $userType;
									$_SESSION['affiliateCode'] = $affiliateCode;
									?>
									<?php
									header("Location: admin_page.php");
									?>
									<?php
								} else {
									?>
									$("#errorModal").modal();
									<?php

								}
							}

						} else {
							?>
							$("#loginFailedModal").modal();
							<?php

						}

					} else if($_POST["userType"]=="Manager" && strpos($username, 'manager') !== false) {
						
						if (mysqli_num_rows($result) > 0) {
							
							while ($row = mysqli_fetch_array($result)) {
								if (password_verify($password, $row["password"])) {
		 					//return true;
									$_SESSION['username'] = $username;
									$_SESSION['userType'] = $userType;
									$_SESSION['affiliateCode'] = $affiliateCode;
									header("Location: manager_page.php");

								} else {
		 					//return false;
									?>
									$("#errorModal").modal();
									<?php

								}
							}

						} else {
							?>
							$("#loginFailedModal").modal();
							<?php
						}

					} else if($_POST["userType"]=="Assessment Staff" && strpos($username, 'assessment') !== false) {
						
						if (mysqli_num_rows($result) > 0) {
							
							while ($row = mysqli_fetch_array($result)) {
								if (password_verify($password, $row["password"])) {
		 					//return true;
									$_SESSION['username'] = $username;
									$_SESSION['userType'] = $userType;
									$_SESSION['affiliateCode'] = $affiliateCode;
									header("Location: assessment_page.php");

								} else {
									?>
									$("#errorModal").modal();
		 					//return false;
		 					
		 					<?php
		 					
		 				}
		 			}

		 		} else {
		 			?>
		 			$("#loginFailedModal").modal();
		 			<?php
		 			
		 		}

		 	} else if($_POST["userType"]=="Assessment Staff" && strpos($username, 'affiliate') !== false) {
						
						if (mysqli_num_rows($result) > 0) {
							
							while ($row = mysqli_fetch_array($result)) {
								if (password_verify($password, $row["password"])) {
		 					//return true;
							        $_SESSION['username'] = $username;
									$_SESSION['userType'] = $userType;
									$_SESSION['affiliateCode'] = $affiliateCode;
									
									header("Location: assessmentAffiliate_page.php");
				    
								} else {
									?>
									$("#errorModal").modal();
		 					//return false;
		 					
		 					<?php
		 					
		 				}
		 			}

		 		} else {
		 			?>
		 			$("#loginFailedModal").modal();
		 			<?php
		 			
		 		}



		 	} else if($_POST["userType"]=="Visa Advisor" && strpos($username, 'vadvisor') !== false) {
		 		
		 		if (mysqli_num_rows($result) > 0) {
		 			
		 			while ($row = mysqli_fetch_array($result)) {
		 				if (password_verify($password, $row["password"])) {
		 					//return true;
		 					$_SESSION['username'] = $username;
		 					$_SESSION['userType'] = $userType;
		 					$_SESSION['affiliateCode'] = $affiliateCode;
		 					header("Location: visaAdvisor_page.php");

		 				} else {
		 					?>
		 					$("#errorModal").modal();
		 					<?php
		 					//return false;
		 					
		 				}
		 			}

		 		} else {
		 			?>
		 			$("#loginFailedModal").modal();
		 			<?php
		 			
		 		}

		 	}


		 	else {
		 		?>
		 		$("#wrongUserModal").modal();
		 		<?php

		 	}
		 	
		 	
		 }

		}  
		?>
	});
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
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p>Successfully Login!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick= "relocate_home()" data-dismiss="modal">OK</button>
				</div>
			</div>
			
		</div>
	</div>

	<div class="modal fade" id="emptyFieldError" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Message</h4>
					<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				</div>
				<div class="modal-body">
					<p>Both Username and Password are Required!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick=" relocate_home()" data-dismiss="modal">OK</button>
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
					<p>Wrong Username or Password!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick="relocate_home()" data-dismiss="modal">OK</button>
				</div>
			</div>
			
		</div>
	</div>

	<div class="modal fade" id="loginFailedModal" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Message</h4>
					<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				</div>
				<div class="modal-body">
					<p>Failed to Login.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick="relocate_home()" data-dismiss="modal">OK</button>
				</div>
			</div>
			
		</div>
	</div>

	<div class="modal fade" id="wrongUserModal" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Message</h4>
					<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				</div>
				<div class="modal-body">
					<p>Select the Correct User Type.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick="relocate_home()" data-dismiss="modal">OK</button>
				</div>
			</div>
			
		</div>
	</div>
	
</body>
</html>