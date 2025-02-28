document.addEventListener("DOMContentLoaded", function () {
    const userNameSpan = document.getElementById("user-name");
    const authButton = document.getElementById("auth-button");

    // ตรวจสอบสถานะผู้ใช้
    let user = localStorage.getItem("user");

    function updateUI() {
        if (user) {
            userNameSpan.textContent = user;
            authButton.textContent = "Logout";
        } else {
            userNameSpan.textContent = "Guest";
            authButton.textContent = "Login";
        }
    }

    authButton.addEventListener("click", function () {
        if (user) {
            localStorage.removeItem("user");
            user = null;
        } else {
            user = prompt("กรุณากรอกชื่อของคุณ:");
            if (user) {
                localStorage.setItem("user", user);
            }
        }
        updateUI();
    });

    updateUI();
});