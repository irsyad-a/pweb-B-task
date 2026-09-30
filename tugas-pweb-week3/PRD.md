# PRODUCT REQUIREMENTS DOCUMENT (PRD)

## Website Profil Sekolah MAN IC Bangka Tengah

---

## 1. Informasi Produk

| Item | Detail |
|---|---|
| Nama Produk | Website Profil Sekolah MAN IC Bangka Tengah |
| Jenis Produk | Website Informasi dan Profil Institusi Pendidikan |
| Objek Website | MAN IC Bangka Tengah atau Madrasah Aliyah Negeri Insan Cendekia Bangka Tengah |
| Slogan/Motto | Prestasi, Mandiri, Islami |
| Platform | Web Responsive |
| Nama Proyek | Website Profil Sekolah untuk Tugas Mata Kuliah Pemrograman Web / PWEB |
| Target Pengguna | Siswa, calon siswa, orang tua, guru, alumni, dan masyarakat umum |
| Basis Referensi Desain | Adaptasi komponen dan kerangka tata letak dari template pihak ketiga bernama intime |
| Tujuan Utama | Membangun website profil sekolah yang fungsional, responsif, informatif, dan menggunakan data riil dari sekolah asli |

---

## 2. Latar Belakang

Website sekolah berfungsi sebagai media digital resmi untuk menyampaikan informasi mengenai identitas sekolah, profil madrasah, program akademik, kegiatan siswa, prestasi, berita, dan kontak resmi sekolah. Website MAN IC Bangka Tengah dirancang sebagai pusat informasi digital yang mudah diakses oleh calon siswa, orang tua, siswa aktif, guru, alumni, dan masyarakat umum.

Pengembangan website ini juga menjadi bagian dari implementasi pembelajaran mata kuliah Pemrograman Web. Oleh karena itu, website dibuat menggunakan teknologi web dasar seperti HTML5, CSS, Bootstrap, JavaScript, jQuery, serta beberapa plugin pendukung untuk meningkatkan tampilan dan interaktivitas.

---

## 3. Tujuan Produk

Website Profil Sekolah MAN IC Bangka Tengah memiliki tujuan sebagai berikut:

1. Menampilkan profil dan identitas MAN IC Bangka Tengah secara informatif.
2. Menyampaikan informasi akademik, program unggulan, dan prestasi siswa.
3. Menampilkan berita, artikel, dan kegiatan madrasah menggunakan data riil dari website resmi.
4. Menyediakan halaman kontak yang dapat digunakan pengunjung untuk memperoleh informasi lebih lanjut.
5. Menyediakan struktur navigasi yang sederhana, jelas, dan mudah digunakan.
6. Memberikan pengalaman pengguna yang responsif pada perangkat desktop, tablet, dan mobile.
7. Menjadi proyek akhir berbasis website statis/dinamis sesuai kebutuhan mata kuliah Pemrograman Web.

---

## 4. Target Pengguna

| Pengguna | Kebutuhan Utama |
|---|---|
| Pengunjung Umum | Mencari informasi umum mengenai MAN IC Bangka Tengah, profil sekolah, kegiatan, dan kontak. |
| Calon Siswa | Mencari informasi akademik, keunggulan sekolah, prestasi, program unggulan, dan berita sekolah. |
| Orang Tua | Mengetahui kualitas sekolah, lingkungan belajar, prestasi, dan kegiatan madrasah. |
| Siswa | Mengakses berita, artikel, kegiatan, dan informasi terkait sekolah. |
| Guru/Staff | Menyampaikan informasi sekolah melalui konten berita, profil, dan kegiatan. |
| Alumni | Mengetahui perkembangan sekolah dan informasi terbaru dari madrasah. |

---

## 5. Struktur Website

Website memiliki 6 halaman utama sesuai struktur navigasi dan file HTML berikut:

