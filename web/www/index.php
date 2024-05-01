<?php
session_start();
require_once "./php/websiteFunctions.php";
require_once "./php/databaseFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/site-global.css"/>
    <link rel="stylesheet" type="text/css" href="index.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">
    <title>Welcome</title>
</head>
<body>
<?php
build_container();
?>
<main class="main-container">
    <h2>Store Info</h2>
    <div class="main-body">
        <p>This site is a PC Parts Store that has:</p>
        <p><b>Store:</b> Product Searching, Shopping Cart, Checkout, Receipts, and Purchase History</p>
        <p><b>Customer:</b> Customer Registration, Customer Login, Account Updating & Deleting</p>
        <p><b>Employee Management Panel:</b></p>
        <p>Customer(Search, Create, Update, Delete)</p>
        <p>Product(Search, Update, Low Stock Alerts, Restock)</p>
        <p>Order(Search, Update, Refund)</p>
    </div>
</main>
<script src="/js/scripts/web-functions.js"></script>
</body>
</html>