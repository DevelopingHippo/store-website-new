<?php
require_once "../php/websiteFunctions.php";
require_once "../php/databaseFunctions.php";
require_once "../php/pageFunctions/adminFunctions.php";
session_start();
checkAdminAuth();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css"/>
</head>
<body>

<div class="wrapper">
    <div class="employeePanel">
        <?php
        #Build Employee Panel from adminFunctions.php Functions
        echo '<h2>Employee Panel</h2>';
        echo "<br>Required (*)";
        printAdminEmployeeSearch();
        printAdminEmployeeCreate();
        printAdminEmployeeUpdate();
        printAdminEmployeeDelete();
        ?>
    </div>
    <div class="sqlPanel">
        <?php
        # Build SQL Panel from adminFunctions.php Functions
        echo '<h2>SQL Panel</h2>';
        printAdminSQLPrompt();
        ?>
    </div>
</div>
</body>
</html>
