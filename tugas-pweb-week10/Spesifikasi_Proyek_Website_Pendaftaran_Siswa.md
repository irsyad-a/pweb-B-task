# Spesifikasi Proyek Website

## Sistem Informasi Pendaftaran Siswa Baru SMK Coding

## 1. Nama Proyek

**Sistem Informasi Pendaftaran Siswa Baru Berbasis Web (Awal)**

Proyek ini merupakan aplikasi berbasis web yang digunakan untuk mengelola proses pendaftaran calon siswa baru di SMK Coding. Sistem nantinya akan menyediakan formulir pendaftaran bagi calon siswa serta halaman untuk melihat, mengubah, dan menghapus data pendaftar.

## 2. Deskripsi Proyek

Sistem Informasi Pendaftaran Siswa Baru SMK Coding dikembangkan untuk membantu proses pencatatan dan pengelolaan data calon siswa secara digital. Sebelum menggunakan sistem, pencatatan data pendaftar dapat
dilakukan secara manual sehingga berpotensi menimbulkan kesalahan pencatatan, duplikasi data, dan kesulitan dalam pencarian informasi.

Website ini menyediakan halaman utama yang mengarahkan pengguna ke formulir pendaftaran dan halaman daftar pendaftar. Calon siswa dapat mengisi data berupa nama lengkap, alamat, jenis kelamin, agama, dan sekolah asal. Data yang dikirim melalui formulir akan diproses oleh PHP dan disimpan ke dalam basis data MySQL.

Sistem juga menyediakan halaman pengelolaan data. Pengelola dapat melihat seluruh data calon siswa, memperbarui informasi pendaftar, dan menghapus data yang tidak diperlukan. Dengan demikian, sistem berfokus
pada proses pendaftaran dan pengelolaan data calon siswa dalam satu aplikasi web sederhana.

Pasa rancangan awal, aplikasi menggunakan PHP prosedural sebagai bahasa pemrograman di sisi server, MySQL sebagai sistem manajemen basis data, dan HTML untuk membangun struktur halaman serta formulir. Koneksi basis data menggunakan ekstensi MySQLi. Implementasi antarmuka yang dibuat masih berupa tampilan HTML dasar.

## 3. Tujuan Proyek

Tujuan utama proyek ini adalah membangun sistem pendaftaran siswa baru yang dapat mencatat dan mengelola informasi calon siswa melalui website. Sistem diharapkan membantu proses administrasi agar lebih terstruktur dan memudahkan pengelola ketika membutuhkan data pendaftar.

Secara khusus, proyek ini memiliki tujuan sebagai berikut:

1.  Menyediakan formulir pendaftaran calon siswa secara daring melalui website.
2.  Menyimpan data pendaftaran ke dalam basis data MySQL secara terstruktur.
3.  Menampilkan daftar calon siswa yang telah melakukan pendaftaran.
4.  Memungkinkan pengelola memperbarui data calon siswa apabila terdapat kesalahan atau perubahan informasi.
5.  Memungkinkan pengelola menghapus data pendaftar sesuai kebutuhan administrasi.
6.  Mengurangi ketergantungan pada pencatatan data secara manual serta mempermudah pencarian dan pemeriksaan informasi pendaftar.

## 4. Fitur Website

Fitur yang sudah tercermin dalam kode program meliputi:

### 4.1. Halaman Utama

Halaman utama menampilkan identitas pendaftaran siswa baru SMK Coding dan menyediakan navigasi menuju formulir pendaftaran serta daftar pendaftar. Halaman ini juga menampilkan pemberitahuan ketika proses pendaftaran berhasil atau gagal berdasarkan parameter status pada URL.

### 4.2. Formulir Pendaftaran

Formulir pendaftaran digunakan untuk memasukkan informasi calon siswa. Data yang diminta terdiri atas nama lengkap, alamat, jenis kelamin, agama, dan sekolah asal. Formulir mengirimkan data menggunakan metode POST ke proses-pendaftaran.php untuk diproses oleh server.