Website Profil Sekolah MAN IC Bangka Tengah
├── Beranda (index.html)
│   ├── Hero Slider
│   ├── Sambutan Kepala Sekolah
│   ├── Keunggulan Sekolah / Mengapa Memilih MAN IC
│   ├── Visi & Misi
│   ├── Kegiatan Madrasah
│   ├── Statistik Sekolah
│   └── Berita Terbaru
├── Profil (profile.html)
│   ├── Tentang Kami
│   └── Sejarah & Timeline Perkembangan
├── Akademik (academic.html)
│   ├── Kurikulum
│   ├── Program Unggulan
│   └── Prestasi
├── Jurusan (majors.html)
│   └── Informasi Pilihan Peminatan / Program Studi
├── Blog (blog.html)
│   └── Berita & Artikel
└── Kontak (contact.html)
    ├── Formulir Kontak
    ├── Informasi Kontak Resmi
    └── Peta Lokasi

---

## 6. Scope Produk

### 6.1 In Scope

Fitur yang termasuk dalam cakupan pengembangan website:

1. Halaman beranda dengan hero slider, sambutan, keunggulan sekolah, visi misi, kegiatan, statistik, dan berita terbaru.
2. Halaman profil berisi informasi tentang MAN IC Bangka Tengah dan sejarah perkembangan sekolah.
3. Halaman akademik berisi kurikulum, program unggulan, dan prestasi siswa.
4. Halaman jurusan berisi informasi peminatan atau program studi.
5. Halaman blog berisi grid kartu berita/artikel riil dari website resmi MAN IC Bangka Tengah.
6. Halaman kontak berisi formulir, kontak resmi, dan informasi lokasi.
7. Desain responsive menggunakan Bootstrap dan CSS custom.
8. Interaktivitas menggunakan JavaScript, jQuery, dan plugin pendukung.
9. Penggunaan gambar dan data riil dari domain resmi `icbateng.sch.id`.
10. Penamaan class, ID, dan struktur source code menggunakan Bahasa Inggris yang kontekstual.

### 6.2 Out of Scope

Fitur yang tidak menjadi prioritas utama dalam versi saat ini:

1. Sistem login admin.
2. Dashboard CMS penuh untuk mengelola konten.
3. Database dinamis untuk berita, galeri, prestasi, atau kontak.
4. Sistem komentar blog.
5. Pagination pada halaman blog, karena halaman blog disesuaikan tanpa pagination navigation.
6. Sistem PPDB online penuh.
7. API backend.

---

## 7. Functional Requirements

### FR-01 — Beranda (`index.html`)

Halaman beranda harus menampilkan ringkasan utama mengenai MAN IC Bangka Tengah.

Kebutuhan fitur:

1. Header dan navigation menu menuju seluruh halaman utama.
2. Hero slider dengan banner utama, motto, dan deskripsi sekolah.
3. Sambutan Kepala Sekolah sebagai pesan pembuka dari pimpinan madrasah.
4. Section School Excellence yang menjelaskan alasan memilih MAN IC Bangka Tengah.
5. Section Visi & Misi berisi nilai dan arah pengembangan sekolah.
6. Carousel Kegiatan Madrasah untuk menampilkan aktivitas unggulan.
7. Statistik Sekolah dengan animasi angka menggunakan Odometer.
8. Berita Terbaru berupa cuplikan ringkas berita sekolah.
9. Footer yang konsisten dengan halaman lainnya.

### FR-02 — Profil (`profile.html`)

Halaman profil harus menjelaskan identitas dan sejarah MAN IC Bangka Tengah.

Kebutuhan fitur:

1. Section Tentang Kami yang menjelaskan identitas umum sekolah.
2. Section Sejarah dan Timeline Perkembangan.
3. Timeline memuat informasi sejarah seperti:
   - Gagasan awal sekolah unggulan pada era 1990-an oleh B.J. Habibie.
   - Berdirinya SMU Insan Cendekia Serpong pada tahun 1996.
   - Alih kelola ke Kementerian Agama pada tahun 2000.
   - Berdirinya MAN IC Bangka Tengah pada tahun 2015.
4. Gambar timeline harus ditampilkan secara rapi sesuai pedoman dimensi.
5. Navigation dan footer tetap tersedia.

### FR-03 — Akademik (`academic.html`)

Halaman akademik harus menampilkan informasi pembelajaran dan pencapaian siswa.

Kebutuhan fitur:

1. Section Kurikulum yang menjelaskan paduan IPTEK dan IMTAK.
2. Section Program Unggulan yang memuat:
   - Home Stay.
   - Karya Tulis Ilmiah.
   - Tahfiz Qur'an.
   - Klub Studi.
