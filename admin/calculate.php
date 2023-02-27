<?php
     require_once '../config.php';
     session_start();
     include 'check_login.php';
  
     require_once "../Classes/PHPExcel.php";
  
     $year = $year_err = $err  = $month_err = $month = $okay = "";

     if(isset($_POST['submit'])){
        if(empty($_POST['month'])){
            $month_err  = "Please enter the month" ; 
          }
        else{
            $month = $_POST['month'];
        }
        if(empty($_POST['year'])){
            $year_err  = "Please enter the year" ; 
        }
        else{
          $year = $_POST['year'];
        }

        $query = "select * from payroll where month = '$month' and year = '$year'";
        $query1 = mysqli_query($link , $query);
      
        $count = mysqli_num_rows($query1);
        if($count > 0 ){
          $err = "payroll already exist";
        }
      
       
    

    
        if(empty($err) && empty($name_err) && empty($email_err)){
              
            
            $sql = "INSERT INTO payroll (month , year) 
            values('$month' , '$year ')";
    
                  
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
<html>
  <head>
    <link
     href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../styles/styles2.css">
    <title>popup2</title>
  </head>
  <body>

  <div>
  <span><?php echo $okay;?></span>
  </div>

  <form method="post" action="" enctype="multipart/form-data">
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


  <input type="submit" name="submit" class="form-control bg-success" value="next">
   
</form>
  </body>
   
</html>


