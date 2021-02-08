<?php
if(isset($_POST["export"]))  
{   
    include("connection.php");

	// CREATE CONNECTION
    $connect = new mysqli($servername, $username, $password, $dbname);
    //$connect = mysqli_connect("localhost", "id15928782_hrsams", "#b>ph*6NeUDMRj#q", "id15928782_hr_ams");
    //   ob_start();
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=promotional_table.csv');
    //   ob_end_clean();
    $output = fopen("php://output", "w");  
    fputcsv($output, array('Application ID', 'First Name', 'Last Name', 'Phone Number' , 'E-Mail'));  
    $query = "SELECT applicantID, firstName, lastName, phoneNumber, email from APPLICANTS ORDER BY applicantID ASC";  
    $r = mysqli_query($connect, $query);  
    while($row = mysqli_fetch_assoc($r))  
    {  
       fputcsv($output, $row);  
    }  
    fclose($output);
}  
?>  