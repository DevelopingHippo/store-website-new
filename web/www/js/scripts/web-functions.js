function pageRedirect(page) {
    let location = "";
    switch(page) {
        case "login":
            location = "/pages/login.php";
            break;
        case "register":
            location = "/pages/register.php";
            break;
        case "profile":
            location = "/pages/profile.php"
            break;
        case "cart":
            location = "/pages/cart.php"
            break;
        case "logout":
            location = "/php/auth/logout.php"
            break;
        case "employee-panel":
            location = "/pages/employee-panel.php"
            break;
        case "admin-panel":
            location = "/pages/admin-panel.php"
            break;
        case "store":
            location = "/pages/store.php"
            break;
    }
    window.location.href = location;
}