<?php

session_start();
include('connection.php');

    if($_SERVER['REQUEST_METHOD'] == "POST" ){

        $first = $_POST['one'];
        $second = $_POST['two'];
        $third = $_POST['three'];
        $fourth = $_POST['four'];
        $fifth = $_POST['five'];
        $sixth = $_POST['six'];
        $seventh = $_POST['seven'];
        $eighth = $_POST['eight'];
        $date = $_POST['date'];
        $Starttime = $_POST['starttime'].":00";
        $endtime = $_POST['endtime'].":00";
       
      //echo $Starttime; die;
        
        if(!empty($date) && !empty($Starttime) && !empty($endtime)){
            $assignmentCharacters = $first.$second.$third.$fourth.$fifth.$sixth.$seventh.$eighth;
            
            $query = "INSERT INTO assignment (AssignmentCharacters,Date,StartTime,endtime) values('$assignmentCharacters','$date','$Starttime','$endtime')";
            mysqli_query($connection,$query);
            
            
            header("location: uploadpage.php");
          
           die;
        }else{
            echo "enter valid information";
        }
    
        
    }
    ?>