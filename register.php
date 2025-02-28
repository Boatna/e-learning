<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$host = 'localhost';
$dbname = 'user_system';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ประมวลผลเมื่อมีการส่งข้อมูลผ่านฟอร์ม
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_username = trim($_POST['username']);
        $new_password = $_POST['password'];

        // ตรวจสอบว่าชื่อผู้ใช้ซ้ำหรือไม่
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $new_username]);
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            echo "Username already exists. Please choose a different username.";
        } else {
            // เข้ารหัสรหัสผ่าน
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // บันทึกข้อมูลลงในฐานข้อมูล
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $new_username, 'password' => $hashed_password]);

            echo "Registration successful! Please <a href='login.php'>login</a>.";
        }
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>