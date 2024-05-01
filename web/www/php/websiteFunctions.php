<?php
# Print out Site Navigation Menu


function build_container(): void
{
    echo '
        <div class="grid-container">
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined" id="clickableIcon">menu</span>
            </div>
            <div class="header-left">
                <span class="material-icons-outlined" id="clickableIcon">search</span>
            </div>
            <div class="header-right">
                <span class="material-icons-outlined" id="clickableIcon">notifications</span>
                <span class="material-icons-outlined" id="clickableIcon">email</span>
                <span class="material-icons-outlined" id="clickableIcon" onclick="pageRedirect(\'profile\')">account_circle</span>
                <span class="material-symbols-outlined" id="clickableIcon" onclick="pageRedirect(\'logout\')">logout</span>
            </div>
        </header>
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-symbols-outlined">eye_tracking</span> Global Solutions
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item" onclick="pageRedirect(\'store\')">
                    <span class="material-icons-outlined">dashboard</span> Store
                </li>';
    if(isset($_SESSION['role'])){
        echo '<li class="sidebar-list-item" onclick="pageRedirect(\'profile\')">
                    <span class="material-icons-outlined">fact_check</span> Profile
                </li>';
        echo '<li class="sidebar-list-item" onclick="pageRedirect(\'cart\')">
                    <span class="material-icons-outlined">fact_check</span> Cart
                </li>';
    }
    else {
        echo '<li class="sidebar-list-item" onclick="pageRedirect(\'login\')">
                    <span class="material-icons-outlined">fact_check</span> Account
                </li>';
    }
    if(isset($_SESSION['role'])) {
        if($_SESSION['role'] == 'employee' || $_SESSION['role'] == 'admin') {
            echo '<li class="sidebar-list-item" onclick="pageRedirect(\'employee-panel\')">
                            <span class="material-icons-outlined">groups</span> Employee
                  </li>';
        }
        if($_SESSION['role'] == 'admin'){
            echo '<li class="sidebar-list-item" onclick="pageRedirect(\'admin-panel\')">
                            <span class="material-icons-outlined">groups</span> Admin
                        </li>';
        }
    }
    echo '</ul>
        </aside>';
}

function checkAdminAuth(): void
{
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
        header("location: /php/auth/logout.php");
        exit();
    }
}

function checkCustAuth(): void
{
    if(!isset($_SESSION["role"])){
        header("location: /php/auth/logout.php");
        exit();
    }
}

function checkEmployeeAuth(): void
{
    if(!isset($_SESSION['role']) || ($_SESSION['role'] != 'employee' || $_SESSION['role'] != 'admin')){
        header('location: /php/auth/logout.php');
        exit();
    }
}

# Return HTML formatted POST form for adding item to cart
function addToCartButton($productName): string
{
    return '<form action="/php/store_functions/addToCart.php" method="POST">
            <input type="hidden" name="productName" value="' .$productName.'">
            <input type="submit" name="submit" value="&#9989">
            </form>';
}

# Return HTML formatted POST form for removing item from cart
function removeFromCartButton($productName): string
{
    return '<form action="/php/store_functions/removeFromCart.php" method="POST">
            <input type="hidden" name="productName" value="' .$productName.'">
            <input type="submit" name="submit" value="&#10060">
            </form>';
}


