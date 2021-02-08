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
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM USERS WHERE userType != 'Admin'";

	$r = @mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Bootstrap 4 links import -->
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

	    <!-- this script was imported to be used in the date for DOB, date of submission etc. -->
	    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
	    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

	    <!-- Download Table bootstrap -->
	   	<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"> -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
			    

	    <!-- Local CSS -->
	    <!-- used for external css -->
	    <link rel="stylesheet" type="text/css" href="css/mystyle3.css">

	    <!-- Local JS -->
	    <!-- <script src="myscripts2.js"></script> -->

		<title>Admin Users View</title>
		<link rel="icon" type="image/png" href="assets/hr.png">
		<link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
		<link rel="shortcut icon" href="assets/favicon.ico">

		<!-- Used for internal CSS -->
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
		      	<li class="nav-item" name="navButtons" title="Add Applicant" onclick="location.href = 'admin_page.php';">
			      	<a style="margin: 10px;" class="btn btn-success" href="#"><img class="navbar-link" src="assets/application-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
			      	<span class="nav-short-text">New Application</span>
			        <!-- <a class="nav-link" href="#">New Application<span class="sr-only">(current)</span></a> -->
		    	</li>
		      	<li class="nav-item" onclick="location.href = 'admin_view.php';" name="navButtons" title="View Table">
		      		<a style="margin: 10px;" class="btn btn-primary" href="#"><img class="navbar-link" src="assets/table-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">View Table</span>
		        	<!-- <a class="nav-link" href="#">Table</a> -->
		      	</li>
		      	<li class="nav-item active" name="navButtons" title="View Users" onclick="location.href = 'admin_viewUser.php';">
		      		<a style="margin: 10px;" class="btn btn-light" href="#"><img class="navbar-link" src="assets/userView-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">View User</span>
		      	</li>
		      	<li class="nav-item" name="navButtons" title="Add Users" onclick="location.href = 'admin_addUser.php';">
		      		<a style="margin: 10px;" class="btn btn-dark" href="#"><img class="navbar-link" src="assets/user-icon.png" style="width: 30px; height: 30px;" alt=""> </a>
		      		<span class="nav-short-text">Add User</span>
		      	</li>
		      	<li class="nav-item" name="navButtons" title="Change Password" onclick="location.href = 'admin_password.php';">
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
            <div class="form-group" >
			  <h2 style="text-align: center; font-style: oblique;">AMS Users Table</h2>
			  <br>
    			<div>
					<table id="example" class="table table-bordered table-hover table-responsive">
					  	<thead class='thead-dark'>
					  		<tr>
					  			<th class="applicationID">Username</th>
					  			<th>Affiliate Code</th>
					  			<th>User Type</th>
					  			<th>Action</th>
					  		</tr>
					  	</thead>
					  <tbody id="myTable">
					  <?php
					  	if($r) {
					  		// Instead of string concatenation, php use dot(.) not plus(+) 
					  		while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
					  			echo "<tr>
					  			<td>".$row['username']."</td>
					  			<td>".$row['affiliateCode']."</td>
					  			<td>".$row['userType']."</td>
					  			<td>
					  			<br>
					  			<a class='btn btn-danger' href='admin_userViewDeleteAction.php?username=".$row['username']."'
					  			> DELETE USER <img src='assets/delete-icon.png'></a>
					  			</td>
					  			</tr>"; 
					  		} 
					  		
					  	}
					  ?>
						</tbody>
					</table>


					<!-- Used for Bootstrap table search and download as excel file -->
					<!-- This is an bootstrap 4 datatable import -->
					<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
				    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
				    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
				    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
				    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
				    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
				    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
				    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
				    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
				    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
				    <!-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script> -->
				    <script>
						$(document).ready(function() {
						    var table = $('#example').DataTable( {
						        lengthChange: false,
						        // "bPaginate": false,

						        "paging":   false,
						        orderCellsTop: true,
						        fixedHeader: true,
						        // "ordering": false,
						        // searching: false,
						        //buttons: [ 'excel' ]
						    } );
						 
						    table.buttons().container()
						        .appendTo( '#example_wrapper .col-md-6:eq(0)' );

						    $('#example thead tr').clone(true).appendTo( '#example thead' );
						    // $('#example thead tr').hide();
						    $('#example thead tr:eq(1) th').hide();
						    $('#example thead tr:eq(0) th').each( function (i) {
						        var title = $(this).text();
						        $(this).html( title + '<input style="width:100%;" type="text" placeholder="🔍 " />' );
						 
						        $( 'input', this ).on( 'keyup change', function () {
						            if ( table.column(i).search() !== this.value ) {
						                table
						                    .column(i)
						                    .search( this.value )
						                    .draw();
						            }
						        } );
						    } );

						} );


						
				     </script>

				</div>
			</div>

        </div>
        <br>

    </body>
</html>