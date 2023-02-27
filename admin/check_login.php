<?php
require_once '../config.php';

// session_start();

if(empty($_SESSION['id'])){
  header('Location: login.php');
}

?>

