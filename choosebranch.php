<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

if(!isset($_SESSION['year'])){
    header("Location: choseyear.php");
    exit();
}

$year = $_SESSION['year'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Choose Branch</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      text-align: center;
      padding: 60px;
    }
    h2 {
      margin-bottom: 30px;
    }
    .branch-btn {
      background-color: rgba(255,255,255,0.2);
      border: none;
      padding: 15px 40px;
      margin: 10px;
      border-radius: 10px;
      font-size: 18px;
      color: white;
      cursor: pointer;
      transition: 0.3s;
    }
    .branch-btn:hover {
      background-color: rgba(255,255,255,0.4);
    }
  </style>
</head>
<body>

<h2>Select Branch for <?php echo $year; ?></h2>

<form action="chosesubject.php" method="POST">
  <button class="branch-btn" name="branch" value="IT">Information Technology (IT)</button>
  <button class="branch-btn" name="branch" value="ENTC">Electronics & Telecommunication (E&TC)</button>
  <button class="branch-btn" name="branch" value="CE">Computer Engineering (CE)</button>
  <button class="branch-btn" name="branch" value="MECH">Mechanical Engineering</button>
  <button class="branch-btn" name="branch" value="ELEC">Electrical Engineering</button>
</form>

</body>
</html>
