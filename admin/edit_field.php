<?php

session_start();

require_once '../config.php';
//include 'check_login.php';
$name ="";
$name_err = $error ="";
$okay = "";
$add_id = $_GET['add_id'];

$record = mysqli_query($link, "SELECT * FROM additional_fields WHERE id= '$add_id'");


while($item = mysqli_fetch_array($record)){
    $name = $item['field'];
}

if(isset($_POST['submit'])){
   // echo 'sda';
  if(!empty($_POST['field'])){
    //echo 'sda';
    $name = $_POST['field'];
  }

  $sql = "UPDATE additional_fields set field = '$name' where id = '$add_id'";  

  if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
    }

    if (mysqli_query($link, $sql)) {
      $okay = '<div class="alert alert-success ">Successfully Updated</div>';
    } else {
      $okay = '<div class="alert alert-danger ">Failed to Updated</div>' ; 
  }
//  mysqli_close($link);

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

<form action = "" method = "post"> 
  <div class="mb-3">
    <input type="text" name = "field"class="form-control" value="<?php echo $name;?>">
  </div>  
  <input type="submit" name="submit" class="form-control btn-success" value="Update Information">
</form>

    </div>
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>