<?php
session_start();
session_unset();
session_destroy();

# Redirect to Home page
header("location: /pages/login.php");
exit();