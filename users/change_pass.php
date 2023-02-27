<?php
session_start();
require_once '../config.php';
include 'check_login.php';


$id = $_GET['user_id'];

$status = "";
$error ="";
$okay = $password_err = $password = "";


if(isset($_POST['submit'])){

   $record = mysqli_query($link, "SELECT * FROM employee WHERE id= '$id'");


    if(empty($_POST['password'])){
      $password_err  = "Please Enter Password" ; 
    }else{
      $password= md5($_POST['password']);
    }

    if(empty($password_err)){ 
    
    $sql = "UPDATE employee set password = '$password' where id = '$id'";  
              
       if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
        }

        if (mysqli_query($link, $sql)) {
        //  move_uploaded_file($tempname, $folder);

          $okay = '<div class="alert alert-success ">Successfully Updated Password</div>';
        } else {
          $okay = '<div class="alert alert-danger ">Failed to updated</div>' ; 
       }
       mysqli_close($link);

    }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="container">

<div>
    <h1>Change Password</h1>
    <span><?php echo $okay;?></span>
</div>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="profile.php">Home</a>
            <?php
              //echo $emp_id;
            ?>
            <a class="nav-link" href="change_pass.php?user_id=<?php echo $emp_id;?>">Change Password</a>
            <a class="nav-link" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
</nav>


<form method = "post" enctype="multipart/form-data"> 
  

  <div class="mb-3">
    <input type="password" placeholder = "write your password" class="form-control" name="password">
    <span class="text-danger"> <?php echo $password_err ;?></span>
  </div>
  
  <input type="submit" name="submit" class="form-control btn-success" value="Update">
</form>

    </div>
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>