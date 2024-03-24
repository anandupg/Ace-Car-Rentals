<?php
session_start();
unset($_SESSION['login_id']);
header("Location: index.php");
?>