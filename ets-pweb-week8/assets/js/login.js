/**
 * LibraryReg - Administrator Authentication Module
 * Handles administrator credential validation and dashboard access redirection.
 */
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("adminLoginForm");
    if (!loginForm) return;

    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const user = document.getElementById("admin_user").value.trim();
        const pass = document.getElementById("admin_pass").value;
        const alertEl = document.getElementById("loginAlert");

        if (user === "admin" && pass === "admin123") {
            alert("Login Berhasil! Anda akan diarahkan ke halaman Pengelolaan Anggota Perpustakaan.");
            window.location.href = "admin.html";
        } else {
            if (alertEl) {
                alertEl.classList.remove("d-none");
            }
        }
    });
});
