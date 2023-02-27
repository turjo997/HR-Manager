<?php
//$val = $_GET['id'];
//$val = print_r($_GET);

session_start();
require_once '../config.php';
include 'check_login.php';

$employee_id = $start_date = $end_date = $prob_start_date = $prob_end_date = "";
$start_date_err = $prob_start_date_err = $prob_end_date_err = $gross_salary_err= $error ="";
$basic_sal = $house_rent = $convergence = $medical = "";
$okay = "";
$gross_salary = 0;

$user_id = $_GET['user_id'];

if(isset($_POST['submit'])){
    if(empty($_POST['start_date'])){
        $start_date_err  = "Please select the date" ; 
      }
    else{
        $start_date = $_POST['start_date'];
    }

    if(empty($_POST['end_date'])){
        $end_date = "";
    }else{
    $end_date = $_POST['end_date'];
    }


    if(empty($_POST['prob_start_date'])){
        $prob_start_date_err  = "Please select the date" ; 
      }
    else{
        $prob_start_date = $_POST['prob_start_date'];
    }


    if(empty($_POST['prob_end_date'])){
        $prob_end_date_err  = "Please select the date" ; 
      }
    else{
        $prob_end_date= $_POST['prob_end_date'];
    }
    if(empty($_POST['salary'])){
        $gross_salary_err  = "Please enter the salary" ; 
      }
    else{
        $gross_salary = $_POST['salary'];
        if($gross_salary <= 0){
          $gross_salary_err = "Salary can not be negative" ; 
        }
    }

    //echo $gross_salary_err ; 
      $basic_sal = $gross_salary * 0.6;
      $house_rent = $gross_salary * 0.2;
      $convergence = $gross_salary * 0.1;
      $medical = $gross_salary * 0.1;

      // $basic_sal = "0";
      // $house_rent = "0";
      // $convergence = "0";
      // $medical = "0";
      
      $working_days = "0";
      $total_leave = "0";
      $deduction = "0";
      $net_salary = "0";
    
      $employee_id = $user_id;

    if(empty($start_date_err) && empty($gross_salary_err) && empty($prob_end_date_err) && empty($prob_start_date_err)){

    $sql = "INSERT INTO contract (emp_id , start_date , end_date , gross_salary , basic , house_rent , convergence , medical , probation_start_date , probation_end_date , working_days , total_leave , deduction , net_salary) values('$employee_id' , '$start_date' , '$end_date' , '$gross_salary' , '$basic_sal' , '$house_rent' , '$convergence' , '$medical' , '$prob_start_date' ,'$prob_end_date' , '$working_days' ,'$total_leave' , '$deduction' ,'$net_salary')";

            
     if (!$link) {
      die("Connection failed: " . mysqli_connect_error());
      }

      if (mysqli_query($link, $sql)) {
        $okay = '<div class="alert alert-success ">Successfully Added Contract</div>';
      } else {
        $okay = '<div class="alert alert-danger ">Failed to Added Contract</div>' ; 
     }
     mysqli_close($link);
  }else{

    $okay = '<div class="alert alert-danger ">Some error occured</div>' ; 
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

<div>
    <h1>Add Contract</h1>
    <span><?php echo $okay;?></span>

</div>

<form method = "post" enctype="multipart/form-data"> 

<div class="mb-3">
  <label for="" class="form-label">Start Date</label> 
    <input type="date" name="start_date">
    <span class="text-danger"> <?php echo $start_date_err ;?></span>
  </div>
  <div class="mb-3">
  <label for="" class="form-label">End Date</label> 
    <input type="date" name="end_date">
  </div>

  <div class="mb-3">
    <h4>Gross Salary</h4>
    <input type="text" id = "gs" name = "salary" class="form-control" placeholder="Enter the gross salary">
    <span class="text-danger"> <?php echo $gross_salary_err ;?></span>
  </div>

  <div class="mb-3">
    <label for="" class="form-label">Basic Salary</label> 
    <input id = "basic" type="text" placeholder = "" class="form-control" disabled>
    
    <label for="" class="form-label">House Rent</label>  
    <input id = "house_rent" type="text" placeholder = "" class="form-control" disabled>
  
    <label for="" class="form-label">Medical Allowance</label> 
    <input id = "medical" type="text" placeholder = "" class="form-control" disabled>

    <label for="" class="form-label">Convergence</label> 
    <input id = "convergence" type="text" placeholder = "" class="form-control" disabled>
  </div>

  <div class="mb-3">
      <h4>Probation Period</h4>
      <label for="" class="form-label">Probation Start Date</label> 
      <input type="date" name="prob_start_date">
      <span class="text-danger"> <?php echo $prob_start_date_err ;?></span>

      &nbsp; &nbsp; &nbsp;
      <label for="" class="form-label">Probation End Date</label> 
      <input type="date" name="prob_end_date">
      <span class="text-danger"> <?php echo $prob_end_date_err ;?></span>
  </div>

  
  <input type="submit" name="submit" class="form-control btn-success" value="Add">
</form>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script>

      $("#gs").on("keyup", function(){
        var basic = $(this).val() * 0.6;
        var house_rent = $(this).val() * 0.2;
        var medical = $(this).val() * 0.1;
        var convergence = $(this).val() * 0.1;
        $("#basic").val(basic);
        $("#house_rent").val(house_rent);
        $("#medical").val(medical);
        $("#convergence").val(convergence);
      });


    </script>

<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>