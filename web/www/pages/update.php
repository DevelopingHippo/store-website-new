<?php
session_start();
require_once "../php/databaseFunctions.php";
require_once "../php/websiteFunctions.php";
checkCustAuth();
?>

<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="/css/updateStyle.css" />
</head>
<body>

<?php
# Get Customer Information
$username = $_SESSION["username"];
$sql = "SELECT username,firstname,lastname,email FROM users WHERE username='" . $username . "';";
$result = queryDatabase($sql);
if($result){
    $firstname = $result["firstname"];
    $lastname = $result["lastname"];
    $email = $result["email"];
}
?>

<h4>Update Customer Information</h4>
<form action="/php/customer/update.php" method="POST">
    <label>
        <table>
            <tr>
                <td>Username:</td>
                <td>
                    <?php
                    echo $username
                    ?>
                </td>
            </tr>
            <tr>
                <td>First Name:</td>
                <td>
                    <?php
                    echo $firstname
                    ?>
                    <label>
                        <input type="text" name="firstname">
                    </label>
                </td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td>
                    <?php
                    echo $lastname
                    ?>
                    <label>
                        <input type="text" name="lastname">
                    </label>

                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <?php
                    echo $email
                    ?>
                </td>
            </tr>
            <tr>
                <td>Old Password:</td>
                <td>
                    <label>
                        <input type="password" name="oldpassword">
                    </label>
                </td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td>
                    <label>
                        <input type="password" name="password1">
                    </label>
                </td>
            </tr>
            <tr>
                <td>Confirm New Password:</td>
                <td>
                    <label>
                        <input type="password" name="password2">
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="update" value="Update">
                </td>
            </tr>
        </table>
</form>

<?php # Print Status Message

if(isset($_GET["status"])){
    $status = $_GET["status"];
    if($status == "badinput")
    {
        echo '<span style="color:#DE3737;text-align:center;">Update Failed!</span>';
    }
}


?>

<div id="footer">
    | Ethan B. | Thad S. | Brad S. | Andrew M. | Ewan B. | SAT3210 Project Site |
</div>
</body>
</html>