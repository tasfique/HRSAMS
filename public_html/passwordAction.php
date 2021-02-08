<?php 

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
		$(document).ready(function() {

			<?php
			if (isset($_POST["passwordChangeAdmin"])) {
				if (empty($_POST["username"]) || empty($_POST["confirmPassword"])) {
			?>
					$("#errorModal").modal();
					// echo '<script>alert("Both Fields are Required!")</script>';
			<?php
				} else {
					$username = mysqli_real_escape_string($conn, $_POST["username"]);
					$password = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);
					$password = password_hash($password, PASSWORD_BCRYPT);
					$query = "UPDATE USERS SET password = '$password' WHERE username = '$username'";
					$result = $conn->query($query);

	 		// if (mysqli_query($conn, $query)) {
	 		// 	echo '<script>alert("Password Changed")</script>';
	 		// } else {
	 		// 	echo '<script>alert("Password Change Failed")</script>';	
	 		// }
				}
			}
			if (isset($_POST["passwordChangeManager"])) {
				if (empty($_POST["username"]) || empty($_POST["confirmPassword"])) {
			?>
					$("#errorModal").modal();
					<!-- echo '<script>alert("Both Fields are Required!")</script>'; -->
			<?php
				} else {
					$username = mysqli_real_escape_string($conn, $_POST["username"]);
					if (strpos($username, 'assessment') !== false || strpos($username, 'manager') !== false || strpos($username, 'vadvisor') !== false) {

						$username = mysqli_real_escape_string($conn, $_POST["username"]);
						$password = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);
						$password = password_hash($password, PASSWORD_BCRYPT);
						$query = "UPDATE USERS SET password = '$password' WHERE username = '$username'";
						$result = $conn->query($query);

		 		// if (mysqli_query($conn, $query)) {
		 		// 	echo '<script>alert("Password Changed")</script>';
		 		// } else {
		 		// 	echo '<script>alert("Password Change Failed")</script>';	
		 		// }
					} else {
			?>
						$("#errorManager").modal();
			<?php
	 			// echo '<script>alert("You are not allowed to change for Admin")</script>';
					}
				}
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
					
				</div>
				<div class="modal-body">
					<p>Password Changed!</p>
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
					<p>Both Username and Password are Required!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick=" relocate_home()" data-dismiss="modal">OK</button>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade" id="errorManager" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Message</h4>
					<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				</div>
				<div class="modal-body">
					<p>You cannot change Password for ADMIN!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick=" relocate_home()" data-dismiss="modal">OK</button>
				</div>
			</div>

		</div>
	</div>

</body>
</html>

