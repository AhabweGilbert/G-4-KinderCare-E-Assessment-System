<?php

session_start();
include('connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST" ){
                        
    
    $UserCode = $_POST['UserCode'];
    
    $query="UPDATE pupils SET status1 = 'Deactivated' WHERE UserCode = '$UserCode'";
    	
    mysqli_query($connection,$query);
    
    
    header("location: deactivatepage.php");

          
        die;
    }
                        

?>	