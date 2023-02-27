<?php

   session_start();
   require_once '../config.php';
   include 'check_login.php';
   $result = "" ;
   $result_table="";

    $sql = "SELECT * FROM payroll";
    $result = mysqli_query($link , $sql); 
    if(mysqli_num_rows($result)>0){

      $result_table.= '
      <table class="table table-striped table-bordered table-hover table-success text-center">
      <thead>
            <tr>
                <th>YEAR</th>
                <th>MONTH</th>
                <th>FILE</th>
                <th>Action</th>
            </tr>
           </thead>';
            
      while($row = mysqli_fetch_array($result)){
          $result_table .= '<tbody>
          <tr>
           <td>'.$row['year'].'</td>
           <td>'.$row['month'].'</td>
           <td>'.$row['payroll_file'].'</td>
           <td><a href="calculate_payroll.php?file_name='.$row['payroll_file'].'">CALCULATE PAYROLL</a></td>
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
    <title>Payroll Calculate</title>
</head>
<body>

<div class="container">
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
           <h1>All Excel Files</h1>
           <?php echo $result_table; ?>
       </div>

  </div>


</div>
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>