<?php
session_start(); // เริ่มต้น session

// เชื่อมต่อฐานข้อมูล
$host = 'localhost';
$dbname = 'user_system';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับข้อมูลจากฟอร์ม
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        // ค้นหาผู้ใช้ในฐานข้อมูล
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $input_username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($input_password, $user['password'])) {
            // ถ้ารหัสผ่านถูกต้อง สร้าง session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php'); // เปลี่ยนเส้นทางไปหน้า Dashboard
            exit;
        } else {
            echo "Invalid username or password.";
        }
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>