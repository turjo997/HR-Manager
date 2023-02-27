<?php
session_start();
require_once '../config.php';

include 'check_login.php';
$file_base_dir = trim(str_replace("admin","",__DIR__));
//require_once "../Classes/PHPExcel.php";
include_once($file_base_dir.'Classes/PHPExcel.php');

//include 'PHPExcel/';
  
$year = $year_err = $err = $month_err = $month = $filename  = $file_err =  $okay  = $file = "";

$result_table = "";

$payrollCAL = array();
     
?>

<!DOCTYPE html>
<html>
  <head>
    <link
     href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'
      rel="stylesheet"/>
    <link rel="stylesheet" href="../styles/styles2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>popup2</title>
  </head>
  <body>

  <div>
  <span><?php echo $okay;?></span>
  </div>

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

  <div class="mb-3">
   <input type="file" id="myFile" name="excelFILE">
   <span class="text-danger"> <?php echo $file_err ;?></span>
  </div>
  <input type="submit" name="submit" class="form-control bg-success" value="Submit">
   
</form>


<?php

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

    if(!isset($_FILES['excelFILE'])){
        $file_err  = "Please Select A Excel File" ; 
    }else{
        $file = $_FILES['excelFILE']['name'];
        move_uploaded_file($_FILES['excelFILE']['tmp_name'],$file_base_dir.'images/'. $_FILES['excelFILE']['name']);
     }


     $query = "select * from payroll where month = '$month' and year = '$year'";
     $query1 = mysqli_query($link , $query);
      
     $count = mysqli_num_rows($query1);
     if($count > 0 ){
       $err = "payroll already exist";
     }
      

     if(empty($err) && empty($month_err) && empty($year_err) && empty($file_err)){
      $PATH = $file_base_dir."images/".$file;
      
      //$inputFileType = PHPExcel_IOFactory::identify($PATH);
      //$reader = PHPExcel_IOFactory::createReader($inputFileType);
      
      $reader = PHPExcel_IOFactory::createReaderForFile($PATH);
      $excel_obj = $reader->load($PATH);
      $worksheet = $excel_obj->getSheet('0');
      $lastrow = $worksheet->getHighestRow();
      $columncount = $worksheet->getHighestColumn();
      $columncount_number = PHPExcel_Cell::columnIndexFromString($columncount);

      $query = "SELECT MAX(id) FROM payroll";
      $result = mysqli_query($link,  $query);
      $row = mysqli_fetch_row($result);
      
      $result_table.= '<table class="table table-striped table-bordered table-hover table-success text-center">';
      $result_table.= '<input type="hidden" name="pay_id" value="'.$row[0].'">';
      $result_table.= '<input type="hidden" name="month" value="'.$month.'">';
      $result_table.= '<input type="hidden" name="year" value="'.$year.'">';
      $result_table.= '<input type="hidden" name="filename" value="'.$file.'">';
      $result_table.= '<input type="hidden" name="dir" value="'.$PATH.'">';

        for($row = 0; $row <= $lastrow ; $row++){
            $result_table.= '<tr>';
            $net = $GS = $leave =  "" ; 
           for($col = 0; $col < $columncount_number-1 ; $col++){
            $result_table.= '<td>';
              if($row > 1 && $col == 0){
                 $emp_id  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0).$row)->getValue();
                 $start_date  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(1).$row)->getValue();
                 $end_date  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(2).$row)->getValue();
                 $GS = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(3).$row)->getValue();
                 $basic  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(4).$row)->getValue();
                 $house_rent  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(5).$row)->getValue();
                 $convergence  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(6).$row)->getValue();
                 $medical  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(7).$row)->getValue();
                 $p_s_date = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(8).$row)->getValue();
                 $p_e_date = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(9).$row)->getValue();
                 $working_days  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(10).$row)->getValue();
                 $tot_leave  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(11).$row)->getValue();
                 $deduction  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(12).$row)->getValue();
                 $deduction= round($deduction, 2);

                 //echo $deduction , ' ';
                // $days = 30;
                // $x = (int)$GS * (int)$leave;
                // $net = (int)$GS - ((int)$x / (int)$days);

                $basic_check = (int)$GS * 0.6;
                $house_rent_check = (int)$GS * 0.2;
                $medical_check = (int)$GS * 0.1;
                $convergence_check = (int)$GS * 0.1;

                if($working_days > 0){
                  $deduction_check = ((int)$GS * (int)$tot_leave) / (int)$working_days;
                
                  $deduction_check = round($deduction_check, 2);

                //   echo $deduction_check , ' ';


                //    if($deduction_check ==  $deduction){
                //   echo 'true';
                // }else{
                //   echo 'false';
                // }
                }else{
                  $deduction_check = 0;

                }

            if(($basic > 0 && $GS > 0 && $house_rent > 0 && $convergence > 0 && $medical > 0 && $tot_leave >= 0
              && $deduction >= 0) && ((int)$GS == (int)$basic + (int)$house_rent + (int)$convergence + (int)$medical
              && ($basic_check == $basic) && ($house_rent_check == $house_rent) && ($medical_check == $medical) 
              && ($working_days >= 30 && $working_days <= 31) &&($convergence_check == $convergence) && ($deduction_check==$deduction))){
            
                $result_table.= '<input type="checkbox" name="payrollCAL[]" value="'.$emp_id.'">  ';
                $result_table.= '<input type="hidden" name="payrollCAL1[]" value="'.$emp_id.'">';
                $result_table.= '<a href="#" id = "normal">  Okay </a>';
            
              }else{
                $result_table.= '<input disabled = true type="checkbox" id="" name="" value="">  ';
                $result_table.= '<a href="#" id="success_trigger" onClick="myFunction('.$emp_id.','.$start_date.','.$end_date.','.$GS.','.$basic.','.$house_rent.','.$convergence.','.$medical.','.$p_s_date.','.$p_e_date.','.$working_days.','.$tot_leave.','.$deduction.')">   Error   </a>';
              }
              
                // echo '<input type="checkbox" name = "payroll[]" class="trigger_popup" id = "success_trigger" onclick="myFunction('.$emp_id.' , '.$start_date.','.$end_date.','.$GS.' , '.$basic.' , '.$house_rent.' , '.$convergence.' , '.$medical.' , '.$p_s_date.' , '.$p_e_date.' , '.$working_days.' , '.$tot_leave.' , '.$deduction.')"> ';
              }
              $result_table .= '';
              $result_table.= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
              $result_table .= ''; 
           
              $result_table.= '</td>';
              
           }
        //    $result_table.= '</tr>';
           $result_table.= '</td>';
           $result_table.= '</tr>';
        }

       
        $result_table.= '</table>';

        $result_table.= '

        <br><br>
        <input type="submit" name="submit1" class="btn btn-success" value="Calculate payroll for selected employee">
        <input type="submit" name="submit2" class="btn btn-success" value="Calculate payroll for all valid entry">';
        
  
      }else{
        $okay = '<div class="alert alert-danger">Please fill the required info</div>' ; 
      }
}