function printProductUpdateForm($productName, $productType)
{
    if(!empty($productName) || !empty($productType))
    {
        $productSQL = "SELECT * FROM ".$productType." WHERE productName = '".$productName."';";
        $productResults = queryDatabase($productSQL);
        if($productResults->num_rows > 0)
        {
            $productRow = $productResults->fetch_assoc();
            $priceSQL = "SELECT price FROM store WHERE productName = '".$productName."';";
            $priceResults = queryDatabase($priceSQL);
            $priceRow = $priceResults->fetch_assoc();
            $price = $priceRow["price"];
            if($productType == "cpu")
            {
                echo "<table class='center'>";
                echo "<form action='/pages/employee-panel.php' method='POST'>";
                echo '<tr><td><b>Product Name:</b></b></td><td>'.$productRow["productName"].'</td><td><input type="text" name="productNameUpdate"></td></tr>';
                echo '<tr><td><b>Manufacturer:</b></td><td>'.$productRow["manufacturer"].'</td><td><input type="text" name="manufacturerUpdate"></td></tr>';
                echo '<tr><td><b>Socket:</b></td><td>'.$productRow["socket"].'</td><td><input type="text" name="socketUpdate"></td></tr>';
                echo '<tr><td><b>Core Count:</b></td><td>'.$productRow["coreCount"].'</td><td><input type="number" name="coreCountUpdate" min="1"></td></tr>';
                echo '<tr><td><b>Core Clock:</b></td><td>'.$productRow["coreClock"].'</td><td><input type="number" name="coreClockUpdate" min="1" step="0.1"></td></tr>';
                echo '<tr><td><b>Core Clock Boost:</b></td><td>'.$productRow["coreClockBoost"].'</td><td><input type="number" name="coreClockBoostUpdate" min="0" step=".1"></td></tr>';
                echo '<tr><td><b>Price:</b></td><td>$'.$price.'</td><td><input type="number" name="priceUpdate" min="0" step="0.01"></td></tr>';
                echo "</table>";
                echo '<input type="hidden" name="productTypeUpdate" value="cpu">';
                echo '<input type="hidden" name="productNameUpdate" value="'.$productName.'">';
                echo '<tr><td></td><td><input type="submit" name="action" value="Update Product"></td></tr>';
                echo "</form>";
            }
            else if($productType == "gpu")
            {
                echo "<table class='center'>";
                echo "<form action='/employee/employee-panel.php' method='POST'>";
                echo '<tr><td><b>Product Name:</b></td><td>'.$productRow["productName"].'</td><td><input type="text" name="newProductNameUpdate"></td></tr>';
                echo '<tr><td><b>Manufacturer:</b></td><td>'.$productRow["manufacturer"].'</td><td><input type="text" name="manufacturerUpdate"></td></tr>';
                echo '<tr><td><b>Core Clock:</b></td><td>'.$productRow["coreClock"].'</td><td><input type="number" name="coreClockUpdate" min="1"></td></tr>';
                echo '<tr><td><b>Memory:</b></td><td>'.$productRow["memory"].'</td><td><input type="number" name="memoryUpdate" min="1"></td></tr>';
                echo '<tr><td><b>Color:</b></td><td>'.$productRow["color"].'</td><td><input type="text" name="colorUpdate"></td></tr>';
                echo '<tr><td><b>Price:</b></td><td>$'.$price.'</td><td><input type="number" name="priceUpdate" min="0" step="0.01"></td></tr>';
                echo "</table>";
                echo '<input type="hidden" name="productTypeUpdate" value="gpu">';
                echo '<input type="hidden" name="productNameUpdate" value="'.$productName.'">';
                echo '<tr><td></td><td><input type="submit" name="action" value="Update Product"></td></tr>';
                echo "</form>";
            }
            else if($productType == "psu")
            {
                echo "<table class='center'>";
                echo "<form action='/pages/employee-panel.php' method='POST'>";
                echo '<tr><td><b>Product Name:</b></td><td>'.$productRow["productName"].'</td><td><input type="text" name="productNameUpdate"></td></tr>';
                echo '<tr><td><b>Manufacturer:</b></td><td>'.$productRow["manufacturer"].'</td><td><input type="text" name="manufacturerUpdate"></td></tr>';
                echo '<tr><td><b>Wattage:</b></td><td>'.$productRow["wattage"].'</td><td><input type="number" name="wattageUpdate" min="1"></td></tr>';
                echo '<tr><td><b>Modular:</b></td><td>'.$productRow["modular"].'</td><td><input type="text" name="modularUpdate"></td></tr>';
                echo '<tr><td><b>Efficiency:</b></td><td>'.$productRow["efficiency"].'</td><td><input type="text" name="efficiencyUpdate"></td></tr>';
                echo '<tr><td><b>Price:</b></td><td>$'.$price.'</td><td><input type="number" name="priceUpdate" min="0" step="0.01"></td></tr>';
                echo "</table>";
                echo '<input type="hidden" name="productTypeUpdate" value="psu">';
                echo '<input type="hidden" name="productNameUpdate" value="'.$productName.'">';
                echo '<tr><td></td><td><input type="submit" name="action" value="Update Product"></td></tr>';
                echo "</form>";
            }
            else if($productType == "ram")
            {
                echo "<table class='center'>";
                echo "<form action='/pages/employee-panel.php' method='POST'>";
                echo '<tr><td><b>Product Name:</b></td><td>'.$productRow["productName"].'</td><td><input type="text" name="productNameUpdate"></td></tr>';
                echo '<tr><td><b>Manufacturer:</b></td><td>'.$productRow["manufacturer"].'</td><td><input type="text" name="manufacturerUpdate"></td></tr>';
                echo '<tr><td><b>Speed:</b></td><td>'.$productRow["speed"].'</td><td><input type="text" name="speedUpdate"></td></tr>';
                echo '<tr><td><b>Size:</b></td><td>'.$productRow["size"].'</td><td><input type="number" name="sizeUpdate" min="1"></td></tr>';
                echo '<tr><td><b>Amount:</b></td><td>'.$productRow["amount"].'</td><td><input type="number" name="amountUpdate" min="1"></td></tr>';
                echo '<tr><td><b>Color:</b></td><td>'.$productRow["color"].'</td><td><input type="text" name="colorUpdate"></td></tr>';
                echo '<tr><td><b>Price:</b></td><td>$'.$price.'</td><td><input type="number" name="priceUpdate" min="0" step="0.01"></td></tr>';
                echo "</table>";
                echo '<input type="hidden" name="productTypeUpdate" value="ram">';
                echo '<input type="hidden" name="productNameUpdate" value="'.$productName.'">';
                echo '<input type="submit" name="action" value="Update Product">';
                echo "</form>";
            }
            else if($productType == "motherboard")
            {
                echo "<table class='center'>";
                echo "<form action='/pages/employee-panel.php' method='POST'>";
                echo '<tr><td><b>Product Name:</b></td><td>'.$productRow["productName"].'</td><td><input type="text" name="productNameUpdate"></td></tr>';
                echo '<tr><td><b>Manufacturer:</b></td><td>'.$productRow["manufacturer"].'</td><td><input type="text" name="manufacturerUpdate"></td></tr>';
                echo '<tr><td><b>Socket:</b></td><td>'.$productRow["socket"].'</td><td><input type="text" name="socketUpdate"></td></tr>';
                echo '<tr><td><b>Memory Max:</b></td><td>'.$productRow["memoryMax"].'</td><td><input type="number" name="memoryMaxUpdate" min="1"></td></tr>';
                echo '<tr><td><b>Memory Slots:</b></td><td>'.$productRow["memorySlots"].'</td><td><input type="number" name="memorySlotsUpdate" min="1"></td></tr>';
                echo '<tr><td><b>Color:</b></td><td>'.$productRow["color"].'</td><td><input type="text" name="colorUpdate"></td></tr>';
                echo '<tr><td><b>Price:</b></td><td>$'.$price.'</td><td><input type="number" name="priceUpdate" min="0" step="0.01"></td></tr>';
                echo "</table>";
                echo '<input type="hidden" name="productTypeUpdate" value="motherboard">';
                echo '<input type="hidden" name="productNameUpdate" value="'.$productName.'">';
                echo '<tr><td></td><td><input type="submit" name="action" value="Update Product"></td></tr>';
                echo "</form>";
            }
        }
    }
}