### 4.3. Daftar Pendaftar

Halaman daftar pendaftar menampilkan data yang tersimpan pada tabel calon_siswa. Informasi yang ditampilkan mencakup ID, nama, alamat, jenis kelamin, agama, dan sekolah asal. Halaman ini juga menyediakan tautan untuk mengubah atau menghapus data setiap pendaftar serta menampilkan
jumlah data yang tercatat.

### 4.4. Edit Data Pendaftar

Fitur edit digunakan untuk memperbarui informasi calon siswa berdasarkan ID. Sistem mengambil data dari basis data, kemudian menampilkan informasi tersebut pada formulir edit. Setelah pengelola menyimpan perubahan, sistem menjalankan perintah UPDATE dan mengarahkan pengguna kembali ke halaman daftar pendaftar apabila proses berhasil.

### 4.5. Hapus Data Pendaftar

Fitur hapus digunakan untuk menghilangkan data calon siswa berdasarkan ID. Sistem menjalankan perintah DELETE pada tabel calon_siswa dan mengarahkan pengguna kembali ke halaman daftar pendaftar apabila proses berhasil.

## 5. Spesifikasi Teknis Front End dan Back End

### 5.1. Front End

Front end merupakan bagian website yang berinteraksi langsung dengan pengguna. Berdasarkan berkas yang tersedia, front end dibangun dengan menggunakan HTML. Komponen utamanya meliputi halaman utama, navigasi, formulir pendaftaran, formulir edit, dan tabel daftar pendaftar.

Formulir pendaftaran menggunakan elemen input teks untuk nama dan sekolah asal, textarea untuk alamat, radio button untuk jenis kelamin, serta dropdown untuk agama. Formulir edit menggunakan komponen serupa dan menampilkan data lama agar pengelola dapat melakukan perubahan.

### 5.2. Back End

Back end menggunakan PHP prosedural untuk menangani pengiriman formulir, komunikasi dengan basis data, serta proses tambah, baca, ubah, dan hapus data. Kode program memisahkan beberapa proses ke dalam berkas yang berbeda agar fungsi sistem lebih mudah dikenali.

Berkas `config.php` mengatur koneksi ke server MySQL dan basis data `pendaftaran_siswa`. Berkas `proses-pendaftaran.php` menangani penyimpanan data baru, sedangkan `list-siswa.php` mengambil dan menampilkan seluruh data calon siswa. Berkas `form-edit.php` mengambil data berdasarkan ID, `proses-edit.php` menyimpan perubahan, dan `hapus.php` menjalankan penghapusan data. Berkas `index.php` berfungsi
sebagai halaman utama.

### 5.3. Basis Data

Sistem menggunakan MySQL dengan nama basis data `pendaftaran_siswa`.
Basis data tersebut memiliki tabel utama bernama `calon_siswa` dengan
struktur berikut:

  -----------------------------------------------------------------------
  Nama Kolom              Tipe Data               Keterangan
  ----------------------- ----------------------- -----------------------
  `id`                    INT(11)                 Primary key dan auto
                                                  increment sebagai
                                                  identitas setiap
                                                  pendaftar

  `nama`                  VARCHAR(64)             Nama lengkap calon
                                                  siswa

  `alamat`                VARCHAR(255)            Alamat calon siswa

  `jenis_kelamin`         VARCHAR(16)             Jenis kelamin calon
                                                  siswa

  `agama`                 VARCHAR(16)             Agama calon siswa

  `sekolah_asal`          VARCHAR(64)             Nama sekolah asal calon
                                                  siswa
  -----------------------------------------------------------------------

Setiap data pendaftar disimpan sebagai satu baris pada tabel
`calon_siswa`. Kolom `id` menjadi identitas unik yang digunakan sistem
ketika menampilkan, mengubah, dan menghapus data.

## 6. Ruang Lingkup Proyek

### 6.1. Pengelolaan Data

