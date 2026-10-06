// Manajemen Siswa FTEIC ITS
document.addEventListener("DOMContentLoaded", function () {

    // ===== Mapping Departemen -> Prodi =====
    const dataDepartemenProdi = {
        "Teknik Elektro": ["Teknik Elektro", "Teknik Telekomunikasi"],
        "Teknik Informatika": ["Teknik Informatika", "Rekayasa Kecerdasan Artifisial", "Rekayasa Perangkat Lunak"],
        "Sistem Informasi": ["Sistem Informasi", "Inovasi Digital"],
        "Teknologi Informasi": ["Teknologi Informasi"],
        "Teknik Komputer": ["Teknik Komputer"],
        "Teknik Biomedik": ["Teknik Biomedik"]
    };

    // ===== Elemen =====
    const form = document.getElementById("formMahasiswa");
    const formTitle = document.getElementById("formTitle");
    const btnSubmit = document.getElementById("btnSubmit");
    const btnCancel = document.getElementById("btnCancel");
    const inputNama = document.getElementById("nama");
    const inputNrp = document.getElementById("nrp");
    const inputAlamat = document.getElementById("alamat");
    const inputEmail = document.getElementById("email");

    const departemenSelectr = new Selectr("#departemen");
    const prodiSelectr = new Selectr("#prodi");

    // ===== Data (disimpan di localStorage agar tidak hilang saat refresh) =====
    const STORAGE_KEY = "mahasiswa-fteic-its";
    const dataAwal = [
        { id: 1, nama: "Budi Santoso", nrp: "5024221001", departemen: "Teknik Komputer", prodi: "Teknik Komputer", alamat: "Sukolilo, Surabaya", email: "budi@its.ac.id" },
        { id: 2, nama: "Andi Pratama", nrp: "5025221055", departemen: "Teknik Informatika", prodi: "Rekayasa Perangkat Lunak", alamat: "Keputih, Surabaya", email: "andi@its.ac.id" },
        { id: 3, nama: "Siti Aminah", nrp: "5026221033", departemen: "Sistem Informasi", prodi: "Inovasi Digital", alamat: "Gebang, Surabaya", email: "siti@its.ac.id" }
    ];

    function loadData() {
        try {
            const saved = JSON.parse(localStorage.getItem(STORAGE_KEY));
            if (Array.isArray(saved)) return saved;
        } catch (e) { /* abaikan data rusak */ }
        return dataAwal.slice();
    }

    function saveData() {
        try { localStorage.setItem(STORAGE_KEY, JSON.stringify(mahasiswa)); } catch (e) { /* abaikan */ }
    }

    let mahasiswa = loadData();
    let editId = null;
    let dataTable = null;

    function nextId() {
        return mahasiswa.reduce(function (max, m) { return Math.max(max, m.id); }, 0) + 1;
    }

    function escapeHtml(str) {
        return String(str).replace(/[&<>"']/g, function (c) {
            return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c];
        });
    }

    // ===== Tabel =====
    function rowHtml(m) {
        const td = "p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400";
        return '<tr class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700">' +
            '<td class="p-3 text-sm font-medium whitespace-nowrap dark:text-white">' + escapeHtml(m.nama) + '</td>' +
            '<td class="' + td + '">' + escapeHtml(m.nrp) + '</td>' +
            '<td class="' + td + '">' + escapeHtml(m.departemen) + '</td>' +
            '<td class="' + td + '">' + escapeHtml(m.prodi) + '</td>' +
            '<td class="' + td + '">' + escapeHtml(m.alamat) + '</td>' +
            '<td class="' + td + '">' + escapeHtml(m.email) + '</td>' +
            '<td class="' + td + '">' +
                '<a href="#" class="btn-edit" data-id="' + m.id + '" title="Edit"><i class="ti ti-edit text-lg text-gray-500 dark:text-gray-400"></i></a> ' +
                '<a href="#" class="btn-hapus" data-id="' + m.id + '" title="Hapus"><i class="ti ti-trash text-lg text-red-500 dark:text-red-400"></i></a>' +
            '</td></tr>';
    }

    // Render ulang: hancurkan DataTable, isi tbody dari array, lalu buat lagi
    function renderTable() {
        if (dataTable) {
            dataTable.destroy();
            dataTable = null;
        }
        const tbody = document.querySelector("#datatable_1 tbody");
        tbody.innerHTML = mahasiswa.map(rowHtml).join("");
        dataTable = new simpleDatatables.DataTable("#datatable_1", {
            searchable: true,
            fixedHeight: false,
            perPage: 5,
            perPageSelect: false,
        });
    }

    // ===== Dropdown bertingkat =====
    function populateProdi(departemen, selected) {
        prodiSelectr.removeAll();
        const list = dataDepartemenProdi[departemen] || [];
        const options = [{ value: "", text: "Pilih Prodi" }].concat(
            list.map(function (p) { return { value: p, text: p }; })
        );
        prodiSelectr.add(options);
        if (selected) {
            prodiSelectr.setValue(selected);
        } else if (list.length === 1) {
            prodiSelectr.setValue(list[0]);
        } else {
            prodiSelectr.setValue("");
        }
    }

    departemenSelectr.on("selectr.change", function (option) {
        populateProdi(option ? option.value : "");
    });

    // ===== Form =====
    function resetForm() {
        form.reset();
        departemenSelectr.setValue("");
        populateProdi("");
        editId = null;
        formTitle.textContent = "Form Mahasiswa";
        btnSubmit.textContent = "Submit";
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const d = {
            nama: inputNama.value.trim(),
            nrp: inputNrp.value.trim(),
            departemen: document.getElementById("departemen").value,
            prodi: document.getElementById("prodi").value,
            alamat: inputAlamat.value.trim(),
            email: inputEmail.value.trim()
        };

        if (!d.nama || !d.nrp || !d.departemen || !d.prodi || !d.alamat || !d.email) {
            alert("Mohon lengkapi semua data.");
            return;
        }
        if (!inputEmail.checkValidity()) {
            alert("Format email tidak valid.");
            return;
        }
        const duplikat = mahasiswa.some(function (m) { return m.nrp === d.nrp && m.id !== editId; });
        if (duplikat) {
            alert("NRP sudah terdaftar.");
            return;
        }

        if (editId !== null) {
            const idx = mahasiswa.findIndex(function (m) { return m.id === editId; });
            if (idx !== -1) mahasiswa[idx] = Object.assign({ id: editId }, d);
        } else {
            mahasiswa.push(Object.assign({ id: nextId() }, d));
        }

        saveData();
        renderTable();
        resetForm();
    });

    btnCancel.addEventListener("click", resetForm);

    // ===== Edit & Hapus (delegasi event, tetap jalan setelah paging/search) =====
    document.addEventListener("click", function (e) {
        const edit = e.target.closest(".btn-edit");
        const hapus = e.target.closest(".btn-hapus");
        if (!edit && !hapus) return;
        e.preventDefault();

        const id = Number((edit || hapus).dataset.id);
        const m = mahasiswa.find(function (x) { return x.id === id; });
        if (!m) return;

        if (hapus) {
            if (confirm('Hapus data "' + m.nama + '"?')) {
                mahasiswa = mahasiswa.filter(function (x) { return x.id !== id; });
                saveData();
                renderTable();
                if (editId === id) resetForm();
            }
            return;
        }

        editId = id;
        inputNama.value = m.nama;
        inputNrp.value = m.nrp;
        inputAlamat.value = m.alamat;
        inputEmail.value = m.email;
        departemenSelectr.setValue(m.departemen);
        populateProdi(m.departemen, m.prodi);
        formTitle.textContent = "Edit Mahasiswa";
        btnSubmit.textContent = "Simpan";
        window.scrollTo({ top: 0, behavior: "smooth" });
        inputNama.focus();
    });

    // ===== Mulai =====
    renderTable();
});
