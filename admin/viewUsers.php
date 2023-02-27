<?php
   session_start();
   require_once '../config.php';
   include 'check_login.php';
  //  include 'profile.php';
   $result = "" ;
   $result_table="";

    $sql = "SELECT * FROM employee";
    $result = mysqli_query($link , $sql); 
    if(mysqli_num_rows($result)>0){

      $result_table.= '
      <table class="table table-striped table-bordered table-hover table-success text-center">
      <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Photos</th>
                <th>Employee Id Code</th>
                <th>Joining Date</th>
                <th>Date of Birth</th>
                <th>Status</th>
                <th>Action1</th>
                <th>Action2</th>
                <th>Action3</th>
                <th>Action4</th>
                </tr>
           </thead>';
            
      while($row = mysqli_fetch_array($result)){
         $check_status = $row['status'];

         if($check_status == '1'){
            $check_status = 'active';
         }else{
            $check_status = 'inactive';
         }

          $result_table .= '<tbody>
          <tr>
           <td>'.$row['name'].'</td>
           <td>'.$row['email'].'</td>
           <td><img src = "../images/'.$row["photos"].'" height="100" width="100"></td>
           <td>'.$row['employee_id_code'].'</td>
           <td>'.$row['joining_date'].'</td>
           <td>'.$row['dob'].'</td>
           <td>'.$check_status.'</td>
           <td><a href="delete_employee.php?user_id='.$row['id'].'">Remove Employee</a></td>
           <td><a href="edit_employee.php?user_id='.$row['id'].'">Edit</a></td>
           <td><a href="contract.php?user_id='.$row['id'].'">Add Contract</a></td>
           <td><a href="edit_contract.php?user_id='.$row['id'].'">Edit Contract</a></td>
          </tr>
          </tbody>';
      }
      $result_table .= "</table>";
  }
  else{    
    $result_table = '<div class="alert alert-danger ">No record found</div>';
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>View Users</title>
</head>
<body>

  

<div class="container">
    <?php 
         if(isset($_SESSION['msg'])){
           echo "<h4>".$_SESSION['msg']."</h4>";
           unset($_SESSION['msg']);
         }
    ?>

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


</div>



<div class="container">
 
      <h1>User Details</h1>
      <button onclick="window.location.href = 'download_excel.php'" class="btn btn-primary" id="print-btn">Export Excel</button>
       <br><br>
      <?php echo $result_table; ?>
    
</div>
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>