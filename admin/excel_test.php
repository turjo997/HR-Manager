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
   <form method = "post" enctype="multipart/form-data"> 
   <div class="mb-3">
   <input type="file" id="myFile" name="excelFILE">
  </div>


  <input type="submit" name="submit" class="form-control btn-success" value="Show report">

  </form>
  <?php
   require_once "../Classes/PHPExcel.php";

   $PATH = "";
  // $file = "";

if(isset($_POST['submit'])){

    if(!isset($_FILES['excelFILE'])){
        $file = "Please Select A File";
        echo "Please Select A File" ; 
    }else{
     

    if(empty($file)){

        $file = $_FILES['excelFILE']['name'];

        $PATH = "/opt/lampp/htdocs/payroll_management/images/".$file;
        $reader = PHPExcel_IOFactory::createReaderForFile($PATH);
        $excel_obj = $reader->load($PATH);
     
        $worksheet = $excel_obj->getSheet('0');
     
        $lastrow = $worksheet->getHighestRow();
        $columncount = $worksheet->getHighestColumn();
        $columncount_number = PHPExcel_Cell::columnIndexFromString($columncount);
     
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

}

}
?>
   </div>

    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>