<?php

session_start();
include('connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST" ){
                        
    $RegisterID = $_POST['RegisterID'];
    $UserCode = $_POST['UserCode'];
    
    $query="UPDATE pupils SET status1 = 'Activated' WHERE UserCode = '$UserCode'";
    $query1="DELETE FROM activationrequests WHERE UserCode = '$RegisterID'";	
    mysqli_query($connection,$query);
    mysqli_query($connection,$query1);
    
    header("location: viewRequestpage.php");

          
        die;
    }
                        

?>	