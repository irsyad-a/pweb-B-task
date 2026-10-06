# PWEB - Form dan Frame (Tugas Manajemen Siswa)

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)

Proyek ini adalah implementasi tugas mata kuliah **Pemrograman Web (PWEB)** dengan materi **Form dan Frame**, yang diberikan oleh Bapak [Fajar Baskoro](https://fajarbaskoro.blogspot.com/2024/09/pweb-form-dan-frame.html). Proyek ini merupakan aplikasi web sederhana untuk **Manajemen Siswa FTEIC ITS** yang menggunakan formulir HTML untuk mengumpulkan data mahasiswa dan menampilkannya dalam bentuk tabel yang interaktif.

## 📖 Tentang Materi

HTML form atau formulir HTML adalah elemen HTML yang berfungsi untuk mengumpulkan masukan dari pengguna web. Formulir HTML merupakan fitur yang dibutuhkan website untuk mengumpulkan informasi, seperti pendaftaran, login, dan pengumpulan feedback.

Formulir HTML dapat digunakan untuk:
- Mengonfigurasi permintaan HTTP untuk mengirim data ke server
- Memastikan pengguna mendapatkan pengalaman mengunjungi website yang nyaman dan aman
- Mengumpulkan data-data pengunjung website untuk disimpan dalam database

## ✨ Fitur

- **Formulir Pendaftaran Mahasiswa**: Input data meliputi Nama, NRP, Departemen, Prodi, Alamat, dan Email.
- **Validasi Data**: Memastikan semua field diisi dengan benar sebelum data disubmit.
- **Tabel Data Dinamis**: Menampilkan data mahasiswa yang telah diinput menggunakan Simple DataTables.
- **Fitur CRUD Penuh**:
  - **Create**: Menambah data mahasiswa baru.
  - **Read**: Melihat daftar mahasiswa dengan fitur pencarian dan paginasi (5 data per halaman).
  - **Update**: Mengedit data mahasiswa yang sudah ada di dalam tabel.
  - **Delete**: Menghapus data mahasiswa dari tabel.
- **Penyimpanan Lokal (Local Storage)**: Data tidak akan hilang ketika halaman di-refresh.
- **Mode Gelap/Terang (Dark/Light Mode)**: Dukungan tema UI modern yang nyaman di mata.
- **Dropdown Dinamis**: Pilihan Prodi akan otomatis menyesuaikan dengan Departemen yang dipilih.

## 🚀 Quick Start / Cara Menjalankan

Karena proyek ini murni dibangun menggunakan HTML, CSS, dan Vanilla JavaScript (tanpa backend atau database eksternal), Anda tidak perlu menginstal server apa pun.

1. Clone repositori ini atau unduh folder proyek:
   ```bash
   git clone <url-repo-anda>
   ```
2. Buka folder `tugasWeb`.
3. Klik ganda pada file `index.html` untuk membukanya di browser pilihan Anda (Chrome, Firefox, Edge, Safari).

## 🛠️ Struktur Proyek

```text
tugasWeb/
├── index.html          # File HTML utama (Layout, Form, Table)
├── assets/
│   ├── css/
│   │   ├── style.css   # Custom styling
│   │   └── ...         # File CSS framework lainnya
│   ├── js/
│   │   ├── script.js   # Logika CRUD, Validasi, dan inisialisasi plugin
│   │   └── app.js      # Script utilitas template (Dark mode, dll)
│   ├── libs/           # Library eksternal (SimpleDatatables, Selectr, dll)
│   ├── fonts/          # File font ikon (Feather)
│   └── images/         # Aset gambar/favicon
```

## 📚 Referensi Pembelajaran

Proyek ini dibangun berdasarkan referensi materi berikut:
- [JavaTpoint - HTML Registration Form](https://www.javatpoint.com/html-registration-form)
- [PetaniKode - HTML Form](https://www.petanikode.com/html-form/)
- [W3Schools - CSS Register Form](https://www.w3schools.com/howto/howto_css_register_form.asp)
- [SlideShare - HTML Penggunaan Form, Frame, dan Hyperlink](https://www.slideshare.net/slideshow/html-penggunaan-form-frame-dan-hyperlink/271863998)
- [GeeksForGeeks - HTML Registration Form](https://www.geeksforgeeks.org/html-registration-form/)
- [GeeksForGeeks - How to Create Frames](https://www.geeksforgeeks.org/html/how-to-create-frames/)
- [MalasNgoding - Membuat Layout Website Sederhana](https://www.malasngoding.com/membuat-tampilan-layout-website-sederhana-dengan-html-dan-css/)
- [Repository UNIKOM - Membuat Frame / Bingkai Layar](https://repository.unikom.ac.id/67687/1/Materi%206.%20Membuat%20Frame%20-%20Bingkai%20Layar.pdf)

---
*Dibuat untuk memenuhi tugas mata kuliah PWEB.*