?>   


<?php  

require_once "../Classes/PHPExcel.php";


if(isset($_POST['submit1']))
{

  if(!empty($_POST['payrollCAL'])){
    $month = $_POST['month'];
    $year = $_POST['year'];   
    $pay_id = $_POST['pay_id'];
    $emp_id_ar = array();
    $pay_id += 1; 

    $sql = "INSERT INTO payroll(month , year) values('$month','$year')";
    mysqli_query($link, $sql);

    $checked_array=$_POST['payrollCAL'];
    $file = $_POST['filename'];
    
    $a=array();
    foreach ($_POST['payrollCAL'] as $key => $value) 
    {    array_push($a,$value);

    }


        //$PATH = "/opt/lampp/htdocs/payroll_management/images/".$file;

        $PATH = $_POST['dir'];
        $reader = PHPExcel_IOFactory::createReaderForFile($PATH);
        $excel_obj = $reader->load($PATH);
        $worksheet = $excel_obj->getSheet('0');
        $lastrow = $worksheet->getHighestRow();
        $columncount = $worksheet->getHighestColumn();
        $columncount_number = PHPExcel_Cell::columnIndexFromString($columncount);
      

  echo "<table>";

   $i = 0;
   $ok = 0;

//   echo $a[$i];
    $field_ar = array();
    $val_ar = array();
    

    $in = 1;
    for($col = 13; $col < $columncount_number-1 ; $col++){
      $val = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$in)->getValue();
      array_push($field_ar , $val);
    }

    for($j = 0 , $ind = 0 ; $j < count($field_ar) ; $j++){
        //echo $field_ar[$j];
      }


    for($row = 1; $row <= $lastrow ; $row++){
       echo "<tr>";
       $net = $GS = $leave =  "" ; 

       if($row == 1){
        //continue;
        echo "<td>";
        // for($col = 13; $col < $columncount_number-1 ; $col++){
        //   $val = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
        //   array_push($field_ar , $val);
        // }
        echo "</td>";  
    }else{
        $emp_id  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0).$row)->getValue();
        
     //   echo $emp_id;
     echo "<td>";
   
     if((isset($a[$i]) && (int)$emp_id  == $a[$i])) {
      //echo $row;
      $emp_id = "";
      $basic= "";
      $house_rent= "";
      $convergence= "";  
      $medical= "";
      $working_days= "";
      $tot_leave = "";
      $deduction = "";    
      $GS = "";;

      array_push($emp_id_ar , $a[$i]);
      

          for($col = 0; $col <= $columncount_number-1 ; $col++){
            //echo $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0).$row)->getValue();

            $emp_id = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0).$row)->getValue();
            $GS = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(3).$row)->getValue();
            $basic= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(4).$row)->getValue();
            $house_rent= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(5).$row)->getValue();
            $convergence= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(6).$row)->getValue();
            $medical= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(7).$row)->getValue();
            $working_days= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(10).$row)->getValue();
            $tot_leave= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(11).$row)->getValue();
            $deduction= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(12).$row)->getValue();
          }

          $extra = 0;

          for($col = 13; $col < $columncount_number-1 ; $col++){
            $val = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
            $extra += $val;
           // echo $val;
            array_push($val_ar , $val);
          }

          // echo $GS , ' ' , $deduction ,  $extra;

          $net = $GS - $deduction + $extra;

         // echo $net;

          $sql = "INSERT INTO payroll_details(pay_id , emp_id,basic,house_rent,convergence,medical,working_days,tot_leave,deduction,net) values('$pay_id' , '$emp_id','$basic','$house_rent','$convergence','$medical','$working_days','$tot_leave','$deduction' , '$net')";
          if (!$link) {
           die("Connection failed: " . mysqli_connect_error());
           }
        
           if (mysqli_query($link, $sql)) {
             $okay = '<div class="alert alert-success ">Successfully Added payroll</div>';
           } else {
             $okay = '<div class="alert alert-danger ">Failed to Added</div>' ; 
          }          
          $i++;  
      }

    echo "</td>";  
       }

    }


    for($j = 0 , $ind = 0 ; $j < count($emp_id_ar) ; $j++){
     // echo $emp_id_ar[$j];
         for($k = 0 ; $k < count($field_ar) ; $k++){
            $sql = "INSERT INTO additional_fields_val(pay_id , emp_id,field,value) values('$pay_id' , '$emp_id_ar[$j]','$field_ar[$k]','$val_ar[$ind]')";  
           mysqli_query($link, $sql);
           $ind++;
         }
       }

  echo "</table>";
  }

}

