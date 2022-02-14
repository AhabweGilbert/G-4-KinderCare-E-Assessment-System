<?php 
session_start();

include('connection.php');
include('functions.php');


if($_SERVER['REQUEST_METHOD'] == "POST"){

    $TIN = $_POST['teacherID'];
    $password = $_POST['password'];

    if(!empty($TIN) && !empty($password)){

        $query = "SELECT * from Teacher where TIN = '$TIN' limit 1";
        $result = mysqli_query($connection,$query);
        
       if($result){
            if($result && mysqli_num_rows($result)>0){

                $userdata = mysqli_fetch_assoc($result);
                
                if($userdata['password'] === $password){

                    
                    $_SESSION['TIN'] = $userdata['TIN'];
                    $_SESSION['Name'] = $userdata['Name'];
                   
                    header("location: index.php");
                    die;
                }else{
                    echo "enter a valid username or password";
                }

            }
       }

        
    }else{
        echo "enter information in both fields";
    }

}


?>
<html>
    <head>
        <title>
            Login
        </title>
        
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
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                        <form action="" method = "POST" class="form-control">
                            <label>Teacher Identification Number</label><br>
                            <input type="text" placeHolder = "TIN" name = "teacherID"><br><br>
                            <label>Password</label><br>
                            <input type="text" placeHolder = "password"  name = "password"><br><br>
                            <button type = "submit" class="btn btn-primary">Login</button><br><br>
                            <div class="card-footer">
                            <a href="forgottenpassword.php">Forgot password?</a>
                            <a href="signup.php">Have no account? Signup</a>
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