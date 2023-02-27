<?php

  session_start();
   require_once '../config.php';
   include 'check_login.php';
  
    $id = $_GET['id'];
    $sql = "delete from additional_fields where id = '$id'";
    
    if (!$link) {
          die("Connection failed: " . mysqli_connect_error());
     }
    if (mysqli_query($link, $sql)) {
       $_SESSION['msg'] = "Deleted successfully";
       header("Location: viewFields.php");
     }
     else { 
         $_SESSION['msg'] = "Something error occurred";
         header("Location: viewFields.php");
     }
   
    mysqli_close($link);
?>