<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "bluesem_db");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$user' AND password=MD5('$pass')";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $user;
        echo "<script>
                alert('Login successful! Welcome $user');
                window.location='choseyear.php';
              </script>";
    } else {
        echo "<script>alert('Invalid username or password!');</script>";
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - BlueseM SPPU</title>
<style>
body {
    margin: 0; padding: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #4facfe, #ff6ec4);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    width: 350px;
    text-align: center;
}
h2 { margin-bottom: 20px; color: #333; }
input[type="text"], input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ddd;
    outline: none;
}
input[type="text"]:focus, input[type="password"]:focus { border-color: #6a11cb; }
button {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border: none;
    border-radius: 25px;
    background: linear-gradient(45deg, #43e97b, #38f9d7);
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}
button:hover { opacity: 0.9; }
p { margin-top: 15px; }
a { text-decoration: none; color: #6a11cb; font-weight: bold; }
</style>
</head>
<body>
<div class="container">
<h2>Login</h2>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="register.php">Register here</a></p>
</div>
</body>
</html>
