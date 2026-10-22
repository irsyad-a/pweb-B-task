/**
 * LibraryReg - Administration & Member Management Module
 * External JavaScript module handling catalog search, category filtering,
 * member record mutation, localStorage synchronization, and CR80 card generation.
 */

const STORAGE_KEY = "libraryreg_members";

// Default academic membership fixtures for testing and initial bootstrap
const DEFAULT_ACADEMIC_MEMBERS = [
    {
        id: "LIB-525124",
        nim: "5025251243",
        name: "Irsyad Akbar",
        email: "irsyad.akbar@student.univ.ac.id",
        phone: "081234567890",
        type: "Mahasiswa S1",
        faculty: "Teknik Informatika",
        address: "Asrama Mahasiswa Kampus Terpadu, Blok B No. 12",
        status: "Aktif",
        validity: "31 Desember 2027",
        registeredAt: "20 Oktober 2026, 09:30"
    },
    {
        id: "LIB-419082",
        nim: "5024201099",
        name: "Nabila Annisa Putri",
        email: "nabila.putri@student.univ.ac.id",
        phone: "082198765432",
        type: "Mahasiswa S1",
        faculty: "Sistem Informasi",
        address: "Jl. Gebang Wetan No. 45, Sukolilo",
        status: "Aktif",
        validity: "31 Desember 2027",
        registeredAt: "19 Oktober 2026, 14:15"
    },
    {
        id: "LIB-109283",
        nim: "198504122010121002",
        name: "Dr. Eng. Ir. Budi Santoso, M.Kom.",
        email: "budi.santoso@lecturer.univ.ac.id",
        phone: "081122334455",
        type: "Dosen / Peneliti",
        faculty: "Fakultas Teknologi Elektro dan Informatika Cerdas",
        address: "Perumahan Dosen Kampus Baru, Blok D-8",
        status: "Aktif",
        validity: "31 Desember 2029",
        registeredAt: "15 Oktober 2026, 11:00"
    },
    {
        id: "LIB-837492",
        nim: "5021202001",
        name: "Dimas Aditya Pratama",
        email: "dimas.aditya@alumni.univ.ac.id",
        phone: "085712349988",
        type: "Mahasiswa Pascasarjana (S2/S3)",
        faculty: "Magister Teknik Informatika",
        address: "Jl. Menur Pumpungan Gang 2 No. 17",
        status: "Aktif",
        validity: "31 Desember 2026",
        registeredAt: "12 Oktober 2026, 16:45"
    },
    {
        id: "LIB-650193",
        nim: "199208152018012003",
        name: "Siti Rahmawati, S.Kom.",
        email: "siti.rahma@staff.univ.ac.id",
        phone: "087899001122",
        type: "Tenaga Kependidikan",
        faculty: "Direktorat Administrasi & Kemahasiswaan",
        address: "Jl. Manyar Sabrangan No. 88",
        status: "Aktif",
        validity: "31 Desember 2028",
        registeredAt: "10 Oktober 2026, 10:20"
    }
];

let deleteTargetId = null;
let deleteBootstrapModal = null;

document.addEventListener("DOMContentLoaded", function () {
    // Seed localStorage on initial load if no membership records exist
    let localData = localStorage.getItem(STORAGE_KEY);
    if (!localData || JSON.parse(localData).length === 0) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(DEFAULT_ACADEMIC_MEMBERS));
    }

    const modalDom = document.getElementById("modalConfirmDelete");
    if (modalDom) {
        deleteBootstrapModal = new bootstrap.Modal(modalDom);
    }

    renderMembersTableList();
    populateCardTargetDropdown();

    const members = fetchAllMembers();
    if (members.length > 0) {
        renderCardPreview(members[0]);
    }
});

function fetchAllMembers() {
    try {
        const stored = localStorage.getItem(STORAGE_KEY);
        return stored ? JSON.parse(stored) : [];
    } catch (err) {
        console.error("Gagal membaca localStorage", err);
        return [];
    }
}

function persistMembers(members) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(members));
    renderMembersTableList();
    populateCardTargetDropdown();
}

