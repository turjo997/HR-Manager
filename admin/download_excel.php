<?php
   require_once '../config.php';

  
     header('Content-Type:application/xls');
     header('Content-Disposition:attachment;filename=export.xls');
       
   $result = "" ;
   $result_table="";
   $result_table1 = "";

   //$user_id = $_GET['user_id'];
   //$sql = "SELECT * FROM contract where emp_id = $user_id";
    $sql = "SELECT * FROM contract";

    $result = mysqli_query($link , $sql); 


    $sql1 = "SELECT * FROM additional_fields";

    $result1 = mysqli_query($link , $sql1); 

//   if(mysqli_num_rows($result1)>0){

//     $result_table1.= '
//     <table class="table table-striped table-bordered table-hover table-success text-center">
//     <thead>
//           <tr>
//               <th>Name</th>
//           </tr>
//          </thead>';
          
//     while($row = mysqli_fetch_array($result1)){
//         $result_table1 .= '<tbody>
//         <tr>
//          <td>'.$row['field'].'</td>
//         </tr>
//         </tbody>';
//     }
//     $result_table1 .= '</table>';
// }


    if(mysqli_num_rows($result)>0){

      $result_table.='
      <table class="table table-striped table-bordered table-hover table-success text-center">
      <thead>
            <tr>
                <th>Employee Id</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Gross Salary</th>
                <th>Basic</th>
                <th>House Rent</th>
                <th>Convergence</th>
                <th>Medical</th>
                <th>Start Probation Date</th>
                <th>End Probation Date</th>
                <th>Working Days</th>
                <th>Total leave</th>
                <th>Deduction Money</th>';
                if(mysqli_num_rows($result1)>0){
                while($row = mysqli_fetch_array($result1)){
                    $result_table .= '
                     <th>'.$row['field'].'</th>';
                }
            }
                $result_table.='
                <th>Net Salary</th>
            </tr>
           </thead>';
         
        
      while($row = mysqli_fetch_array($result)){
          $result_table .= '
          <tbody>
          <tr>
           <td>'.$row['emp_id'].'</td>
           <td>'.$row['start_date'].'</td>
           <td>'.$row['end_date'].'</td>
           <td>'.$row['gross_salary'].'</td>
           <td>'.$row['basic'].'</td>
           <td>'.$row['house_rent'].'</td>
           <td>'.$row['convergence'].'</td>
           <td>'.$row['medical'].'</td>
           <td>'.$row['probation_start_date'].'</td>
           <td>'.$row['probation_end_date'].'</td>
           <td>0</td>
           <td>0</td>
           <td>0</td>';

           $sql1 = "SELECT * FROM additional_fields";
           $result1 = mysqli_query($link , $sql1); 
           if(mysqli_num_rows($result1)>0){
            while($row = mysqli_fetch_array($result1)){
                $result_table .= '<td>0</td>';
            }
        }
    
      }
     

   $result_table.= '
   </tr>
   </tbody>';
      
  $result_table .= '</table>';
  }
  else{    
    $result_table = '<div class="alert alert-danger">No record found</div>';
  }

          //  <td>'.$row['emp_id'].'</td>
          //  <td>'.$row['start_date'].'</td>
          //  <td>'.$row['end_date'].' </td>
          //  <td>'.$row['gross_salary'].' </td>
          //  <td>'.$row['basic'].'</td>
          //  <td>'.$row['house_rent'].'</td>
          //  <td>'.$row['convergence'].'</td>
          //  <td>'.$row['medical'].'</td>
          //  <td>'.$row['probation_start_date'].' </td>
          //  <td>'.$row['probation_end_date'].' </td>
          //  <td>'.$row['working_days'].' </td>
          //  <td>'.$row['total_leave'].' </td>
          //  <td>'.$row['deduction'].' </td>
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

    <?php echo $result_table?>
       
       
    
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>