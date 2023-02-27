<?php

         require_once 'dompdf/autoload.inc.php';
         require_once '../config.php';

         use Dompdf\Dompdf;

         //$emp_id = $_GET['emp_id'];
        // $id = $_GET['id'];

         $emp_id = $_POST['emp_id'];
         $id = $_POST['id'];

         $month = $_POST['month'];
         $year = $_POST['year'];

         $result_table = "";
         //echo $emp_id , ' ' , $id;

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

            $result_table.= '<h1>XYZ Software Company</h1><br>';
            $result_table.= '<h3>PaySlip</h3><br>';
            $result_table.= '<h3>Year : '.$year.'</h3><br>';
            $result_table.= '<h3>Month : '.$month.'</h3><br>';

            $result_table.= '
            <table class="table table-striped table-bordered table-hover table-success text-center">
            <thead>
                    <tr>
                        <th>Pay Id </th>
                        <th>Employee Name </th>
                        <th>Basic Salary </th>
                        <th>House Rent </th>
                        <th>Convergence </th>
                        <th>Medical </th>
                        <th>Working Days </th>
                        <th>Total Leave Days </th>
                        <th>Deduction Money </th>
                        <th>Bonus Type </th>
                        <th>Bonus value </th>
                        <th>Net Salary </th>
                    </tr>
                </thead>';
            
            while($row = mysqli_fetch_array($result)){
                
                $result_table .= '<tbody>
                <tr>
                <td>'.$row['pay_id'].'</td>
                <td>'.$name.'</td>
                <td>'.$row['basic'].'</td>
                <td>'.$row['house_rent'].'</td>
                <td>'.$row['convergence'].'</td>
                <td>'.$row['medical'].'</td>
                <td>'.$row['working_days'].'</td>
                <td>'.$row['tot_leave'].'</td>
                <td>'.$row['deduction'].'</td>
                <td>'.$row['field'].'</td>
                <td>'.$row['value'].'</td>
                <td>'.$row['net'].'</td>
                </tr>
                </tbody>';
            }
                $result_table .= '</table>';

        }

        // Create Dompdf object and set options
        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'landscape');

        // Load HTML into Dompdf object
        $dompdf->loadHtml($result_table);

        // Render PDF and force download
        $dompdf->render();
        $dompdf->stream('my_table.pdf', array('Attachment' => 1));
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


<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>


