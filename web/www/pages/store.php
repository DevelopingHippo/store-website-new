<?php
session_start();
require_once "../php/websiteFunctions.php";
require_once "../php/databaseFunctions.php";
require_once "../php/store/storeFunctions.php";
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Store</title>
    <link rel="stylesheet" type="text/css" href="/css/site-global.css" />
    <link rel="stylesheet" type="text/css" href="/css/store.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">
    <script src="/js/scripts/web-functions.js"></script>
</head>
<body>
<?php build_container();?>
    <main class="main-container">
        <div class="main-title"><h2>Store</h2></div>
        <div class="store">
            <div class="search">
                <form action="/pages/store.php" method="POST">
                    <div class="searchbar">
                        <label><input id="searchbar" size="30" type="text" name="search"></label>
                        <input id="searchbutton" type="submit" value="Search">
                    </div>
                    <div class="filter">
                        <ul class="filter-list">
                            <li class="filter-item">
                                <label><input type="radio" name="productType" value="cpu">CPU</label>
                                <label><input type="radio" name="productType" value="gpu">GPU</label>
                                <label><input type="radio" name="productType" value="ram">RAM</label>
                                <label><input type="radio" name="productType" value="psu">PSU</label>
                                <label><input type="radio" name="productType" value="motherboard">Motherboard</label>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
                <div class="results">
                <table class="center">
                    <?php
                    if(!isset($_POST["search"])) {
                        $_POST["search"] = "";
                    }
                    if(!isset($_POST["productType"]))
                    {
                        $_POST["productType"] = "";
                    }
                    if(!isset($_POST["orderBy"]))
                    {
                        $_POST["orderBy"] = "";
                    }
                    searchStoreQuery($_POST["search"], $_POST["productType"], $_POST["orderBy"]);
                    ?>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>