document.addEventListener("DOMContentLoaded", function () {
    // ✅ ฟังก์ชันไฮไลท์เมนูเมื่ออยู่ในหน้านั้น
    let currentPage = window.location.pathname.split("/").pop();
    let navLinks = document.querySelectorAll("nav ul li a");

    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active"); // เพิ่มคลาส active
        }
    });

    // ✅ เลื่อนหน้าไปที่ "หลักสูตร" เมื่อกดปุ่ม
    let courseBtn = document.querySelector(".btn-primary");
    if (courseBtn) {
        courseBtn.addEventListener("click", function (e) {
            e.preventDefault();
            let courseSection = document.querySelector("#courses");
            if (courseSection) {
                courseSection.scrollIntoView({ behavior: "smooth" });
            }
        });
    }

    // ✅ เมนู Responsive (สำหรับมือถือ)
    let menuToggle = document.createElement("button");
    menuToggle.innerText = "☰ เมนู";
    menuToggle.classList.add("menu-toggle");
    document.querySelector("header .container").prepend(menuToggle);

    menuToggle.addEventListener("click", function () {
        document.querySelector("nav ul").classList.toggle("show");
    });

    // ✅ แสดง/ซ่อนป๊อปอัป
    let popup = document.querySelector("#popup");
    if (popup) {
        setTimeout(() => {
            popup.style.display = "flex"; // แสดงป๊อปอัปหลัง 3 วินาที
        }, 3000);

        let popupCloseBtn = document.createElement("button");
        popupCloseBtn.innerText = "ปิด";
        popupCloseBtn.style.marginTop = "10px";
        popupCloseBtn.addEventListener("click", function () {
            popup.style.display = "none";
        });

        document.querySelector("#popup-content").appendChild(popupCloseBtn);
    }
});
