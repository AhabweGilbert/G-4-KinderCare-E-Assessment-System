<?php
session_start();
include('connection.php');  //Database connection
include('functions.php');


if($_SERVER['REQUEST_METHOD'] == "POST"){

    $TIN = $_POST['teacherID'];
    $Name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if(!empty($TIN) && !empty($Name) && !empty($password) && !empty($email)){
        $query1= "select TIN FROM teacher where TIN = '$TIN'";
        $result1 = mysqli_query($connection,$query1);
        if($result1->num_rows>0){ 

                $query = "UPDATE teacher SET password='$password' WHERE TIN = '$TIN'";
                $query2 = "UPDATE teacher SET email='$email' WHERE TIN = '$TIN'";
                $result = mysqli_query($connection,$query);
                $result2 = mysqli_query($connection,$query2);
                    header("location: login.php");
                    die;
        } else{
            echo " You are not a teacher of this school";
        }
        
    }else{
        echo "enter information in both fields";
    }

}

?>
<html>
    <head>
        <title>KEAS Teacher's Signup</title>
        
        <link rel="stylesheet" href="css/new.css">
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
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">SignUp</h3></div>
                        <form action="" method = "POST" class="form-control">
                            <label>Teacher Identification Number</label><br>
                            <input type="text" placeHolder = "TIN" name = "teacherID"><br><br>
                            <label>Name</label><br>
                            <input type="text" placeHolder = "name" name = "name"><br><br>
                            <label>E-mail</label><br>
                            <input type="email" placeHolder = "email" name = "email"><br><br>
                            <label>Password</label><br>
                            <input type="text" placeHolder = "password"  name = "password"><br><br>
                            <button type = "submit" class="btn btn-primary">Signup</button><br><br>
                            <div class="card-footer">
                            <a href="login.php">Have an account? Login</a>
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
</html>