<?php
//session_start();
require_once '../config.php';
//include 'check_login.php';
$field= $field_err = $error ="";
$okay = "";
if(isset($_POST['submit'])){


    if(empty($_POST['field'])){
        $field_err  = "Please enter the field" ; 
    }
    else{
      $field = $_POST['field'];
      //$name_pattern = '/^[a-zA-Z ]+$/';

    //   if(!preg_match($name_pattern ,  $field)){
    //     $field_err  = "Please enter valid naming" ; 
    //   }else{
        $fieldquery = "select * from additional_fields where field = '$field'";
        $query = mysqli_query($link , $fieldquery);
      
        $count = mysqli_num_rows($query);
        if($count > 0 ){
          $field_err = "field already exist";
        }
     // }

    }
   
    if(empty($field_err)){
          
    $sql = "INSERT INTO additional_fields (field)values('$field')";   
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
           <h1>Additional Fields</h1>
           <span><?php echo $okay;?></span>

</div>
<form method = "post"  action="">
     <div class="mb-3">
            <input type="text" name = "field"class="form-control" placeholder="Enter the fields">
            <span class="text-danger"> <?php echo $field_err ;?></span>
        </div>

        <input type="submit" name="submit" class="form-control btn-success" value="Add">


     </form>


</div>

  
    
     <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>