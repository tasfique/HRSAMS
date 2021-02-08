<?php
    session_start();
    if(isset($_POST["export"]))  
    {  
        include("connection.php");
    	// CREATE CONNECTION
        $connect = new mysqli($servername, $username, $password, $dbname);
        //   ob_start();
        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename=promotional_table.csv');
        //   ob_end_clean();
        $affiliateCode = $_SESSION['affiliateCode'];
        $output = fopen("php://output", "w");  
        fputcsv($output, array('Application ID', 'First Name', 'Last Name', 'Phone Number' , 'E-Mail'));  
        $query = "SELECT applicantID, firstName, lastName, phoneNumber, email from APPLICANTS WHERE affiliateCode = '$affiliateCode' ORDER BY applicantID ASC ";  
        $r = mysqli_query($connect, $query);  
        while($row = mysqli_fetch_assoc($r))  
        {  
           fputcsv($output, $row);  
        }  
        fclose($output);
    }  
?>  