Ruang lingkup pengelolaan data berfokus pada informasi calon siswa yang
melakukan pendaftaran. Sistem menerima data melalui formulir,
menyimpannya ke basis data, menampilkan data yang telah tersimpan,
memperbarui informasi, dan menghapus data berdasarkan ID pendaftar.

Data yang dikelola meliputi nama, alamat, jenis kelamin, agama, dan
sekolah asal. Pengelolaan data dilakukan melalui tabel `calon_siswa`
pada basis data `pendaftaran_siswa`.

### 6.2. Logika Bisnis

Logika bisnis mengatur alur pendaftaran dan pengelolaan data calon
siswa. Proses dimulai ketika calon siswa membuka halaman utama dan
memilih menu pendaftaran. Pengguna mengisi formulir, kemudian
mengirimkan data melalui metode POST. PHP menerima data tersebut dan
menjalankan perintah INSERT ke tabel `calon_siswa`.

Jika proses penyimpanan berhasil, sistem mengarahkan pengguna ke halaman
utama dengan status sukses. Jika proses gagal, sistem mengarahkan
pengguna dengan status gagal. Pengelola dapat membuka halaman daftar
pendaftar untuk melihat data yang telah masuk.

Untuk mengubah data, sistem mengambil ID dari URL, mencari data yang
sesuai, dan menampilkan informasi pada formulir edit. Setelah perubahan
dikirim, PHP menjalankan perintah UPDATE berdasarkan ID tersebut.
Sementara itu, proses penghapusan menjalankan perintah DELETE
berdasarkan ID pendaftar.

Dengan alur tersebut, logika bisnis utama proyek mencakup pendaftaran,
penampilan data, pembaruan data, dan penghapusan data. Sistem yang
tersedia belum mencakup proses seleksi siswa, penentuan kelulusan,
pembayaran biaya pendaftaran, atau pengumuman hasil seleksi.

### 6.3. Autentikasi dan Keamanan

Pada kode program yang dilampirkan, belum terdapat fitur autentikasi
berupa halaman login, pengelolaan akun, session pengguna, maupun
pembagian hak akses. Oleh karena itu, sistem saat ini belum dapat
membedakan akses calon siswa dan pengelola secara terautentikasi. Fitur
login administrator dan pengaturan hak akses perlu dimasukkan sebagai
pengembangan apabila halaman pengelolaan data akan digunakan pada
lingkungan operasional.

Dari sisi keamanan, implementasi saat ini masih memerlukan peningkatan.
Beberapa query SQL menggabungkan nilai dari input atau parameter URL
secara langsung ke dalam perintah SQL. Pola tersebut berisiko terhadap
SQL injection. Selain itu, data yang ditampilkan kembali ke halaman
belum terlihat melalui proses output escaping yang memadai. Fitur
penghapusan juga menggunakan parameter ID melalui metode GET dan belum
terlihat memiliki token perlindungan CSRF.

Pengembangan keamanan yang direncanakan meliputi penggunaan prepared
statement pada query basis data, validasi dan sanitasi input di sisi
server, serta output escaping sebelum menampilkan data. Sistem juga
perlu menggunakan metode POST untuk tindakan yang mengubah data,
menambahkan token CSRF, dan menerapkan autentikasi berbasis session
untuk administrator. Kata sandi akun, apabila fitur login diterapkan,
harus disimpan menggunakan mekanisme hashing yang aman. Informasi
koneksi basis data juga perlu dipindahkan dari kode yang dapat diakses
publik dan dilindungi melalui konfigurasi server.

Dengan peningkatan tersebut, sistem diharapkan dapat membatasi akses
pengelolaan data dan mengurangi risiko penyalahgunaan aplikasi.

### 6.4. API (Application Programming Interface)

Berdasarkan kode program yang tersedia, sistem belum menyediakan REST
API atau integrasi dengan layanan eksternal. Komunikasi antara front end
dan back end masih berlangsung melalui pengiriman formulir HTML
menggunakan metode POST serta parameter URL untuk mengambil data
berdasarkan ID.

## 7. Rencana Implementasi

