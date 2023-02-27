<?php

    session_start();
    require_once '../config.php';

    include 'check_login.php';

    $month_err = $month = $year = $year_err = $result_table = $err = "";

    $emp_id  = "";
    $emp_id =  $_SESSION['emp_id'];

   // echo $emp_id;

    if(isset($_POST['submit'])){

        if(empty($_POST['year'])){
            $year_err  = "Please enter the employee status" ; 
        }
        else{
            $year = $_POST['year'];
        }
        if(empty($_POST['month'])){
            $month_err  = "Please enter the employee status" ; 
        }
        else{
            $month = $_POST['month'];
        }
    
        //echo $month , ' ' , $year;
    
         $query = "select * from payroll where month = '$month' and year = '$year'";
         $query1 = mysqli_query($link , $query);
          
         $count = mysqli_num_rows($query1);

         //echo $count;


         if($count == 0 ){
              $err = '<br><div class="alert alert-danger">no payroll calculate yet for the given month and year</div><br>';
         }
          

         if(empty($year_err) && empty($month_err) && empty($err)){
            
            $query = "SELECT * FROM payroll where month = '$month' and year = '$year'";
            $result = mysqli_query($link,  $query);
            $row = mysqli_fetch_row($result);

            $id = $row[0];

            //echo $id;



            $result = "" ;
            
            // SELECT Orders.OrderID, Customers.CustomerName
            // FROM Orders
            // INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID; 

            // "select payroll_details.pay_id , basic , house_rent , convergence , medical , 
            // working_days , tot_leave , deduction , net , field , val from payroll_details 
            // inner join additional_fields_val on payroll_details.pay_id = additional_fields_val.pay_id"; 

            // SELECT * FROM payroll_details where emp_id = '$emp_id' and pay_id = '$id'


            $sql = "SELECT payroll_details.pay_id , payroll_details.emp_id , basic , house_rent , convergence , medical , 
            working_days , tot_leave , deduction , net , field , value from additional_fields_val
            inner join payroll_details on payroll_details.pay_id = additional_fields_val.pay_id
            where payroll_details.emp_id = '$emp_id' and additional_fields_val.emp_id = '$emp_id' 
            and payroll_details.pay_id = '$id' and additional_fields_val.pay_id = '$id'";
            $result = mysqli_query($link , $sql); 


            $sql1 = "SELECT * from employee where id = '$emp_id'";
            $result1 = mysqli_query($link , $sql1); 

            while($row1 = mysqli_fetch_array($result1)){
                $name = $row1['name'];
            }



            if(mysqli_num_rows($result)>0){

            $result_table.= '
            <table class="table table-striped table-bordered table-hover table-success text-center">
            <thead>
                    <tr>
                        <th>Pay Id</th>
                        <th>Name</th>
                        <th>Emp Id</th>
                        <th>Basic</th>
                        <th>House Rent</th>
                        <th>Convergence</th>
                        <th>Medical</th>
                        <th>Working Days</th>
                        <th>Total Leave</th>
                        <th>Deduction</th>
                        <th>Net Salary</th>
                    </tr>
                </thead>';
            
            while($row = mysqli_fetch_array($result)){
                
                $result_table .= '<tbody>
                <tr>
                <td>'.$row['pay_id'].'</td>
                <td>'.$name.'</td>
                <td>'.$row['emp_id'].'</td>
                <td>'.$row['basic'].'</td>
                <td>'.$row['house_rent'].'</td>
                <td>'.$row['convergence'].'</td>
                <td>'.$row['medical'].'</td>
                <td>'.$row['working_days'].'</td>
                <td>'.$row['tot_leave'].'</td>
                <td>'.$row['deduction'].'</td>
                <td>'.$row['net'].'</td>
                </tr>
                </tbody>';
                break;
            }
                $result_table .= '</table>';


                $result = mysqli_query($link , $sql);


                $result_table.= '
                <table class="table table-striped table-bordered table-hover table-success text-center">
                <thead>
                  <tr>';
                      while($row = mysqli_fetch_array($result)){
                          $result_table .= '
                          <th>'.$row['field'].'</th>';
                      }
    
                  $result_table .= 
                    '</tr>
                  </thead>';

                  $result = mysqli_query($link , $sql);

                  $result_table.= '
                  <tbody>
                    <tr>';
                        while($row = mysqli_fetch_array($result)){
                            $result_table .= '
                            <td>'.$row['value'].'</td>';
                        }
      
                    $result_table .= 
                      '</tr>
                    </tbody>
                    
                    </table>';

                  
                $result_table .= ' <br> <br>
                <form method = "post" action="generate_pdf.php">
                <input type="hidden" name="month" value="'.$month.'">
                <input type="hidden" name="year" value="'.$year.'">
                <input type="hidden" name="id" value="'.$id.'">
                <input type="hidden" name="emp_id" value="'.$emp_id.'">
                <input type="submit" name="submit" class="form-control bg-success" value="Download">
                </form>'; 
                // $result_table .= '<a href="download_pdf.php?emp_id='.$emp_id.'&id='.$id.'">Download</a>';
            }

            else{    
                $result_table = '<div class="alert alert-danger ">No record found</div>';
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
            <?php
              //echo $emp_id;
            ?>
            <a class="nav-link" href="change_pass.php?user_id=<?php echo $emp_id;?>">Change Password</a>
            <a class="nav-link" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
</nav>

<?php echo $err; ?>

<form method="post" action="">
    <div class="mb-3">
  <label for="year">Year:</label>
  <select name="year">
  <option value="">--Select a year--</option>
    <option value="2020">2020</option>
    <option value="2021">2021</option>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
    <option value="2030">2030</option>
    <option value="2031">2031</option>
    <option value="2032">2032</option>
    <option value="2033">2033</option>
    <option value="2034">2034</option>
    <option value="2035">2035</option>
    <option value="2036">2036</option>
    <option value="2037">2037</option>
    <option value="2038">2038</option>
    <option value="2039">2039</option>
    <option value="2040">2040</option>
  </select>
  <span class="text-danger"> <?php echo $year_err ;?></span>
  </div>
  <div class="mb-3">
  <label for="month">Month:</label>
  <select name="month">
    <option value="">--Select a month--</option>
    <option value="january">January</option>
    <option value="february">February</option>
    <option value="march">March</option>
    <option value="april">April</option>
    <option value="may">May</option>
    <option value="june">June</option>
    <option value="july">July</option>
    <option value="august">August</option>
    <option value="september">September</option>
    <option value="october">October</option>
    <option value="november">November</option>
    <option value="december">December</option>
  </select>
  <span class="text-danger"> <?php echo $month_err ;?></span>
  </div>

 <br><br>
  <input type="submit" name="submit" class="form-control bg-success" value="Submit">
  <br><br>
</form>



<br><br>
<?php echo $result_table; ?>




</div>




<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>





