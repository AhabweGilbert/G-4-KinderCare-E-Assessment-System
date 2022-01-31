<?php

session_start();
include('connection.php');

    if($_SERVER['REQUEST_METHOD'] == "POST" ){

        $userCode = $_POST['userCode'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $Pnumber = $_POST['Pnumber'];
        
        if(!empty($userCode) && !empty($firstname) && !empty($lastname) && !empty($Pnumber)){
           
            $query = "INSERT INTO pupils (UserCode,FirstName,LastName,TelephoneNo) values('$userCode','$firstname','$lastname','$Pnumber')";
            mysqli_query($connection,$query);
            
            header("location: registerpage.php");
          
           die;
        }else{
            echo "enter valid information";
        }
    
        
    }
    ?>