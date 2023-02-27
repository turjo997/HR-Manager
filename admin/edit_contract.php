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
$query = "SELECT * FROM contract where emp_id = '$user_id'";
$result_rows = mysqli_query($link , $query);
$result_rows = mysqli_num_rows($result_rows);



$record = mysqli_query($link, "SELECT * FROM contract where emp_id = '$user_id'");
$sdate_text = $edate_text = $psdate_text = $pedate_text = $gs_text = ""; 
$basic_text = $house_text = $convergence_text = $medical_text = "";


while($item = mysqli_fetch_array($record)){
    $sdate_text = $item['start_date'];
	  $edate_text = $item['end_date'];
    $psdate_text = $item['probation_start_date'];
    $pedate_text = $item['probation_end_date'];
    $gs_text = $item['gross_salary'];

    $basic_text = $item['basic'];
    $house_text = $item['house_rent'];
    $convergence_text = $item['convergence'];
    $medical_text = $item['medical'];
}



if(isset($_POST['submit'])){
    if(!empty($_POST['start_date'])){
      $sdate_text = $_POST['start_date']; 
      }
  
    if(!empty($_POST['end_date'])){
      $edate_text = $_POST['end_date'];
    }

    if(!empty($_POST['prob_start_date'])){
      $psdate_text = $_POST['prob_start_date']; 
      }
    
    if(!empty($_POST['prob_end_date'])){
      $pedate_text = $_POST['prob_end_date'];
      }
   
    if(!empty($_POST['salary'])){
      $gs_text  = $_POST['salary'];

      $basic_text = $gs_text * 0.6;
      $house_text = $gs_text * 0.2;
      $convergence_text = $gs_text * 0.1;
      $medical_text = $gs_text * 0.1;
      }
  

    $employee_id = $user_id;

    if($result_rows < 1){
        $okay = '<div class="alert alert-danger ">Please add the new contract</div>' ;
    }

    else if($result_rows > 0 && empty($start_date_err) && empty($gross_salary_err) && empty($prob_end_date_err) && empty($prob_start_date_err)){
     
      $sql = "UPDATE contract set start_date = '$sdate_text' ,end_date = '$edate_text' , 
      gross_salary = '$gs_text ' , probation_start_date = '$psdate_text', 
      probation_end_date = '$pedate_text' , basic = '$basic_text' , house_rent = '$house_text' , 
      convergence = '$convergence_text' , 
      medical = '$medical_text'
      where emp_id = '$employee_id'";  

            
     if (!$link) {
      die("Connection failed: " . mysqli_connect_error());
      }

      if (mysqli_query($link, $sql)) {
        $okay = '<div class="alert alert-success ">Successfully Updated Contract</div>';
      } else {
        $okay = '<div class="alert alert-danger ">Failed to Updated Contract</div>' ; 
     }
     mysqli_close($link);
  }else{

    $okay = '<div class="alert alert-danger ">Please fill up the fields</div>' ; 
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
    <h1>Edit Contract</h1>
    <span><?php echo $okay;?></span>

</div>

<form method = "post" enctype="multipart/form-data"> 

<div class="mb-3">
  <label for="" class="form-label">Start Date</label> 
    <input type="date" name="start_date" value = "<?php echo $sdate_text; ?>">
  </div>
  <div class="mb-3">
  <label for="" class="form-label">End Date</label> 
    <input type="date" value = "<?php echo $edate_text; ?>" name="end_date">
  </div>

  <div class="mb-3">
    <h4>Gross Salary</h4>
    <input id = "gs" type="text" name = "salary" class="form-control" value = "<?php echo $gs_text; ?>">
  </div>

  <div class="mb-3">
    <label for="" class="form-label">Basic Salary</label> 
    <input id = "basic" type="text" value="<?php echo $basic_text; ?>" placeholder = "" class="form-control" disabled>
    
    <label for="" class="form-label">House Rent</label>  
    <input id = "house_rent" type="text" value="<?php echo $house_text; ?>" placeholder = "" class="form-control" disabled>
  
    <label for="" class="form-label">Medical Allowance</label> 
    <input id = "medical" type="text" value="<?php echo $medical_text; ?>" placeholder = "" class="form-control" disabled>

    <label for="" class="form-label">Convergence</label> 
    <input id = "convergence" type="text" value="<?php echo $convergence_text ?>" placeholder = "" class="form-control" disabled>
  </div>



<div class="mb-3">
    <h4>Probation Period</h4>
    <label for="" class="form-label">Probation Start Date</label> 
    <input type="date" value = "<?php echo $psdate_text?>" name="prob_start_date">
    &nbsp; &nbsp; &nbsp;
    <label for="" class="form-label">Probation End Date</label> 
    <input type="date" value = "<?php echo $pedate_text; ?>" name="prob_end_date">
</div>

  
  <input type="submit" name="submit" class="form-control btn-success" value="Update">
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
