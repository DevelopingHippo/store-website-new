<?php
session_start();
require_once "../php/databaseFunctions.php";
require_once "../php/websiteFunctions.php";
checkCustAuth();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer</title>
    <link rel="stylesheet" type="text/css" href="/css/customer.css" />
</head>
<body>

<?php
# Load dependencies and Top Nav Bar
$username = $_SESSION["username"];
echo '<h1 style="text-align:left;">This is ' . $username . '\'s Profile</h1>';

# Print out Customer Information
$sql = "SELECT username,firstname,lastname,email FROM users WHERE username='" . $username . "';";
$result = queryDatabase($sql);
if ($result)
{
    echo "Username: " . $result["username"] . "<br>";
    echo "Name: " . $result["firstname"] . " " . $result["lastname"] . "<br>";
    echo "Email: " . $result["email"] . "<br>";
}
?>

<a href="/pages/update.php">Update Account</a>
<a href="/php/customer/deleteAcc.php">Delete Account</a>
</body>
</html>
