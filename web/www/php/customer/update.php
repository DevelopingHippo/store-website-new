<?php
session_start();
require_once "../databaseFunctions.php";
require_once "../websiteFunctions.php";
checkCustAuth();


$username = $_SESSION["username"];
$status = "";
# this updates the user's first name
if(isset($_POST['firstname']))
{
    $firstname = inputSanitize($_POST["firstname"]);
    $sql = "UPDATE users SET firstname = '" . $firstname ."' WHERE username = '". $username . "';";
    $result = insertDatabase($sql);
    if($result){
        $status = 'success';
    }
}

# this updates the user's last name
if(isset($_POST['lastname']))
{
    $lastname = inputSanitize($_POST["lastname"]);
    $sql = "UPDATE users SET lastname = '" . $lastname ."' WHERE username = '". $username . "';";
    $result = insertDatabase($sql);
    if($result){
        $status = 'success';
    }
}

# this updates the user's password if the old password matches the previous password on record
if(isset($_POST['oldpassword']) && isset($_POST['password1']) && isset($_POST['password2']))
{
    if(($_POST["password1"] != $_POST["password2"])) # If Passwords don't match
    {
        # Redirect with back with Status Message
        header("location: /customer/update.php?status=badinput");
        exit();
    }
    $password = hash('sha256', $_POST["password1"]);
    $password = inputSanitize($password);

    $oldpassword = hash('sha256', $_POST["oldpassword"]);
    $oldpassword = inputSanitize($oldpassword);

    $sql = "SELECT username FROM users WHERE username ='" . $username . "' AND password = '" . $oldpassword . "';";
    $result = queryDatabase($sql);
    if($result)
    {
        $sql = "UPDATE users SET password = '" . $password ."' WHERE username = '". $username . "';";
        $result = insertDatabase($sql);
        if($result){
            $status = 'success';
        }
    }
    else {
        header("location: /pages/update.php?status=badinput");
        exit();
    }
}

if($status == "success"){
    header("location: /pages/profile.php?status=".$status);
    exit();
}
else {
    header("location: /pages/update.php?status=".$status);
}

# redirect the user back to the customer profile page
