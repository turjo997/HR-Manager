<?php

  session_start();
   require_once '../config.php';
   include 'check_login.php';
  
   $user_id = $_GET['user_id'];

   $exist_query = "select * from contract where emp_id = '$user_id'";
   $query = mysqli_query($link , $exist_query);
 
   $emailcount = mysqli_num_rows($query);

   //echo $emailcount;

    if($emailcount < 1 ){
    
    $sql = "delete from employee where id = '$user_id'";
    
    if(mysqli_query($link, $sql)){
        $_SESSION['msg'] = "Removed employee successfully";
    }
    
    else{
        $_SESSION['msg'] = "Something error occurred";
    }
    //echo $emailcount;
    header("Location: viewUsers.php");
   }else{
   
    $sql = "delete from contract where emp_id = '$user_id'";
    if (!$link) {
          die("Connection failed: " . mysqli_connect_error());
     }
    if (mysqli_query($link, $sql)) {
     $sql = "delete from employee where id = '$user_id'";
       if(mysqli_query($link, $sql)){
        $_SESSION['msg'] = "Removed employee successfully";
       }else{
         $_SESSION['msg'] = "Something error occurred";
       }
       header("Location: viewUsers.php");
     }
     else { 
         $_SESSION['msg'] = "Something error occurred";
         header("Location: viewUsers.php");
     }
   }
    mysqli_close($link);
?>