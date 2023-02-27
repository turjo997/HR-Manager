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

    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Profile</title>
</head>
<body>

<div class="container bg-info banner">
         <div class="row">

            <!-- <div class="col-lg-2">
            <a href="show_files.php">Show Files</a>
            </div> -->

            <div class="col-lg-2">
            <a href="viewUsers.php">View Users</a>
            </div>

            <div class="col-lg-2">
            <a href="import_files3.php">Calculate Payroll</a>
            </div>

            <div class="col-lg-2">
            <a href="add_employee.php">Add Employee</a>
            </div>
            <div class="col-lg-2">
            <a href="viewFields.php">View Fields</a>
            </div>

            <div class="col-lg-2">
            <a href="additional_fields.php">Custom Field</a>
            </div>


            <div class="col-lg-2">
            <a href="logout.php">Logout</a>
            </div>

         </div>
 

</div></div>

<!-- <section class = "banner">
<a href="show_files.php">Show Files</a>
<a href="viewUsers.php">View Users</a>

<a href="import_files.php">Import Files</a>
<a href="add_employee.php">Add Employee</a>
     
</section>  -->


<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>