3. Section Prestasi Siswa berupa cards daftar pemenang lomba.
4. Prestasi yang ditampilkan mencakup contoh seperti Chemistry Fair, LCC MPR RI, OSN, FLS3N, dan KOSSMI.
5. Gambar prestasi harus seragam agar tampilan grid card tidak rusak.

### FR-04 — Jurusan (`majors.html`)

Halaman jurusan harus menampilkan informasi mengenai pilihan peminatan atau program studi yang tersedia.

Kebutuhan fitur:

1. Menampilkan daftar jurusan, peminatan, atau program studi yang relevan.
2. Menjelaskan gambaran umum setiap peminatan.
3. Menampilkan informasi dengan struktur card atau section yang mudah dibaca.
4. Navigation dan footer tetap tersedia.

### FR-05 — Blog (`blog.html`)

Halaman blog harus menampilkan berita dan artikel sekolah.

Kebutuhan fitur:

1. Menampilkan grid kartu berita/artikel.
2. Setiap kartu berita memuat:
   - Foto atau thumbnail.
   - Kategori.
   - Tanggal.
   - Judul.
   - Ringkasan singkat.
   - Tautan menuju sumber asli.
3. Data berita dan foto harus menggunakan sumber riil dari domain resmi `icbateng.sch.id`.
4. Tidak menggunakan pagination navigation di bagian bawah halaman sesuai kebutuhan desain yang telah disesuaikan.
5. Layout harus tetap rapi pada desktop, tablet, dan mobile.

### FR-06 — Kontak (`contact.html`)

Halaman kontak harus membantu pengunjung menghubungi pihak sekolah.

Kebutuhan fitur:

1. Formulir kontak dengan input nama, email, subjek, dan pesan.
2. Informasi kontak resmi seperti nomor telepon dan email.
3. Informasi lokasi sekolah.
4. Kemungkinan integrasi peta lokasi.
5. Validasi input sederhana pada form kontak.
6. Navigation dan footer tetap tersedia.

---

## 8. Admin / Content Management

Pada versi awal, website difokuskan sebagai website profil statis atau semi-statis. Namun, berdasarkan pengembangan lanjutan, sistem dapat ditingkatkan menjadi website dinamis dengan fitur admin.

Fitur admin yang dapat dikembangkan pada versi berikutnya:

1. Login admin.
2. Dashboard admin.
3. CRUD profil sekolah.
4. CRUD berita dan artikel.
5. CRUD kegiatan madrasah.
6. CRUD prestasi.
7. CRUD program akademik.
8. CRUD galeri.
9. Manajemen pesan kontak.
10. User management.

---

## 9. Non-Functional Requirements

### 9.1 Responsive Design

Website harus dapat digunakan dengan baik pada:

1. Desktop.
2. Tablet.
3. Mobile.

Tampilan layout, navigation, gambar, card, dan section harus menyesuaikan ukuran layar pengguna.

### 9.2 Performance

Kebutuhan performa:

1. Gambar dioptimalkan agar tidak memperlambat halaman.
2. Penggunaan aset CSS dan JavaScript dibuat efisien.
3. Plugin digunakan seperlunya sesuai kebutuhan visual.
4. Struktur halaman dibuat ringan dan mudah dimuat.

### 9.3 Accessibility

Kebutuhan aksesibilitas:

1. Kontras warna teks dan background harus mudah dibaca.
2. Ukuran teks cukup nyaman untuk pengguna.
3. Gambar penting memiliki atribut `alt` yang deskriptif.
4. Struktur heading menggunakan urutan yang benar.
5. Navigasi dapat dipahami dengan jelas.

### 9.4 Security

Kebutuhan keamanan dasar:

1. Form kontak memiliki validasi input.
2. Input pengguna tidak langsung dieksekusi sebagai script.
3. Jika dikembangkan menjadi website dinamis, data harus disanitasi.
4. Jika ada admin dashboard, halaman admin harus dilindungi autentikasi.

### 9.5 Maintainability

Kebutuhan pemeliharaan kode:

