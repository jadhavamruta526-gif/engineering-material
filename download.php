<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$year = $_GET['year'] ?? '';
$file = $_GET['file'] ?? '';

$filePath = "uploads/$year/$file";

if(file_exists($filePath)){
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="'.$file.'"');
    readfile($filePath);
    exit;
} else {
    echo "<h2 style='color:red;text-align:center;'>File not found!</h2>";
}
?>
