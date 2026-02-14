<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /wssb_crm/auth/login.php");
    exit();
}
