<?php
session_start();
$_SESSION = array();
$_SESSION['id'] = '';
$_SESSION['connexion_status'] = 'disconnected';
header('Location: ../index.php');
?>