Implementasi proyek direncanakan melalui beberapa tahap agar
pengembangan berjalan secara terstruktur.

**Tahap 1: Analisis Kebutuhan.** Tahap ini mencakup identifikasi
kebutuhan calon siswa dan pengelola, penentuan data yang harus
dikumpulkan, serta penetapan alur pendaftaran. Hasil tahap ini menjadi
dasar pengembangan fitur dan struktur basis data.

**Tahap 2: Perancangan Sistem dan Basis Data.** Tahap ini mencakup
perancangan halaman utama, formulir pendaftaran, halaman daftar
pendaftar, formulir edit, serta alur proses tambah, baca, ubah, dan
hapus data. Struktur tabel `calon_siswa` digunakan sebagai dasar
penyimpanan data.

**Tahap 3: Pengembangan Front End.** Tahap ini berfokus pada pembuatan
halaman website dan komponen antarmuka menggunakan HTML. Pengembangan
lanjutan dapat menambahkan CSS atau framework antarmuka agar tampilan
lebih konsisten, responsif, dan mudah digunakan melalui perangkat
komputer maupun ponsel.

**Tahap 4: Pengembangan Back End.** Tahap ini mencakup konfigurasi
koneksi MySQL menggunakan PHP, pemrosesan formulir, penyimpanan data
baru, penampilan daftar pendaftar, pembaruan data, dan penghapusan data.
Setiap proses perlu menghasilkan respons yang sesuai dengan keberhasilan
atau kegagalan operasi.

**Tahap 5: Peningkatan Keamanan.** Tahap ini mencakup penerapan prepared
statement, validasi input, output escaping, perlindungan CSRF,
autentikasi administrator, pengaturan hak akses, dan perlindungan
konfigurasi basis data.

**Tahap 6: Pengujian Sistem.** Pengujian dilakukan untuk memastikan
setiap fitur berjalan sesuai kebutuhan. Pengujian meliputi pengiriman
formulir dengan data valid, penolakan data yang tidak sesuai, penampilan
daftar pendaftar, pembaruan data, penghapusan data, serta pemeriksaan
akses dan keamanan.

**Tahap 7: Implementasi dan Pemeliharaan.** Setelah pengujian selesai,
aplikasi dapat dipasang pada server lokal atau hosting yang mendukung
PHP dan MySQL. Pemeliharaan mencakup pencadangan basis data, pemeriksaan
kesalahan aplikasi, pembaruan keamanan, dan perbaikan fitur berdasarkan
kebutuhan pengguna.

## 8. Batasan Proyek

Proyek ini berfokus pada pendaftaran dan pengelolaan data calon siswa
baru SMK Coding. Sistem yang tersedia belum mencakup pengelolaan akun
pengguna, verifikasi dokumen persyaratan, pembayaran pendaftaran,
seleksi akademik, penentuan kelulusan, pencetakan bukti pendaftaran,
pengiriman notifikasi otomatis, maupun integrasi dengan sistem akademik
sekolah.

Fitur autentikasi, peningkatan keamanan, dan REST API dijelaskan sebagai
rencana pengembangan, bukan sebagai kemampuan yang telah tersedia pada
kode saat ini. Payment gateway juga berada di luar ruang lingkup
implementasi saat ini dan hanya relevan apabila proses pendaftaran
nantinya melibatkan pembayaran daring.

## 9. Hasil yang Diharapkan

Hasil akhir proyek adalah website pendaftaran siswa baru yang mampu
menerima dan menyimpan data calon siswa, menampilkan daftar pendaftar,
serta mendukung proses perubahan dan penghapusan data. Website
diharapkan membantu pengelola menjalankan administrasi pendaftaran
secara lebih terstruktur.

Melalui pengembangan lanjutan pada autentikasi dan keamanan, sistem
diharapkan dapat digunakan dengan pengaturan akses yang lebih baik.
Sementara itu, penyediaan REST API dapat menjadi pilihan apabila pada
masa mendatang diperlukan integrasi dengan aplikasi atau layanan lain.

------------------------------------------------------------------------