<?php

   session_start();
   require_once '../config.php';
   //include 'check_login.php';
   $result = "" ;
   $result_table="";

    $sql = "SELECT * FROM additional_fields";
    $result = mysqli_query($link , $sql); 
    if(mysqli_num_rows($result)>0){

      $result_table.= '
      <table class="table table-striped table-bordered table-hover table-success text-center">
      <thead>
            <tr>
                <th>Field Name</th>
                <th>Action1</th>
                <th>Action2</th>
            </tr>
           </thead>';
            
      while($row = mysqli_fetch_array($result)){
        
          $result_table .= '<tbody>
          <tr>
           <td>'.$row['field'].'</td>
           <td><a href="edit_field.php?add_id='.$row['id'].'">Edit</a></td>
           <td><a href="delete_field.php?id='.$row['id'].'">Remove</a></td>
          </tr>
          </tbody>';
      }
      $result_table .= '</table>';
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
    <title>View Fields</title>
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


    <?php 
         if(isset($_SESSION['msg'])){
           echo "<h4>".$_SESSION['msg']."</h4>";
           unset($_SESSION['msg']);
         }
    ?>
</div>


<div class="row">
      <div class="col-lg-2">
 
      </div>
    
       <div class="col-lg-8">
           <h1>View Fields</h1>
           <?php echo $result_table; ?>
       </div>
  </div>


</div>
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>