1. Struktur file harus rapi dan mudah dipahami.
2. Nama class, ID, dan fungsi menggunakan Bahasa Inggris yang kontekstual.
3. Komentar digunakan seperlunya untuk menjelaskan bagian penting.
4. Komponen berulang seperti navbar dan footer dibuat konsisten di seluruh halaman.

---

## 10. Spesifikasi Teknologi

| Kategori | Teknologi |
|---|---|
| Markup | HTML5 |
| Styling | Vanilla CSS dan Bootstrap Framework |
| Scripting | Vanilla JavaScript dan jQuery |
| Plugin Pendukung | Owl Carousel, Odometer, Wow.js, Animate.css |
| Data dan Aset | Berita dan foto asli dari domain `icbateng.sch.id` |
| Version Control | Git dan GitHub |
| Deployment Opsional | Netlify, Vercel, atau hosting statis lain |

### Code Convention

Seluruh penamaan class, ID, variabel, fungsi, dan struktur di dalam source code wajib menggunakan Bahasa Inggris yang kontekstual.

Contoh:

| Tidak Disarankan | Disarankan |
|---|---|
| `visi-misi` | `vision-mission` |
| `berita-terbaru` | `latest-news` |
| `kegiatan-madrasah` | `school-activities` |
| `sambutan-kepala-sekolah` | `principal-greeting` |
| `keunggulan-sekolah` | `school-excellence` |

---

## 11. Pedoman UI / Desain

### 11.1 Prinsip Desain

1. Desain harus formal, bersih, dan sesuai identitas institusi pendidikan Islam modern.
2. Layout mengadaptasi komponen dan kerangka tata letak dari template intime.
3. Visual website harus menonjolkan kesan berprestasi, mandiri, dan islami.
4. Section harus memiliki jarak yang konsisten.
5. Card berita, prestasi, dan kegiatan harus rapi serta mudah dipindai oleh pengguna.

### 11.2 Sumber Aset Data

1. Berita menggunakan data riil dari website resmi MAN IC Bangka Tengah.
2. Foto menggunakan live image URL dari domain `icbateng.sch.id`.
3. Website tidak menggunakan data dummy yang dihasilkan secara acak.

### 11.3 Standarisasi Dimensi Komponen

#### Gambar Prestasi — Halaman Akademik

Gambar pada card prestasi wajib menggunakan ukuran berikut:

width: 370px;
height: 269px;
object-fit: cover;

Tujuannya adalah menjaga tampilan grid card tetap seragam dan mencegah gambar terlihat gepeng atau tidak proporsional.

#### Gambar Sejarah / Timeline — Halaman Profil

Gambar pada section sejarah atau timeline dibatasi dengan ukuran berikut:

width: 113px;
height: 128px;

Aturan tambahan:

1. Foto orang atau lokasi menggunakan `object-fit: cover`.
2. Gambar lambang atau logo, seperti logo Kemenag, menggunakan `object-fit: contain` agar tidak terpotong.

---

## 12. Struktur Data Konten

Karena versi awal website dapat dibuat sebagai website statis, struktur data konten dapat dikelola langsung di dalam file HTML. Jika dikembangkan menjadi website dinamis, struktur database dapat mengikuti tabel berikut:

1. `users`
2. `schools`
3. `teachers`
4. `programs`
5. `achievements`
6. `news`
7. `categories`
8. `events`
9. `galleries`
10. `gallery_categories`
11. `announcements`
12. `contacts`

Relasi utama yang disarankan:

1. `categories` memiliki banyak `news`.
2. `gallery_categories` memiliki banyak `galleries`.
3. `users` dapat membuat banyak `news`.

---

## 13. Prioritas Fitur

### MVP

Fitur minimum yang harus tersedia:

1. Beranda.
2. Profil.
3. Akademik.
4. Jurusan.
5. Blog.
6. Kontak.
7. Responsive design.
8. Navigation menu yang berfungsi.
9. Footer pada seluruh halaman.
10. Konten menggunakan data dan aset riil dari MAN IC Bangka Tengah.

### Pengembangan Berikutnya

Fitur lanjutan yang dapat dikembangkan:

1. Admin dashboard.
2. Database.
3. Login admin.
4. CMS berita.
5. CMS galeri.
6. Search blog.
7. API.
8. Statistik pengunjung.
9. Integrasi Google Maps.
10. Integrasi media sosial.

