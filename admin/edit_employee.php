<?php

session_start();


require_once '../config.php';
include 'check_login.php';
$name = $email = $employee_code = $join_date = $dob = $photos= $status = $emp_id_code = $emp_photos = "";
$name_err = $email_err = $code_err = $joindate_err = $dob_err = $image_error = $status_err = $error ="";
$okay = "";
$user_id = $_GET['user_id'];

$record = mysqli_query($link, "SELECT * FROM employee WHERE id= '$user_id'");


while($item = mysqli_fetch_array($record)){
    $name = $item['name'];
	  $email = $item['email'];
    $emp_id_code = $item['employee_id_code'];
    $join_date = $item['joining_date'];
    $dob = $item['dob'];
    $emp_photos = $item['photos'];
    $status = $item['status'];
}

//echo $emp_photos ;


if(isset($_POST['submit'])){
   
  // $filename=$_FILES['image']['name'];
  // $img_loc=$_FILES['image']['tmp_name'];
  // $img_folder="images/".$img_loc;
  // move_uploaded_file($_FILES['image']['tmp_name'],'/opt/lampp/htdocs/payroll_management/images/'. $_FILES['image']['name']);


  $target_dir = "../images/";
  $img = $_FILES['image']['name'];
  $path = pathinfo($img);
  $filename = $path['filename'];
  $ext = $path['extension'];
  $temp_name = $_FILES['image']['tmp_name'];
  $path_filename_ext = $target_dir.$filename.".".$ext;
  move_uploaded_file($temp_name,$path_filename_ext);

  $filename = $path_filename_ext ;

  if(!isset($_FILES['image'])){
    $filename  = $emp_photos ; 
  //  move_uploaded_file($_FILES[$emp_photos]['tmp_name'],'/opt/lampp/htdocs/payroll_management/images/'. $_FILES[$emp_photos]['name']);  
  }
  if(!empty($_POST['name'])){
    $name = $_POST['name'];
  }
  if(!empty($_POST['email'])){
    $email = $_POST['email'];
  }
  if(!empty($_POST['empcode'])){
    $emp_id_code  = $_POST['empcode'];
  }
  if(!empty($_POST['joining_date'])){
    $join_date = $_POST['joining_date'];
  }
  if(!empty($_POST['birthday'])){
      $dob = $_POST['birthday'];
  }
  if(!empty($_POST['status'])){
    $status = $_POST['status'];
  }

  
  $sql = "UPDATE employee set name = '$name' ,email = '$email' , 
  photos = '$filename' , employee_id_code = '$emp_id_code', joining_date = '$join_date' , 
  dob = '$dob' , status = '$status' where id = '$user_id'";  

        
  if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
    }

    if (mysqli_query($link, $sql)) {
      $okay = '<div class="alert alert-success ">Successfully Updated</div>';
    } else {
      $okay = '<div class="alert alert-danger ">Failed to Updated</div>' ; 
  }
 mysqli_close($link);

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
    <h1>Update Employee Information</h1>
    <span><?php echo $okay;?></span>
</div>

<form method = "post" enctype="multipart/form-data"> 
  <div class="mb-3">
    <input type="text" name = "name"class="form-control" value="<?php echo $name; ?>">
  </div>
  <div class="mb-3">
    <input type="email" class="form-control" name = "email" value="<?php echo $email; ?>">
  </div>

  <div class="mb-3">
  <img src = "../images/<?php echo $emp_photos; ?>" height="100" width="100">
  <input type="file" id="myFile" name="image">
  </div>
  <div class="mb-3">
  <input type="text" name = "empcode" class = "form-control" value="<?php echo $emp_id_code; ?>">
</div>

  <div class="mb-3">
  <label for="dob" class="form-label">Date Of Birth</label> 
    <input type="date" class = "form-control" name="birthday" value="<?php echo $dob; ?>">
  </div>
  <div class="mb-3">
  <label for="" class="form-label">Joining Date</label> 
    <input type="date" class = "form-control" name="joining_date" value="<?php echo $join_date; ?>">
  </div>
  <div class="mb-3">
  <label for="status">Status</label>
  <select name="status">

   <?php
       if($status == 1){
          echo '<option value="1">Active</option>';
          echo '<option value="-1">Inactive</option>';
       }else{
          echo'<option value="-1">Inactive</option>';
          echo '<option value="1">Active</option>';
       }
   ?>

  </select>
  <span class="text-danger"> <?php echo $status_err  ;?></span>
  </div>

  
  <input type="submit" name="submit" class="form-control btn-success" value="Update Information">
</form>

    </div>
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>