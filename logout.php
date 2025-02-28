<?php
session_start();

// ลบข้อมูล session
session_destroy();

// เปลี่ยนเส้นทางกลับไปยังหน้า Login
header('Location: login.php');
exit;
?>