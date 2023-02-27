<?php
require_once '../config.php';
$username = $password = "";
$username_err = $password_err = $error = "";

session_start();
$_SESSION['id'] = "";

if(empty($_SESSION['id'])){

  //echo 'ki je hbe';
  if(isset($_POST['submit'])){
     
    if(empty($_POST['username'])){
      $username_err  = "Please Enter Username" ; 
    }else{
      $username = $_POST['username'];
    }
  
    if(empty($_POST['password'])){
      $password_err  = "Please Enter Password" ; 
    }else{
      $password= md5($_POST['password']);
    }
    if(empty($username_err) && empty($password_err)){
         
      $sql = "SELECT * FROM admin where username = '$username' and  password = '$password'";
  
      $result = mysqli_query($link , $sql);


      if(mysqli_num_rows($result)>0){

          $row = mysqli_fetch_assoc($result);
          $_SESSION['id'] = $row['id'];
          
          //echo "ami valo" ;
          header('Location: profile.php');
      }

      else{
        $error = "Invalid login credentials";
      }
      
    }
    

  
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
    
    <title>Admin Panel</title>
</head>
<body>

<div class="container">

<div>
<h1>Admin Panel</h1>
<span class="text-danger"> <?php echo $error;?></span>
</div>

<form method="post" action="">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">User Name</label>
    <input type="text" placeholder="write your username" class="form-control" name="username">
    <span class="text-danger"> <?php echo $username_err ;?></span>

  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" placeholder = "write your password" class="form-control" name="password">
    <span class="text-danger"> <?php echo $password_err ;?></span>
  </div>


  <input type="submit" name="submit" class="form-control bg-success" value="Login">
                  
        

   
</form>

</div>
    

<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>