<?php

session_start();
require_once '../config.php';
include 'check_login.php';
$name = $email = $employee_code = $join_date = $dob = $photos= $status = "";
$name_err = $email_err = $code_err = $joindate_err = $dob_err = $image_error = $status_err = $error ="";
$okay = $password_err = $password = "";
if(isset($_POST['submit'])){
    if(empty($_POST['name'])){
        $name_err  = "Please enter the name" ; 
      }
    else{
        $name = $_POST['name'];
        $name_pattern = '/^[a-zA-Z ]+$/';
        if(!preg_match($name_pattern ,  $name)){
          $name_err  = "Please enter valid naming" ; 
        }
    }
    if(empty($_POST['email'])){
        $email_err  = "Please enter the email" ; 
    }
    else{
      $email = $_POST['email'];

      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $email_err  = "Please Enter Valid Email"; 
      }else{
        $emailquery = "select * from employee where email = '$email'";
        $query = mysqli_query($link , $emailquery);
      
        $emailcount = mysqli_num_rows($query);
        if($emailcount > 0 ){
          $email_err = "email already exist";
        }
      }

    }

    if(empty($_POST['password'])){
      $password_err  = "Please Enter Password" ; 
    }else{
      $password= md5($_POST['password']);
    }

    if(empty($_POST['empcode'])){
        $code_err  = "Please enter the employee code" ; 
    }
    else{
        $employee_code = $_POST['empcode'];
    }

    if(empty($_POST['joining_date'])){
        $joindate_err  = "Please enter the joining date" ; 
    }
    else{
        $join_date = $_POST['joining_date'];
    }

    if(empty($_POST['birthday'])){
        $dob_err  = "Please enter the employee code" ; 
    }
    else{
        $dob = $_POST['birthday'];
    }

    if(empty($_POST['status'])){
        $status_err  = "Please enter the employee status" ; 
    }
    else{
        $status = $_POST['status'];
    }
    if(!isset($_FILES['image'])){
        $image_error  = "Please Select An Image" ; 
    }
    else{

      $target_dir = "../images/";
      $img = $_FILES['image']['name'];
      $path = pathinfo($img);
      $filename = $path['filename'];
      $ext = $path['extension'];
      $temp_name = $_FILES['image']['tmp_name'];
      $path_filename_ext = $target_dir.$filename.".".$ext;
      move_uploaded_file($temp_name,$path_filename_ext);


      //  $filename=$_FILES['image']['name'];
      //  $img_loc=$_FILES['image']['tmp_name'];
      //  $file_type=$_FILES['image']['type'];
      //  $img_folder="images/".$img_loc;

      //move_uploaded_file($img_loc,$img_folder.$img);
     // move_uploaded_file($_FILES['image']['tmp_name'],'/opt/lampp/htdocs/payroll_management/images/'. $_FILES['image']['name']);
    }

    if(empty($name_err) && empty($email_err) && empty($code_err) && empty($joindate_err) && 
      empty($dob_err) && empty($image_error) && empty($status_err) && empty($password_err)){
          
        // $filename
        $sql = "INSERT INTO employee (name,email, password , photos,employee_id_code,joining_date , dob , status) 
        values('$name' , '$email ' , '$password' , '$path_filename_ext' , '$employee_code' , '$join_date' , '$dob' , '$status')";

              
       if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
        }

        if (mysqli_query($link, $sql)) {
        //  move_uploaded_file($tempname, $folder);

          $okay = '<div class="alert alert-success ">Successfully Added New Employee</div>';
        } else {
          $okay = '<div class="alert alert-danger ">Failed to Added New Employee</div>' ; 
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


<nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="profile.php">Home</a>
            <a class="nav-link" href="viewUsers.php">View Users</a>
            <a class="nav-link" href="import_files3.php">Calculate Payroll</a>
            <a class="nav-link" href="add_employee.php">Add Employee</a>
            <a class="nav-link" href="viewFields.php">View Fields</a>
            <a class="nav-link" href="additional_fields.php">Custom Field</a>
            <a class="nav-link" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
</nav>

<div>
    <h1>Add a employee</h1>
    <span><?php echo $okay;?></span>
</div>

<form method = "post" enctype="multipart/form-data"> 
  <div class="mb-3">
    <input type="text" name = "name"class="form-control" id="name" placeholder="Enter the name">
    <span class="text-danger"> <?php echo $name_err ;?></span>
  </div>
  <div class="mb-3">
    <input type="email" class="form-control" placeholder="Enter the email" id="email" name = "email">
    <span class="text-danger"> <?php echo $email_err ;?></span>
  </div>

  <div class="mb-3">
    <input type="password" placeholder = "write your password" class="form-control" name="password">
    <span class="text-danger"> <?php echo $password_err ;?></span>
  </div>


  <div class="mb-3">
  <input type="file" id="myFile" name="image">
  <span class="text-danger"> <?php echo $image_error  ;?></span>
  </div>
  <div class="mb-3">
  <input type="text" name = "empcode" class = "form-control" id="code" placeholder="Enter the employee code">
  <span class="text-danger"> <?php echo $code_err  ;?></span>

</div>

  <div class="mb-3">
  <label for="dob" class="form-label">Date Of Birth</label> 
    <input type="date" id="birthday" name="birthday">
    <span class="text-danger"> <?php echo $dob_err  ;?></span>
  </div>
  <div class="mb-3">
  <label for="" class="form-label">Joining Date</label> 
    <input type="date" id="join_date" name="joining_date">
    <span class="text-danger"> <?php echo $joindate_err  ;?></span>
  </div>

  <div class="mb-3">
  <label for="status">Status</label>
  <select name="status">
   <option value="">--Select Type--</option>
    <option value="1">Active</option>
    <option value="-1">Inactive</option>
  </select>
  <span class="text-danger"> <?php echo $status_err  ;?></span>
  </div>

  
  <input type="submit" name="submit" class="form-control btn-success" value="Add Employee">
</form>

    </div>
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>