if(isset($_POST['submit2']))
{

 // echo 'inside e asi2';

  if(!empty($_POST['payrollCAL1'])){
    $month = $_POST['month'];
    $year = $_POST['year'];   
    $pay_id = $_POST['pay_id'];
    $emp_id_ar = array();
    $pay_id += 1; 

    $sql = "INSERT INTO payroll(month , year) values('$month','$year')";
    mysqli_query($link, $sql);

    $checked_array=$_POST['payrollCAL1'];
    $file = $_POST['filename'];
    
    $a=array();
    foreach ($_POST['payrollCAL1'] as $key => $value) 
    {    array_push($a,$value);

    }


       // $PATH = "/opt/lampp/htdocs/payroll_management/images/".$file;

        $PATH = $_POST['dir'];
        $reader = PHPExcel_IOFactory::createReaderForFile($PATH);
        $excel_obj = $reader->load($PATH);
        $worksheet = $excel_obj->getSheet('0');
        $lastrow = $worksheet->getHighestRow();
        $columncount = $worksheet->getHighestColumn();
        $columncount_number = PHPExcel_Cell::columnIndexFromString($columncount);
      

  echo "<table>";

   $i = 0;
   $ok = 0;

//   echo $a[$i];
    $field_ar = array();
    $val_ar = array();
    

    $in = 1;
    for($col = 13; $col < $columncount_number-1 ; $col++){
      $val = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$in)->getValue();
      array_push($field_ar , $val);
    }

    for($j = 0 , $ind = 0 ; $j < count($field_ar) ; $j++){
        //echo $field_ar[$j];
      }


    for($row = 1; $row <= $lastrow ; $row++){
       echo "<tr>";
       $net = $GS = $leave =  "" ; 

       if($row == 1){
        //continue;
        echo "<td>";
        // for($col = 13; $col < $columncount_number-1 ; $col++){
        //   $val = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
        //   array_push($field_ar , $val);
        // }
        echo "</td>";  
    }else{
        $emp_id  = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0).$row)->getValue();
        
     //   echo $emp_id;
     echo "<td>";
   
     if((isset($a[$i]) && (int)$emp_id  == $a[$i])) {
      //echo $row;
      $emp_id = "";
      $basic= "";
      $house_rent= "";
      $convergence= "";  
      $medical= "";
      $working_days= "";
      $tot_leave = "";
      $deduction = "";    
      
      $GS = "";


      array_push($emp_id_ar , $a[$i]);
      

          for($col = 0; $col <= $columncount_number-1 ; $col++){
            //echo $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0).$row)->getValue();
            $GS = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(3).$row)->getValue();
            $emp_id = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0).$row)->getValue();
            $basic= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(4).$row)->getValue();
            $house_rent= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(5).$row)->getValue();
            $convergence= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(6).$row)->getValue();
            $medical= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(7).$row)->getValue();
            $working_days= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(10).$row)->getValue();
            $tot_leave= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(11).$row)->getValue();
            $deduction= $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(12).$row)->getValue(); 
          }

          $extra = 0;

          for($col = 13; $col < $columncount_number-1 ; $col++){
            $val = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
            $extra += $val;
           // echo $val;
            array_push($val_ar , $val);
          }

          $net = $GS - $deduction + $extra;


          
          $sql = "INSERT INTO payroll_details(pay_id , emp_id,basic,house_rent,convergence,medical,working_days,tot_leave,deduction , net) values('$pay_id' , '$emp_id','$basic','$house_rent','$convergence','$medical','$working_days','$tot_leave','$deduction','$net')";
          if (!$link) {
           die("Connection failed: " . mysqli_connect_error());
           }
        
           if (mysqli_query($link, $sql)) {
             $okay = '<div class="alert alert-success ">Successfully Added payroll</div>';
           } else {
             $okay = '<div class="alert alert-danger ">Failed to Added</div>' ; 
          }          
          $i++;  
      }

    echo "</td>";  
       }

    }


    for($j = 0 , $ind = 0 ; $j < count($emp_id_ar) ; $j++){
     // echo $emp_id_ar[$j];
         for($k = 0 ; $k < count($field_ar) ; $k++){
            $sql = "INSERT INTO additional_fields_val(pay_id , emp_id,field,value) values('$pay_id' , '$emp_id_ar[$j]','$field_ar[$k]','$val_ar[$ind]')";  
           mysqli_query($link, $sql);
           $ind++;
         }
       }

  echo "</table>";
  }

}
  ?>

     <div class="container">

     <div class="popup" id="success">
      <div class="popup-content h-75 w-100">
        <div class="imgbox">
          <img src="" alt="" class="img">
        </div>
        <div class="title">
          <h3>Error!</h3>
        </div>
        <p id = "text" class="para w-75"></p>
        <p id = "text1" class="para w-75"></p>
        <p id = "text2" class="para w-75"></p>
        <p id = "text3" class="para w-75"></p>
        <p id = "text4" class="para w-75"></p>
        <p id = "text5" class="para w-75"></p>
        <p id = "text6" class="para w-75"></p>
        <p id = "text7" class="para w-75"></p>
        <p id = "text8" class="para w-75"></p>
        <p id = "text9" class="para w-75"></p>
        <p id = "text10" class="para w-75"></p>
        <p id = "text11" class="para w-75"></p>
   
        <form action="">
          <a href="#" class="button" id="s_button">CLOSE</a>
        </form>
      </div>
    </div>


     </div>

    <br><br><br><br>

    <form action="" method ="post">

    <?php echo $result_table; ?>
     <!-- <input type="submit" name="submit1" class="btn btn-success" value="Calculate payroll for selected employee">
     <input type="submit" name="submit2" class="btn btn-success" value="Calculate payroll for all valid entry"> -->
    </form>

         <!-- <a href="" style="text-decoration: none; margin-right:50px;">Calculate payroll for selected employee</a>
         &nbsp;
         <a href="" style=" text-decoration: none;">Calculate payroll for all valid entry </a> -->
     

      <?php
      ?>

