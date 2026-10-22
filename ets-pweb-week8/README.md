<p align="center">
  <img src="assets/img/icon/book.svg" width="72" height="72" alt="LibraryReg Logo" />
</p>

<h1 align="center">LibraryReg</h1>

<p align="center">
  <strong>Sistem Informasi & Pendaftaran Anggota Perpustakaan Kampus</strong><br>
  Aplikasi web pengelolaan pendaftaran mandiri pemustaka, dashboard administratif, serta generator kartu fisik anggota berstandar CR80.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Status-Production%20Ready-success?style=flat-square" alt="Status" />
  <img src="https://img.shields.io/badge/Platform-Web%20Browser-blue?style=flat-square" alt="Platform" />
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952b3?style=flat-square&logo=bootstrap&logoColor=white" alt="Bootstrap" />
  <img src="https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat-square&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/Deploy-Vercel-black?style=flat-square&logo=vercel" alt="Vercel" />
</p>

---

## 📌 Gambaran Umum

**LibraryReg** adalah aplikasi web modern yang dirancang untuk kebutuhan sirkulasi pendaftaran dan administrasi pemustaka di lingkungan perguruan tinggi. Sistem ini menyediakan antarmuka publik yang ramah pengguna untuk registrasi mandiri mahasiswa, dosen, dan staf, serta panel kendali komprehensif bagi petugas perpustakaan untuk mengelola data anggota, memantau statistik, dan menerbitkan kartu fisik pemustaka secara instan.

> [!NOTE]
> Sistem ini dibangun dengan arsitektur *client-side* murni berbasis HTML5, CSS3 kustom, dan Vanilla JavaScript. Seluruh mutasi data tersimpan secara aman dan persisten menggunakan peramban `localStorage` tanpa ketergantungan server database eksternal yang rumit.

---

## ✨ Fitur Utama

### 1. Portal Pendaftaran Mandiri (Public Registration)
* **Formulir Terstruktur:** Formulir pendaftaran publik yang memfasilitasi input NIM/NIP, nama lengkap, kontak (email & telepon), kategori pemustaka, fakultas/unit kerja, dan alamat domisili.
* **Auto-Generated Member ID:** Generator nomor induk anggota perpustakaan otomatis dengan format standar institusi (`LIB-XXXXXX`).
* **Umpan Balik Instan:** Notifikasi interaktif dan kartu rangkuman nomor anggota setelah formulir berhasil dikirimkan.

### 2. Panel Petugas & Manajemen Anggota (Admin Dashboard)
* **Autentikasi Petugas:** Halaman login khusus untuk pustakawan/administrator dengan validasi kredensial.
* **Statistik Real-Time:** Kartu metrik KPI interaktif yang menghitung jumlah total anggota, anggota berstatus aktif, proporsi mahasiswa, dan proporsi staf pengajar/peneliti secara dinamis.
* **Operasi CRUD Lengkap:**
  * Penambahan anggota baru dari panel petugas.
  * Pembaruan (*update*) profil, masa berlaku kartu, dan status keanggotaan (Aktif / Verifikasi / Non-Aktif).
  * Penghapusan rekaman anggota dengan konfirmasi modal pengaman.
* **Pencarian Cepat & Filter Multi-Kriteria:** Filter instan secara *real-time* berdasarkan kata kunci (nama, NIM, ID, fakultas), klasifikasi status, dan kategori peran.
* **Portabilitas Data:** Fitur ekspor basis data anggota ke file format JSON dan tombol pemulihan (*restore*) data contoh perguruan tinggi.

### 3. Generator Kartu Anggota CR80 (Physical Card Designer)
* **Standar Fisik ID-1/CR80:** Tata letak kartu dirancang presisi mengikuti standar kartu identitas ISO/IEC 7810 ID-1 (rasio 85.6mm × 53.98mm).
* **Tampilan Dua Sisi (Dual-Sided Preview):**
  * **Sisi Depan (*Front*):** Logo perpustakaan, pas foto/avatar inisial dinamis, data identitas, chip mikrokontroler grafis, hologram sekuritas, dan status masa berlaku.
  * **Sisi Belakang (*Back*):** Panel tanda tangan pemustaka bergaya tulisan tangan autentik (*Caveat font*), pita magnetik grafis (*magnetic stripe*), barcode mesin pemindai barcode (*Code 128 style*), serta pasal tata tertib pemustaka.
* **4 Pilihan Tema Kartu:**
  * 🔴 *Crimson Gold* (Klasik & Elegan)
  * 🟡 *Academic Gold* (Resmi & Prestisius)
  * ⚪ *Ivory Clean* (Minimalis Modern)
  * 🟢 *Emerald Green* (Natural & Eksklusif)
* **Mode Cetak Kartu Siap Pakai:** Dukungan pencetak dokumen terisolasi (*Isolated Card Print*) untuk langsung mencetak kartu ke mesin printer ID card atau menyimpannya ke format PDF.

---

## 🏗️ Struktur Direktori

```text
webFinal/
├── index.html                # Halaman beranda & formulir pendaftaran anggota
├── login.html                # Halaman autentikasi login petugas perpustakaan
├── admin.html                # Panel manajemen data anggota & perancang kartu CR80
├── vercel.json               # Konfigurasi deployment routing Vercel
│
└── assets/                   # Aset statis aplikasi
    ├── css/
    │   ├── admin.css         # Gaya kustom panel admin & komponen kartu CR80
    │   ├── index-custom.css  # Penyesuaian antarmuka halaman publik
    │   ├── main.css          # Basis tema styling & tipografi
    │   └── bootstrap.min.css # Framework CSS Bootstrap
    │
    ├── js/
    │   ├── admin.js          # Logika CRUD, pencarian, filter, dan kartu CR80
    │   ├── register.js       # Handler pendaftaran anggota dari portal publik
    │   ├── login.js          # Validasi kredensial login admin
    │   └── main.js           # Utilitas animasi antarmuka dan preloader
    │
    └── img/
        ├── icon/             # Ikon sistem (book.svg, favicon, dll.)
        ├── beranda/          # Ilustrasi dan materi promosi perpustakaan
        └── admin/            # Aset grafis khusus panel petugas
```

---

## 🚀 Panduan Menjalankan

### 1. Menjalankan Langsung di Browser
Cukup buka file `index.html` langsung di peramban web pilihan Anda.

### 2. Menggunakan Server Lokal
```bash
# Menggunakan Node.js
npx serve .

# Menggunakan Python
python -m http.server 3000
```
Akses di `http://localhost:3000`.

---

## 🔐 Kredensial Petugas Default

| Parameter | Kredensial |
| :--- | :--- |
| **Username** | `admin` |
| **Password** | `admin123` |

> [!IMPORTANT]
> Sistem autentikasi ini menggunakan validasi sisi klien (*client-side gatekeeping*) untuk tujuan demonstrasi akademis dan prototipe sistem. Seluruh data anggota tersimpan secara lokal pada peramban yang Anda gunakan.

---

## 🖨️ Tips Pencetakan Kartu Pemustaka (CR80)

> [!TIP]
> 1. Pada kotak dialog cetak browser (*Print Dialog*), pastikan mencentang opsi **"Background graphics"** (Grafis Latar Belakang) agar gradien warna tema, chip kartu, dan pita magnetik tercetak sempurna.
> 2. Atur ukuran kertas ke ukuran **CR80 / ID Card (85.6mm × 54mm)** jika menggunakan printer kartu khusus, atau gunakan ukuran **A4** dengan margin minimum jika mencetak pada kertas PVC transfer.
