<?php

session_start();
  include 'check_login.php';
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

  <?php
   require_once "../Classes/PHPExcel.php";

        $PATH = "";
        $okay = "";
        $file = $_GET['file_name'];
        //$file = $_FILES['excelFILE']['name'];

        $PATH = "/opt/lampp/htdocs/payroll_management/images/".$file;
        $reader = PHPExcel_IOFactory::createReaderForFile($PATH);
        $excel_obj = $reader->load($PATH);
     
        $worksheet = $excel_obj->getSheet('0');
     
        $lastrow = $worksheet->getHighestRow();
        $columncount = $worksheet->getHighestColumn();
        $columncount_number = PHPExcel_Cell::columnIndexFromString($columncount);
        $ok = 0;
          for($row = 1; $row <= $lastrow ; $row++){
             for($col = 0 ; $col < $columncount_number-1 ; $col++){
                $val = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
                if($val == ""){
                    echo '<div class="alert alert-danger ">There are blank fields. Please fill all the fields.</div>' ; 
                    $ok = 1;
                    break;
                }
             }
             if($ok == 1){
                break;
             }
          }

          if($ok == 0){

            echo "<table>";
     
            for($row = 0; $row <= $lastrow ; $row++){
               echo "<tr>";
               $net = $GS = $leave =  "" ; 
  
               for($col = 0 ; $col <= $columncount_number ; $col++){
                  echo "<td>";
                   
  
                  if($row >= 1 && $col == 3){
                     $GS = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
                  }
       
                  if($row >= 1 && $col == 11){
                  
                  $leave = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
                  
                  }
                  
                  $days = 30;
                  $x = (int)$GS * (int)$leave;
                  $net = (int)$GS - ((int)$x / (int)$days);
  
  
                   if($row > 1 && $col == $columncount_number-1){
                      $val = $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
                      
                      if($val == ""){
                          echo $net;
                      }
                   }else{
                         echo $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
                   }
                   echo "</td>";
       
               }
       
               echo "</td>";
       
            }
       
          echo "</table>";

          }
     
?>
   </div>

    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>