<span><?php echo $okay;?></span>
<span><?php echo $err;?></span>


    <script>
           
          //  document.getElementById("success_trigger").style.pointer-events = "auto";
           // var s_btn =document.getElementById("success_trigger").;
           var success_popup=document.getElementById("success");
         
           var s_close=document.getElementById("s_button");

            function myFunction(id , sDate , eDate , GS , basic , house_rent , convergence , medical , sPDate , ePDate , workingdays , totLeave , deduction) {
             
                var convergence_check_err , medical_check_err , house_rent_check_err , basic_check_err , basic_err , house_rent_err , convergence_err , medical_err , workingdays_err , totLeave_err , deduction_err ;
                convergence_check_err = medical_check_err = house_rent_check_err = basic_check_err = basic_err = house_rent_err = convergence_err = medical_err = workingdays_err = totLeave_err = deduction_err  = null;
                
                
                var basic_check = GS * 0.6;
                var house_rent_check = GS * 0.2;
                var medical_check = GS * 0.1;
                var convergence_check = GS * 0.1;

                var deduction_check = (GS * totLeave) / workingdays;

                deduction_check = deduction_check.toFixed(2);
                
                
                if(basic <= 0){
                    basic_err = 'please provide valid salary';
                }
                
                if(house_rent <= 0){
                    house_rent_err = 'please provide valid house rent info';
                }

                if(convergence <= 0){
                    convergence_err = 'please provide valid convergence info';
                }

                if(medical <= 0){
                    medical_err = 'please provide valid medical info';
                }

                if(workingdays < 30 || workingdays > 31){
                    workingdays_err = 'please provide valid working days info';
                }
                // if(workingdays > 31){
                //     workingdays_err = 'please provide valid working days info';
                // }

                if(totLeave <= 0 && totLeave >= 31){
                    totLeave_err = 'please provide valid total leave info';
                }

                if(basic != basic_check){
                    basic_check_err = 'basic salary is not equal to 60 percent of gross';
                }

                if(house_rent_check != house_rent){
                  house_rent_check_err = 'house rent is not equal to 20 percent of gross';
                }

                if(medical_check != medical){
                    medical_check_err = 'medical allowance is not equal to 10 percent of gross';
                }

                if(convergence_check != convergence){
                    convergence_check_err = 'convergence is not equal to 10 percent of gross';
                }

                if(deduction != deduction_check){
                    deduction_err = 'please provide valid deduction info';
                }
                
                //if(basic_err != null){
                    document.getElementById("text").innerHTML = basic_err; 
                //}else 
                
                //if(house_rent_err != null){
                    document.getElementById("text1").innerHTML = house_rent_err; 
                //}
                //else if(convergence_err != null){
                    document.getElementById("text2").innerHTML = convergence_err; 
                //}
                //else if(medical_err != null){
                    document.getElementById("text3").innerHTML = medical_err; 
                //}
                //else if(workingdays_err != null){
                    document.getElementById("text4").innerHTML = workingdays_err; 
                //}
                //else if(totLeave_err != null){
                    document.getElementById("text5").innerHTML = totLeave_err; 
               // }
                //else if(deduction_err != null){
                    document.getElementById("text6").innerHTML = deduction_err; 
                //}else if(basic_check_err != null){
                  document.getElementById("text7").innerHTML = basic_check_err; 
                //}
                //else if(house_rent_check_err != null){
                  document.getElementById("text8").innerHTML = house_rent_check_err; 
                //}
                //else if(medical_check_err != null){
                  document.getElementById("text9").innerHTML = medical_check_err; 
                //}
                //else if(convergence_check_err){
                  document.getElementById("text10").innerHTML = convergence_check_err; 
                //}
                  
                $extra_err = "";

                if(basic + house_rent + convergence + medical != GS){
                  $extra_err = 'gross salary is not equal to others'; 
                } 

                document.getElementById("text11").innerHTML = $extra_err; 
                
                // else{
                //     document.getElementById("text").innerHTML = id + '  '+sDate + ' '+eDate + ' ' + GS + ' '+basic + ' ' + house_rent + ' ' +convergence+ ' '+medical + ' '+sPDate+' '+ePDate +' '+workingdays+' '+totLeave+' '+deduction;
                // }

                success_popup.style.display ="block";
                }


            // s_btn.onclick=function(){
            //     success_popup.style.display ="block";
            // }
          
                 s_close.onclick =function(){
                 success_popup.style.display="none";
               }
    </script>

<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
   
</html>

<?php