---

## 14. User Flow

### 14.1 Flow Pengunjung Umum

Pengunjung
→ Beranda
→ Profil
→ Akademik
→ Jurusan
→ Blog
→ Kontak

### 14.2 Flow Calon Siswa

Beranda
→ Keunggulan Sekolah
→ Profil Sekolah
→ Program Unggulan
→ Prestasi
→ Jurusan
→ Kontak

### 14.3 Flow Pembaca Blog

Beranda
→ Berita Terbaru
→ Blog
→ Pilih Artikel
→ Buka Tautan Sumber Asli

---

## 15. Struktur Project

Contoh struktur project website:

man-ic-bangka-tengah-profile/
├── index.html
├── profile.html
├── academic.html
├── majors.html
├── blog.html
├── contact.html
├── README.md
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── app.js
│   ├── images/
│   └── plugins/
└── components/
    ├── navbar.html
    └── footer.html

Catatan: Jika project tetap dibuat sebagai website statis murni, komponen navbar dan footer dapat langsung ditulis pada setiap halaman HTML agar mudah dijalankan secara lokal.

---

## 16. Acceptance Criteria

Website dinyatakan selesai apabila memenuhi kriteria berikut:

1. Semua halaman utama dapat diakses:
   - `index.html`
   - `profile.html`
   - `academic.html`
   - `majors.html`
   - `blog.html`
   - `contact.html`
2. Navigation menu berfungsi dan mengarah ke halaman yang benar.
3. Tampilan website responsive pada desktop, tablet, dan mobile.
4. Beranda menampilkan hero slider, sambutan kepala sekolah, keunggulan sekolah, visi misi, kegiatan, statistik, dan berita terbaru.
5. Halaman profil menampilkan informasi tentang kami dan sejarah/timeline perkembangan.
6. Halaman akademik menampilkan kurikulum, program unggulan, dan prestasi siswa.
7. Halaman jurusan menampilkan informasi peminatan atau program studi.
8. Halaman blog menampilkan berita/artikel riil dari sumber resmi.
9. Halaman kontak menampilkan form kontak dan informasi kontak resmi.
10. Footer tersedia pada seluruh halaman.
11. Tidak terdapat broken link internal.
12. Gambar prestasi mengikuti ukuran `370px x 269px` dengan `object-fit: cover`.
13. Gambar timeline mengikuti ukuran maksimal `113px x 128px` dengan object-fit sesuai jenis gambar.
14. Semua class, ID, dan struktur kode menggunakan Bahasa Inggris yang kontekstual.
15. Website dapat dijalankan secara lokal melalui browser.
16. Project dapat disimpan dan dikelola melalui GitHub.

---

## 17. Konsep Final Project Mahasiswa

Tema final project:

> Membangun Website Profil Sekolah MAN IC Bangka Tengah yang Informatif, Responsive, dan Berbasis Data Riil.

Tahapan pengerjaan:

1. Analisis kebutuhan.
2. Penyusunan sitemap.
3. Pembuatan wireframe.
4. Perancangan UI.
5. Implementasi HTML.
6. Implementasi CSS dan Bootstrap.
7. Implementasi JavaScript dan plugin pendukung.
8. Pengisian konten riil dari MAN IC Bangka Tengah.
9. Testing responsive design.
10. Testing navigation dan link.
11. Penyimpanan project ke GitHub.
12. Deployment atau showcase project.

Output akhir:

1. Website Profil Sekolah MAN IC Bangka Tengah.
2. Source code HTML, CSS, dan JavaScript.
3. Repository GitHub.
4. Dokumentasi project.
5. Presentasi atau showcase hasil akhir.

---

## 18. Kesimpulan

Website Profil Sekolah MAN IC Bangka Tengah dirancang sebagai media informasi digital yang menampilkan identitas sekolah, profil, akademik, jurusan, berita, dan kontak resmi. Website ini dikembangkan dengan pendekatan responsive design menggunakan HTML5, CSS, Bootstrap, JavaScript, jQuery, dan plugin pendukung. Dengan menggunakan data dan aset riil dari sumber resmi, website diharapkan mampu menjadi representasi digital yang informatif, menarik, dan relevan bagi seluruh target pengguna.
