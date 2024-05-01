function pageRedirect(page) {
    let location = "";
    switch(page) {
        case "dashboard":
            location = "/pages/dashboard.php"
            break;
        case "profile":
            location = "/pages/profile.php"
            break;
        case "logout":
            location = "/php/auth/logout.php"
            break;
        case "settings":
            location = "/pages/settings.php"
            break;
        case "employee-dashboard":
            location = "/pages/employee-dashboard.php"
            break;
        case "manage":
            location = "/pages/manage.php"
            break;
    }
    window.location.href = location;
}