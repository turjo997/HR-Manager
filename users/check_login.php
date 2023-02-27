<?php
require_once '../config.php';

// session_start();

if(empty($_SESSION['emp_id'])){
  header('Location: login.php');
}

?>