<?php
    session_start();
    include('functions.php');
    include('connection.php');
    $userdata = checkLogin($connection);
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KinderCare E-Assessment System</title>
    <link rel="stylesheet" href="css/newkc.css">
    <link rel="stylesheet" href="css/sidebar.css">
   
</head>

<body>
    <div class="main">
    <?php
    head_section();

    section();
    ?> <div class="body-text"> <?php
    assignment_scores();
    ?> </div>
    
</div>

<script src="app.js"></script>
<script src="try.js"></script>
</body>
<?php
    footer_section();
?>

</html>