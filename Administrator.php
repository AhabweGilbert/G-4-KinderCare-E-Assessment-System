<?php
session_start();
include('connection.php');  //Database connection
include('functions.php');


if($_SERVER['REQUEST_METHOD'] == "POST"){

    $TIN = $_POST['teacherID'];
    $Name = $_POST['name'];
   
    if(!empty($TIN) && !empty($Name) ){

        $query = "INSERT INTO Teacher (TIN, Name) values('$TIN','$Name')";
        mysqli_query($connection,$query);
        header("location: Administrator.php");
        die;
    }else{
        echo "Enter information in all fields";
    }

}
?>
<html>
    <head>
        <title>KEAS Administators' Page</title>
        
        <link rel="stylesheet" href="css/new.css">
        <link rel="stylesheet" href="css/sidebar.css">
    </head>

    <body>
    
    <div class="main">
        <div style="background-color: #A3E4DB; height: 10%;">
    <?php
    head_section();
    ?>
    </div>
        
       <div class="container">
            <div class="row justify-content-center"> 
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                    
                        <div class="card-body" style="text-align: center; font-size: 150%;">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Register Teacher</h3></div>
                        <form action="" method = "POST" class="form-control">
                            <label>Teacher Identification Number</label><br>
                            <input type="text" placeHolder = "TIN" name = "teacherID"><br><br>
                            <label>Name</label><br>
                            <input type="text" placeHolder = "name" name = "name"><br><br>
                            <button type = "submit" class="btn btn-primary">AddTeacher</button><br><br>
                            <div class="card-footer">
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
    </body>
   <footer style=" position: fixed; left: 0; bottom: 0; width: 100%; background-color: white; color: black; text-align: center;">
    <?php
    footer_section();
?>
</footer>
	
</html>