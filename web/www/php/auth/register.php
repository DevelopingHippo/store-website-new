<?php
session_start();
require_once "../../php/databaseFunctions.php";
if(empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["username"]) || empty($_POST["password1"]) || ($_POST["password1"] !=  $_POST["password2"])) # If user input is empty AND passwords don't match
{
    # Redirect user back to Registration page with Status Message
	header("location: /pages/register.php?status=badinput");
	exit();
}

# Sanitize User Input
$firstname = inputSanitize($_POST["firstname"]);
$lastname = inputSanitize($_POST["lastname"]);
$username = inputSanitize($_POST["username"]);
$password = hash('sha256', $_POST["password1"]);
$password = inputSanitize($password);
$email = inputSanitize($_POST["email"]);

$sql = "SELECT username FROM users WHERE username='".$username."';";
$result = queryDatabase($sql);

if($result->num_rows != 0) # If Username already exists
{
    # Redict to Register page with Status Message
	header("location: /pages/register.php?status=userexists");
    exit();
}

$sql = "INSERT INTO users VALUES ('".$username."','".$firstname."','".$lastname."','".$email."','".$password."','customer');";
$result = queryDatabase($sql);

# If everything is successful, redirect to Login page
header("location: /pages/login.php");
exit();