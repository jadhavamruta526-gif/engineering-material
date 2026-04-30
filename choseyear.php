<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Choose Year - BlueseM</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    margin: 0;
    padding: 0;
    text-align: center;
}
.container {
    background: rgba(0,0,0,0.6);
    border-radius: 20px;
    padding: 40px;
    width: 55%;
    margin: 80px auto;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}
h2 {
    font-size: 30px;
    margin-bottom: 30px;
    letter-spacing: 1px;
}
button {
    background: #ffdf6c;
    color: #333;
    border: none;
    font-size: 18px;
    font-weight: bold;
    border-radius: 12px;
    padding: 12px 25px;
    margin: 12px;
    width: 80%;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}
button:hover {
    background: #fff;
    color: #000;
    transform: scale(1.05);
}
a {
    color: #ff9b9b;
    text-decoration: none;
    font-size: 16px;
}
a:hover {
    text-decoration: underline;
}
</style>

<script>
function goToYear(year) {
    // FE → subjects.php
    if (year === 'FE') {
        window.location.href = "subjects.php?year=" + encodeURIComponent(year);
    } 
   if (year === 'SE') {
        window.location.href = "chosebranch.php?year=" + encodeURIComponent(year);
    } 
}
</script>
</head>
<body>
    <div class="container">
        <h2>Select Your Engineering Year</h2>
        <button onclick="goToYear('FE')">First Year (FE)</button><br>
        <button onclick="goToYear('SE')">Second Year (SE)</button><br>
        <button onclick="goToYear('TE')">Third Year (TE)</button><br>
        <button onclick="goToYear('BE')">Final Year (BE)</button><br>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
