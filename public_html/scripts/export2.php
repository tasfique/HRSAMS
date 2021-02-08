<?php
    if(isset($_POST["export"]))  
    {  
        include("connection.php");
	    // CREATE CONNECTION
        $connect = new mysqli($servername, $username, $password, $dbname);
        // ob_start();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=full_table.csv');
        // ob_end_clean();
        $output = fopen("php://output", "w");  
        fputcsv($output, array('Application ID', 'Picture Name', 'File Name', 'Affiliate Code', 'Date of Application', 'Passport No/ IC', 'First Name' , 'Last Name' , 
        'Gender' ,'DOB' ,'Nationality' ,'Language Skills' ,'Position Category' ,'Position Title' ,'Payment ID' ,'Date Of Submission' ,
        'Customer Type' ,'Phone Number' ,'E-Mail' ,'Current Address' , 'Postal Code (C)' , 'Area (C)' , 'State (C)' ,
        'Country (C)' , 'Permanent Address' , 'Postal Code (P)' , 'Area (P)' , 'State (P)' , 'Country (P)' ,
        'Application Status' , 'Visa Status' , 'Missing Documents List' , 'Missing Documents Others' , 'Date of Enrolment' , 
        'Date of Graduation' , 'Education Type (Highest)' , 'Education Type Others' , 'Education Title' , 'Instituition Name' , 'Remarks'));  
        $query = "SELECT * from APPLICANTS ORDER BY applicantID ASC";  
        $r = mysqli_query($connect, $query);  
        while($row = mysqli_fetch_assoc($r))  
        {  
           fputcsv($output, $row);  
        }  
        fclose($output);  
    }  
?>  