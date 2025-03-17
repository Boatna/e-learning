// Check if user is logged in on page load
document.addEventListener("DOMContentLoaded", () => {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const storedUserName = localStorage.getItem('userName');

    if (isLoggedIn === 'true' && storedUserName) {
        showUserInfo(storedUserName);
    }
});

// Handle login form submission
document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from refreshing the page

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    // Simple validation (replace with your own logic)
    if (username === "admin" && password === "1234") {
        // Save login status and username to localStorage
        localStorage.setItem('isLoggedIn', 'true');
        localStorage.setItem('userName', username);

        // Show user info
        showUserInfo(username);
    } else {
        alert("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
    }
});


