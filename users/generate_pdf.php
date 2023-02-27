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
            $result_table.= '<h3>PaySlip for '.$name.' '.$year.' '.$month.'</h3><br>';
            // $result_table.= '<h3>Year : '.$year.'</h3><br>';
            // $result_table.= '<h3>Month : '.$month.'</h3><br>';

            while($row = mysqli_fetch_array($result)){
                $result_table .= '<table>
                <tr>
                <td>Pay ID : </td>
                <td>'.$row['pay_id'].'</td>
                </tr>
                <tr>
        
                <tr>
                <td>Basic Salary : </td>
                <td>'.$row['basic'].'</td>
                </tr>
                <tr>
                <td>House Rent : </td>
                <td>'.$row['house_rent'].'</td>
                </tr>
                <tr>
                <td>Convergence Allowance : </td>
                <td>'.$row['convergence'].'</td>
                </tr>
                <tr>
                <td>Medical Allowance: </td>
                <td>'.$row['medical'].'</td>
                </tr>
                <tr>
                <td>Total working days: </td>
                <td>'.$row['working_days'].'</td>
                </tr>
                <tr>
                <td>Total leave : </td>
                <td>'.$row['tot_leave'].'</td>
                </tr>
                <tr>
                <td>Total Deduction : </td>
                <td>'.$row['deduction'].' </td></td>
                </tr>
                <tr>
                <td>Net Salary : </td>
                <td>'.$row['net'].'</td>
                </tr>
                </table>';
                break;
            }
                $result_table .= '</table>';

                $result = mysqli_query($link , $sql); 

                

                $result_table.= '
                <table class="table table-striped table-bordered table-hover table-success text-center">
                <thead>
                      <tr>
                          <th>Additional</th>
                          <th>Amount</th>
                          </tr>
                     </thead>';
                      
                while($row = mysqli_fetch_array($result)){
                
          
                    $result_table .= '<tbody>
                    <tr>
                     <td>'.$row['field'].'</td>
                     <td>'.$row['value'].'</td>
                    </tr>
                    </tbody>';
                }
                $result_table .= '</table>';

        }


              // <tr>
              // <td>Bonus Type : </td>
              // <td>'.$row['field'].'</td>
              // </tr>
              // <tr>
              // <td>Value : </td>
              // <td>'.$row['value'].'</td>
              // </tr>

        // Create Dompdf object and set options
        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'landscape');

        // Load HTML into Dompdf object
        $dompdf->loadHtml($result_table);

        // Render PDF and force download
        $dompdf->render();
        $dompdf->stream('my_table.pdf', array('Attachment' => 1));
?>
