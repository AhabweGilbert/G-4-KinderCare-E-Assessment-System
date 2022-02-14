<?php

session_start();
include('connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST" ){
                        
    
    $UserCode = $_POST['UserID'];
    $assignmentID = $_POST['AssignmentID'];
    $comment = $_POST['comment'];
    
    $query="UPDATE scores SET comment = '$comment' WHERE UserCode = '$UserCode' AND AssignmentID = '$assignmentID'";
    	
    mysqli_query($connection,$query);
    
    
    header("location: Assignments_scores.php");

          
        die;
    }
                        

?>	