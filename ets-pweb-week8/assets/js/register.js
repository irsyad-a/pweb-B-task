/**
 * LibraryReg - Member Registration Handler
 * Handles public member registration form submission and localStorage synchronization.
 */
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("memberRegisterForm");
    const alertBox = document.getElementById("regSuccessAlert");
    const alertInfo = document.getElementById("regSuccessInfo");

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const nim = document.getElementById("member_nim").value.trim();
            const name = document.getElementById("member_name").value.trim();
            const email = document.getElementById("member_email").value.trim();
            const phone = document.getElementById("member_phone").value.trim();
            const type = document.getElementById("member_type").value;
            const faculty = document.getElementById("member_faculty").value.trim();
            const address = document.getElementById("member_address").value.trim();

            const memberData = {
                id: "LIB-" + Date.now().toString().slice(-6),
                nim: nim,
                name: name,
                email: email,
                phone: phone,
                type: type,
                faculty: faculty,
                address: address,
                status: "Aktif",
                registeredAt: new Date().toLocaleDateString("id-ID", {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                })
            };

            let members = JSON.parse(localStorage.getItem("libraryreg_members")) || [];
            members.unshift(memberData);
            localStorage.setItem("libraryreg_members", JSON.stringify(members));

            if (alertBox && alertInfo) {
                alertInfo.innerHTML = "<strong>ID Anggota:</strong> " + memberData.id + " | <strong>Nama:</strong> " + memberData.name + " (" + memberData.nim + ") | <strong>Kategori:</strong> " + memberData.type;
                alertBox.classList.remove("d-none");
                alertBox.scrollIntoView({ behavior: "smooth", block: "center" });
            }

            form.reset();
        });
    }
});
