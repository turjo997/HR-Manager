<?php
require_once '../config.php';
$name = $email = "";
$name_err = $email_err = $error = $password_err = $password= "";

session_start();
$_SESSION['emp_id'] = "";

//if(empty($_SESSION['id'])){
  if(isset($_POST['submit'])){
     
    if(empty($_POST['name'])){
      $name_err  = "Please enter your name" ; 
    }else{
      $name = $_POST['name'];
    }

    if(empty($_POST['password'])){
      $password_err  = "Please Enter Password" ; 
    }else{
      $password= md5($_POST['password']);
    }
  
    // if(empty($_POST['email'])){
    //   $email_err  = "Please enter your email" ; 
    // }else{
    //   $email= $_POST['email'];
    // }
    if(empty($name_err) && empty($password_err)){
         
      $sql = "SELECT * FROM employee where name = '$name' and  password = '$password'";
  
      $result = mysqli_query($link , $sql);
      
      if(mysqli_num_rows($result)>0){

        $row = mysqli_fetch_assoc($result);

        $status = $row['status'];

        if($status == "1"){
          $_SESSION['emp_id'] = $row['id'];
         // echo $_SESSION['emp_id'] ;
          header('Location: profile.php');
        }
        else{
          $error = "You are currently inactive";
        }
  
      }

      else{
        $error = "Invalid login credentials";
      }
    }
  
  //}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    
    <title>User Panel</title>
</head>
<body>

<div class="container">

<div>
<h1>User Panel</h1>
<span class="text-danger"> <?php echo $error;?></span>
</div>

<form method="post" action="">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" placeholder="write your name" class="form-control" name="name">
    <span class="text-danger"> <?php echo $name_err ;?></span>

  </div>

  <div class="mb-3">
    <input type="password" placeholder = "write your password" class="form-control" name="password">
    <span class="text-danger"> <?php echo $password_err ;?></span>
  </div>


  <!-- <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" placeholder = "write your email" class="form-control" name="email">
    <span class="text-danger"> <?php echo $email_err ;?></span>
  </div> -->


  <input type="submit" name="submit" class="form-control bg-success" value="Login">
                  
      
   
</form>

</div>
    

<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>