<?php
session_start();
require_once "../../php/databaseFunctions.php";

if(!empty($_POST["username"]) && !empty($_POST["password"])) # If Username and Password NOT empty
{
    $username = inputSanitize($_POST["username"]);

    $password = hash('sha256', $_POST["password"]);
    $password = inputSanitize($password);
}
else # redirect the user to Login page with status message
{
    header("location: /pages/login.php?status=missinginput");
    exit();
}

$sql = "SELECT role FROM users WHERE username='".$username."' AND password='".$password."';";
$result = queryDatabase($sql);

if ($result) # If query comes back with results
{
    $_SESSION["username"] = $username;

    if($result["role"] == "customer") # If user is a Customer set SESSION values and redirect to Customer Profile page
    {
        $_SESSION["role"] = "customer";
        header("location: /pages/profile.php");
    }
    else if($result["role"] == "employee") # If user is an Employee set SESSION values and redirect to Employee Panel page
    {
        $_SESSION["role"] = "employee";
        header("location: /pages/employee-panel.php");
    }
    else if($result["role"] == "admin"){
        $_SESSION["role"] = "admin";
        header("location: /pages/employee-panel.php");
    }
}
else # redirect the user to Login page with status message
{
    header("location: /pages/login.php?status=loginfail");
}
exit();