/* --- Member Catalog Search & Table Rendering --- */
function renderMembersTableList(customList = null) {
    const allMembers = fetchAllMembers();
    const listToRender = customList !== null ? customList : allMembers;

    const tbody = document.getElementById("memberTableBodyContainer");
    const emptyNotice = document.getElementById("emptySearchNotice");
    const shownCountNum = document.getElementById("shownCountNum");
    const totalCountNum = document.getElementById("totalCountNum");

    updateOverviewStats(allMembers);

    if (shownCountNum) shownCountNum.innerText = listToRender.length;
    if (totalCountNum) totalCountNum.innerText = allMembers.length;

    if (!tbody) return;

    if (listToRender.length === 0) {
        tbody.innerHTML = "";
        if (emptyNotice) emptyNotice.classList.remove("d-none");
        return;
    }

    if (emptyNotice) emptyNotice.classList.add("d-none");
    tbody.innerHTML = "";

    listToRender.forEach((m, idx) => {
        const tr = document.createElement("tr");

        const initials = (m.name || "A").split(" ").slice(0, 2).map(w => w[0]).join("").toUpperCase();

        let statusBadge = '<span class="badge-status-pill">Aktif</span>';
        if (m.status === "Menunggu Verifikasi") {
            statusBadge = '<span class="badge-academic text-warning border-warning">Verifikasi</span>';
        } else if (m.status === "Non-Aktif") {
            statusBadge = '<span class="badge-academic text-danger border-danger">Non-Aktif</span>';
        }

        tr.innerHTML = `
            <td class="text-muted fw-bold">${idx + 1}</td>
            <td>
                <strong class="font-monospace text-dark">${m.id}</strong>
                <div class="text-muted small" style="font-size: 11px;">${m.registeredAt || '-'}</div>
            </td>
            <td>
                <div class="d-flex align-items-center gap-3">
                    <div class="member-avatar-circle">${initials}</div>
                    <div>
                        <div class="fw-bold" style="color: var(--color-heading);">${sanitize(m.name)}</div>
                        <div class="text-muted small">${sanitize(m.email)}</div>
                    </div>
                </div>
            </td>
            <td>
                <span class="font-monospace fw-semibold">${sanitize(m.nim)}</span>
            </td>
            <td>
                <span class="badge-academic mb-1">${sanitize(m.type)}</span>
                <div class="small text-muted">${sanitize(m.faculty)}</div>
            </td>
            <td>
                <div class="small"><i class="far fa-phone text-muted me-1"></i> ${sanitize(m.phone)}</div>
                <div class="small text-muted text-truncate" style="max-width: 140px;" title="${sanitize(m.address)}">
                    <i class="far fa-map-marker-alt me-1"></i> ${sanitize(m.address)}
                </div>
            </td>
            <td>${statusBadge}</td>
            <td class="text-center">
                <button class="btn-table-action" title="Edit Data Anggota" onclick="triggerEditMember('${m.id}')">
                    <i class="far fa-edit"></i>
                </button>
                <button class="btn-table-action" title="Cetak Kartu Pemustaka" onclick="triggerCardPrint('${m.id}')">
                    <i class="far fa-id-card"></i>
                </button>
                <button class="btn-table-action delete-btn" title="Hapus Anggota" onclick="triggerDeleteModal('${m.id}')">
                    <i class="far fa-trash-alt"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function performLiveSearch() {
    const query = document.getElementById("searchInputField").value.trim().toLowerCase();
    const category = document.getElementById("categorySelectFilter").value;
    const status = document.getElementById("statusSelectFilter").value;

    const all = fetchAllMembers();

    const result = all.filter(item => {
        const matchesQuery = !query ||
            (item.name && item.name.toLowerCase().includes(query)) ||
            (item.nim && item.nim.toLowerCase().includes(query)) ||
            (item.id && item.id.toLowerCase().includes(query)) ||
            (item.email && item.email.toLowerCase().includes(query)) ||
            (item.faculty && item.faculty.toLowerCase().includes(query));

        const matchesCategory = (category === "ALL") || (item.type === category);
        const matchesStatus = (status === "ALL") || (item.status === status);

        return matchesQuery && matchesCategory && matchesStatus;
    });

    renderMembersTableList(result);
}

function resetAllFilters() {
    document.getElementById("searchInputField").value = "";
    document.getElementById("categorySelectFilter").value = "ALL";
    document.getElementById("statusSelectFilter").value = "ALL";
    renderMembersTableList();
}

function restoreSampleData() {
    if (confirm("Muat ulang data contoh pemustaka perguruan tinggi? Data saat ini akan diganti dengan data sampel resmi.")) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(DEFAULT_ACADEMIC_MEMBERS));
        renderMembersTableList();
        populateCardTargetDropdown();
        if (DEFAULT_ACADEMIC_MEMBERS.length > 0) {
            renderCardPreview(DEFAULT_ACADEMIC_MEMBERS[0]);
        }
        displayFeedback("Data sampel pemustaka perpustakaan berhasil dimuat kembali!", "success");
    }
}

function exportMembersToJson() {
    const list = fetchAllMembers();
    const blobStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(list, null, 2));
    const dlAnchor = document.createElement("a");
    dlAnchor.setAttribute("href", blobStr);
    dlAnchor.setAttribute("download", `libraryreg_anggota_${Date.now()}.json`);
    document.body.appendChild(dlAnchor);
    dlAnchor.click();
    dlAnchor.remove();
    displayFeedback("Data anggota perpustakaan berhasil diekspor ke format JSON.", "info");
}

function updateOverviewStats(members) {
    const totalEl = document.getElementById("statTotalDisplay");
    const mhsEl = document.getElementById("statMahasiswaDisplay");
    const dosenEl = document.getElementById("statDosenDisplay");
    const readyEl = document.getElementById("statCardReadyDisplay");

    if (totalEl) totalEl.innerText = members.length;

    const mhs = members.filter(m => m.type && (m.type.includes("Mahasiswa") || m.type.includes("S1") || m.type.includes("S2"))).length;
    if (mhsEl) mhsEl.innerText = mhs;

    const dosen = members.filter(m => m.type && (m.type.includes("Dosen") || m.type.includes("Tenaga") || m.type.includes("Peneliti"))).length;
    if (dosenEl) dosenEl.innerText = dosen;

    const ready = members.filter(m => m.status === "Aktif").length;
    if (readyEl) readyEl.innerText = ready;
}

/* --- Member Record Form Operations (Create & Update) --- */
function triggerEditMember(memberId) {
    const list = fetchAllMembers();
    const target = list.find(m => m.id === memberId);
    if (!target) return;

    document.getElementById("field_id").value = target.id;
    document.getElementById("field_nim").value = target.nim || "";
    document.getElementById("field_name").value = target.name || "";
    document.getElementById("field_type").value = target.type || "Mahasiswa S1";
    document.getElementById("field_faculty").value = target.faculty || "";
    document.getElementById("field_status").value = target.status || "Aktif";
    document.getElementById("field_email").value = target.email || "";
    document.getElementById("field_phone").value = target.phone || "";
    document.getElementById("field_validity").value = target.validity || "31 Desember 2027";
    document.getElementById("field_address").value = target.address || "";

    const badge = document.getElementById("editTargetBadge");
    if (badge) {
        badge.innerHTML = `
            <span class="badge-academic fw-bold" style="background-color: var(--color-primary); color: #170006;">
                <i class="far fa-edit me-1"></i> Mengedit: ${sanitize(target.name)} (${target.id})
            </span>
        `;
    }

    document.getElementById("section-edit").scrollIntoView({ behavior: "smooth", block: "start" });
}

function submitMemberData(e) {
    e.preventDefault();

    const id = document.getElementById("field_id").value.trim();
    const nim = document.getElementById("field_nim").value.trim();
    const name = document.getElementById("field_name").value.trim();
    const type = document.getElementById("field_type").value;
    const faculty = document.getElementById("field_faculty").value.trim();
    const status = document.getElementById("field_status").value;
    const email = document.getElementById("field_email").value.trim();
    const phone = document.getElementById("field_phone").value.trim();
    const validity = document.getElementById("field_validity").value.trim() || "31 Desember 2027";
    const address = document.getElementById("field_address").value.trim();

    if (!nim || !name || !email) {
        alert("Mohon lengkapi semua field bertanda bintang (*)");
        return;
    }

    let members = fetchAllMembers();
    const idx = members.findIndex(m => m.id === id);

    if (idx > -1) {
        members[idx] = {
            ...members[idx],
            nim,
            name,
            type,
            faculty,
            status,
            email,
            phone,
            validity,
            address
        };
        displayFeedback(`Data pemustaka <strong>${sanitize(name)}</strong> (${id}) berhasil diperbarui!`, "success");
    } else {
        const newMember = {
            id: id || ("LIB-" + Math.floor(100000 + Math.random() * 900000)),
            nim,
            name,
            type,
            faculty,
            status,
            email,
            phone,
            validity,
            address,
            registeredAt: new Date().toLocaleDateString("id-ID", {
                year: "numeric",
                month: "short",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit"
            })
        };
        members.unshift(newMember);
        displayFeedback(`Anggota baru <strong>${sanitize(name)}</strong> berhasil didaftarkan ke sistem!`, "success");
    }

    persistMembers(members);
    renderCardPreview({ id, nim, name, type, faculty, status, validity });
    resetFormEditor();
}

function resetFormEditor() {
    document.getElementById("formMemberEditor").reset();
    document.getElementById("field_id").value = "";
    const badge = document.getElementById("editTargetBadge");
    if (badge) {
        badge.innerHTML = `
            <span class="badge-academic">
                <i class="far fa-user me-1"></i> Mode: Tambah Anggota Baru
            </span>
        `;
    }
}

function triggerDeleteModal(memberId) {
    const list = fetchAllMembers();
    const m = list.find(item => item.id === memberId);
    if (!m) return;

    deleteTargetId = memberId;
    document.getElementById("modalDeleteTargetName").innerText = m.name;
    document.getElementById("modalDeleteTargetDetails").innerText = `NIM/NIP: ${m.nim} | ID: ${m.id} | Kategori: ${m.type}`;

    document.getElementById("btnExecuteDelete").onclick = executeDeleteMember;

    if (deleteBootstrapModal) {
        deleteBootstrapModal.show();
    }
}

function executeDeleteMember() {
    if (!deleteTargetId) return;

    let members = fetchAllMembers();
    const item = members.find(m => m.id === deleteTargetId);
    const deletedName = item ? item.name : deleteTargetId;

    members = members.filter(m => m.id !== deleteTargetId);
    persistMembers(members);

    if (deleteBootstrapModal) {
        deleteBootstrapModal.hide();
    }

    displayFeedback(`Data anggota <strong>${sanitize(deletedName)}</strong> telah dihapus.`, "danger");
    deleteTargetId = null;
}

/* --- CR80 Physical Card Rendering & Print Orchestration --- */
function populateCardTargetDropdown() {
    const selectEl = document.getElementById("selectCardTargetMember");
    if (!selectEl) return;
    const members = fetchAllMembers();

    selectEl.innerHTML = "";

    if (members.length === 0) {
        const opt = document.createElement("option");
        opt.value = "";
        opt.text = "-- Belum ada data anggota --";
        selectEl.appendChild(opt);
        return;
    }

    members.forEach(m => {
        const opt = document.createElement("option");
        opt.value = m.id;
        opt.text = `${m.name} (${m.nim}) - ${m.type}`;
        selectEl.appendChild(opt);
    });
}

function applyMemberToCard(memberId) {
    const list = fetchAllMembers();
    const found = list.find(m => m.id === memberId);
    if (found) {
        renderCardPreview(found);
    }
}

function triggerCardPrint(memberId) {
    const list = fetchAllMembers();
    const target = list.find(m => m.id === memberId);
    if (!target) return;

    const selectEl = document.getElementById("selectCardTargetMember");
    if (selectEl) selectEl.value = memberId;
    renderCardPreview(target);

    document.getElementById("section-cetak").scrollIntoView({ behavior: "smooth", block: "start" });
}

let currentCardTheme = "crimson";

function setCardTheme(themeName) {
    currentCardTheme = themeName;
    const frontCard = document.getElementById("cardFrontView");
    const backCard = document.getElementById("cardBackView");

    const validThemes = ["crimson", "gold", "ivory", "green"];
    validThemes.forEach(t => {
        if (frontCard) frontCard.classList.remove(`card-theme-${t}`);
        if (backCard) backCard.classList.remove(`card-theme-${t}`);
        const btn = document.getElementById(`btnTheme${t.charAt(0).toUpperCase() + t.slice(1)}`);
        if (btn) btn.classList.remove("active");
    });

    if (frontCard) frontCard.classList.add(`card-theme-${themeName}`);
    if (backCard) backCard.classList.add(`card-theme-${themeName}`);

    const activeBtn = document.getElementById(`btnTheme${themeName.charAt(0).toUpperCase() + themeName.slice(1)}`);
    if (activeBtn) activeBtn.classList.add("active");
}

function renderCardPreview(m) {
    if (!m) return;

    const nameEl = document.getElementById("cardUserNameText");
    const nimEl = document.getElementById("cardUserNimText");
    const idEl = document.getElementById("cardUserIdText");
    const typeEl = document.getElementById("cardUserTypeText");
    const typeBadgeEl = document.getElementById("cardUserTypeBadge");
    const facultyEl = document.getElementById("cardUserFacultyText");
    const validityEl = document.getElementById("cardUserValidityText");
    const statusEl = document.getElementById("cardUserStatusText");
    const avatarEl = document.getElementById("cardAvatarBox");
    const signatureEl = document.getElementById("cardSignatureName");
    const barcodeReadableEl = document.getElementById("cardBarcodeReadable");

    if (nameEl) nameEl.innerText = (m.name || "NAMA PEMUSTAKA").toUpperCase();
    if (nimEl) nimEl.innerText = m.nim || "0000000000";
    if (idEl) idEl.innerText = m.id || "LIB-000000";
    if (typeEl) typeEl.innerText = m.type || "Mahasiswa";
    if (typeBadgeEl) typeBadgeEl.innerText = (m.type || "MAHASISWA").toUpperCase();
    if (facultyEl) facultyEl.innerText = m.faculty || "-";
    if (validityEl) validityEl.innerText = (m.validity || "31 DESEMBER 2027").toUpperCase();

    if (signatureEl) {
        signatureEl.innerText = m.name || "Irsyad Akbar";
    }

    if (barcodeReadableEl) {
        const cleanDigits = (m.nim || "5025251243").replace(/\D/g, "");
        const part1 = cleanDigits.slice(0, 5).padEnd(5, "0");
        const part2 = cleanDigits.slice(-4).padEnd(4, "1");
        barcodeReadableEl.innerText = `2 1172 ${part1} ${part2}`;
    }

    if (statusEl) {
        statusEl.innerText = (m.status || "AKTIF").toUpperCase();
        if (m.status === "Aktif") {
            statusEl.className = "text-success fw-bold";
        } else if (m.status === "Menunggu Verifikasi") {
            statusEl.className = "text-warning fw-bold";
        } else {
            statusEl.className = "text-danger fw-bold";
        }
    }

    const inits = (m.name || "IA").split(" ").slice(0, 2).map(w => w[0]).join("").toUpperCase();
    if (avatarEl) avatarEl.innerText = inits;
}

function executePrintCard() {
    window.print();
}

function executeIsolatedCardPrint() {
    const frontEl = document.getElementById("cardFrontView");
    const backEl = document.getElementById("cardBackView");
    if (!frontEl || !backEl) {
        window.print();
        return;
    }

    const frontHtml = frontEl.outerHTML;
    const backHtml = backEl.outerHTML;
    const nameEl = document.getElementById("cardUserNameText");
    const memberName = nameEl ? nameEl.innerText : "Pemustaka";
    const nim = document.getElementById("cardUserNimText") ? document.getElementById("cardUserNimText").innerText : "-";
    const idNum = document.getElementById("cardUserIdText") ? document.getElementById("cardUserIdText").innerText : "LIB-000000";
    const faculty = document.getElementById("cardUserFacultyText") ? document.getElementById("cardUserFacultyText").innerText : "-";
    const validity = document.getElementById("cardUserValidityText") ? document.getElementById("cardUserValidityText").innerText : "31 DESEMBER 2027";
    const type = document.getElementById("cardUserTypeBadge") ? document.getElementById("cardUserTypeBadge").innerText : "MAHASISWA";

    const printWin = window.open("", "_blank", "width=960,height=850");
    if (!printWin) {
        window.print();
        return;
    }

    printWin.document.open();
    printWin.document.write(`<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak KTA - ${memberName}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=DM+Mono:wght@500;700&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        @page {
            size: A4 portrait;
            margin: 8mm 10mm;
        }
        *, *::before, *::after {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
            box-sizing: border-box;
        }
        body {
            background-color: #EDEBE3;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .screen-toolbar {
            width: 100%;
            max-width: 860px;
            background: #FFFFFF;
            border: 1px solid #D2CFC0;
            border-radius: 12px;
            padding: 14px 20px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }
        .toolbar-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-print-action {
            background: #5C101B;
            color: #FFFFFF;
            border: none;
            padding: 10px 24px;
            border-radius: 7px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }
        .btn-print-action:hover {
            background: #7E1927;
            transform: translateY(-1px);
        }
        .toolbar-tip {
            background: #FFF3CD;
            border: 1.5px solid #FFEAA7;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 12.5px;
            color: #7A5700;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .print-paper-sheet {
            background: #FFFFFF;
            width: 210mm;
            min-height: 297mm;
            padding: 12mm 14mm;
            border: 1px solid #D2CFC0;
            border-radius: 8px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            margin: 0 auto;
            box-sizing: border-box;
        }
        .sheet-masthead {
            text-align: center;
            border-bottom: 2px solid #170006;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .sheet-masthead h1 {
            font-size: 16.5px;
            font-weight: 800;
            color: #170006;
            margin: 0;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }
        .sheet-masthead p {
            font-size: 10.5px;
            color: #4A4A4A;
            margin: 3px 0 0 0;
        }
        .cards-row-layout {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 16px;
        }
        .cut-card-box {
            background: #FAFAFA;
            border: 1.5px dashed #444444;
            border-radius: 6px;
            padding: 6px;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
        }
        .cut-marker-title {
            width: 100%;
            display: flex;
            justify-content: space-between;
            font-size: 8.5px;
            font-weight: 700;
            font-family: 'DM Mono', monospace;
            color: #222222;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }
        .card-scaler-cr80 {
            width: 85.6mm;
            height: 54mm;
            overflow: hidden;
            position: relative;
            border-radius: 3.18mm;
            border: 1.5px solid #000000;
            box-sizing: border-box;
            background: #FFFFFF;
        }
        .card-scaler-cr80 .univ-id-card {
            width: 428px !important;
            height: 270px !important;
            transform: scale(0.7558);
            transform-origin: top left;
            box-shadow: none !important;
            border: none !important;
            border-radius: 0 !important;
            margin: 0 !important;
        }
        .fold-guideline-bar {
            width: 100%;
            margin: 18px 0;
            border-top: 1.5px dashed #888888;
            text-align: center;
            position: relative;
        }
        .fold-guideline-bar span {
            background: #FFFFFF;
            padding: 0 14px;
            font-size: 9.5px;
            color: #555555;
            position: relative;
            top: -8.5px;
            font-weight: 600;
        }
        .member-dossier-box {
            background: #FAFAF7;
            border: 1px solid #DCDCD0;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 14px;
        }
        .dossier-title {
            font-size: 9.5px;
            font-weight: 800;
            color: #170006;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
            border-bottom: 1px solid #E5E5D8;
            padding-bottom: 4px;
        }
        .dossier-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5px;
        }
        .dossier-table td {
            padding: 3px 6px;
            vertical-align: top;
        }
        .d-label {
            width: 18%;
            color: #666666;
            font-size: 9.5px;
        }
        .d-val {
            width: 32%;
            color: #170006;
        }
        .sheet-instructions {
            background: #FDFDFB;
            border: 1px dashed #C8C5B6;
            border-radius: 6px;
            padding: 10px 14px;
            font-size: 10px;
            color: #555555;
            line-height: 1.45;
        }
        .sheet-instructions strong {
            color: #170006;
        }
        .sheet-instructions ol {
            margin: 4px 0 0 0;
            padding-left: 18px;
        }
        @media print {
            body {
                background: #FFFFFF !important;
                padding: 0 !important;
            }
            .screen-toolbar {
                display: none !important;
            }
            .print-paper-sheet {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                width: 100% !important;
                min-height: auto !important;
            }
        }
    </style>
</head>
<body>
    <div class="screen-toolbar">
        <div class="toolbar-top">
            <div>
                <strong style="color: #170006; font-size: 15px;">Pratinjau Lembar Cetak KTA Standar CR80 Presisi</strong>
                <div style="font-size: 12px; color: #555;">Ukuran fisik presisi 85.6 mm × 54.0 mm tanpa bagian terpotong.</div>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="button" class="btn-print-action" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak / Simpan PDF (Ctrl+P)
                </button>
            </div>
        </div>
        <div class="toolbar-tip">
            <i class="fas fa-exclamation-triangle" style="font-size: 15px; flex-shrink: 0;"></i>
            <span><strong>PENTING:</strong> Pada jendela print peramban di panel kanan, pastikan mencentang kotak <u><strong>"Background graphics" (Grafik latar belakang)</strong></u> agar warna kartu dan stiker barcode tercetak utuh!</span>
        </div>
    </div>
    <div class="print-paper-sheet">
        <div class="sheet-masthead">
            <h1>UPT PERPUSTAKAAN PERGURUAN TINGGI</h1>
            <p>Lembar Cetak Kartu Tanda Anggota (KTA) &bull; Format Standar ISO/IEC 7810 ID-1 (CR80: 85.6 mm × 54.0 mm)</p>
        </div>
        <div class="cards-row-layout">
            <div class="cut-card-box">
                <div class="cut-marker-title">
                    <span>✂ GARIS POTONG - TAMPAK DEPAN</span>
                    <span>85.6 × 54.0 mm</span>
                </div>
                <div class="card-scaler-cr80">
                    ${frontHtml}
                </div>
            </div>
            <div class="cut-card-box">
                <div class="cut-marker-title">
                    <span>✂ GARIS POTONG - TAMPAK BELAKANG</span>
                    <span>85.6 × 54.0 mm</span>
                </div>
                <div class="card-scaler-cr80">
                    ${backHtml}
                </div>
            </div>
        </div>
        <div class="fold-guideline-bar">
            <span>✂ Gunting sepanjang garis putus-putus di atas, rekatkan kedua sisi (bolak-balik), lalu laminasi ✂</span>
        </div>

        <div class="member-dossier-box">
            <div class="dossier-title">Lembar Verifikasi Data Anggota Terdaftar</div>
            <table class="dossier-table">
                <tr>
                    <td class="d-label">Nama Pemustaka</td>
                    <td class="d-val"><strong>${memberName}</strong></td>
                    <td class="d-label">Nomor Induk (NIM/NIP)</td>
                    <td class="d-val"><strong>${nim}</strong></td>
                </tr>
                <tr>
                    <td class="d-label">ID Sirkulasi</td>
                    <td class="d-val">${idNum}</td>
                    <td class="d-label">Kategori Anggota</td>
                    <td class="d-val">${type} &bull; <strong style="color: #145939;">AKTIF</strong></td>
                </tr>
                <tr>
                    <td class="d-label">Program Studi / Unit</td>
                    <td class="d-val">${faculty}</td>
                    <td class="d-label">Masa Berlaku KTA</td>
                    <td class="d-val">${validity}</td>
                </tr>
            </table>
        </div>

        <div class="sheet-instructions">
            <strong>Petunjuk Pembuatan Fisik KTA Perpustakaan:</strong>
            <ol>
                <li>Gunakan kertas karton tebal/art paper (minimal 210-260 gsm) atau kertas stiker PVC khusus ID card.</li>
                <li>Pada jendela print, pastikan <strong>Scale (Skala)</strong> diatur ke <strong>100% (Default)</strong> agar ukuran kartu tepat sesuai standar internasional CR80 (85.6 mm × 54.0 mm).</li>
                <li>Pastikan opsi <strong>"Background graphics" (Grafik latar belakang)</strong> dicentang agar palet warna dan barcode tercetak tajam.</li>
                <li>Gunting kedua sisi kartu mengikuti garis panduan putus-putus, satukan bolak-balik, lalu laminasi dengan plastik pouch laminating tebal.</li>
            </ol>
        </div>
    </div>
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 800);
        };
    <\/script>
</body>
</html>`);
    printWin.document.close();
}

/* --- Feedback Notifications & Utility Helpers --- */
function displayFeedback(msg, type = "success") {
    const box = document.getElementById("actionAlertFeedback");
    const text = document.getElementById("feedbackMessageText");

    if (!box || !text) return;

    box.className = `alert alert-${type} alert-dismissible fade show`;
    text.innerHTML = msg;
    box.classList.remove("d-none");

    box.scrollIntoView({ behavior: "smooth", block: "nearest" });

    setTimeout(() => {
        dismissFeedbackAlert();
    }, 5000);
}

function dismissFeedbackAlert() {
    const box = document.getElementById("actionAlertFeedback");
    if (!box) return;
    box.classList.remove("show");
    setTimeout(() => {
        box.classList.add("d-none");
    }, 200);
}

function sanitize(str) {
    if (!str) return "";
    return str
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
