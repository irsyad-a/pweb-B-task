# Tugas PWEB Week 7 — Bootstrap

[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![Remix Icon](https://img.shields.io/badge/Remix%20Icon-2.5-blue)](https://remixicon.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Tugas Pemrograman Web (PWEB) Week 7 — Mendesain halaman website menggunakan **Bootstrap 5**. Proyek ini terdiri dari dua halaman utama: **Halaman Konten** dengan layout sidebar-content dan **Halaman Login/Register** dengan form yang responsif, keduanya menggunakan Bootstrap Grid System dan color palette dari template referensi **Techbar**.

## Features

- ✨ **Halaman Konten** — Layout sidebar (col-md-3) + main content (col-md-9) menggunakan Bootstrap Grid System
- 🔐 **Halaman Login & Register** — Form login/register dengan tab toggle, background overlay, dan form validation
- 🎨 **Custom Color Palette** — Mengadopsi color tokens dari template Techbar (`#1f3469`, `#e4ab00`, `#283032`, dll.)
- 📱 **Responsive Design** — Fully responsive menggunakan Bootstrap breakpoints (`col-md-*`, `col-lg-*`)
- 🎵 **Remix Icon** — Integrasi ikon Remix Icon untuk navigasi dan UI elements
- 🔤 **Google Fonts (Nunito)** — Tipografi konsisten menggunakan font Nunito (300/400/600/700)
- 🃏 **Bootstrap Components** — Cards, Accordion, Badges, Buttons, dan lainnya

## Demo

Buka file `content.html` atau `login.html` langsung di browser.

## Struktur Proyek

```
tugas-pweb-week7/
├── content.html              # Halaman konten (layout sidebar + content)
├── login.html                # Halaman login & register
├── css/
│   ├── bootstrap.min.css     # Bootstrap 5.3 CSS
│   ├── remixicon.css         # Remix Icon stylesheet
│   ├── style-content.css     # Custom CSS — color palette, typography, cards, accordion, footer
│   └── style-login.css       # Custom CSS — login page background, form, tabs
├── font/
│   ├── remixicon.eot
│   ├── remixicon.svg
│   ├── remixicon.ttf
│   ├── remixicon.woff
│   └── remixicon.woff2
├── images/
│   └── login-bg.jpg          # Background image halaman login
├── js/
│   ├── bootstrap.bundle.min.js  # Bootstrap 5 JS (Popper.js included)
│   ├── app.js
│   └── main.js
└── README.md
```

## Quick Start

1. Clone atau download repository ini
2. Buka `content.html` di browser untuk melihat halaman konten
3. Buka `login.html` di browser untuk melihat halaman login/register

```bash
# Jika menggunakan Live Server (VS Code Extension)
# Klik kanan pada content.html → Open with Live Server
```

Tidak diperlukan instalasi dependencies atau build step — semua aset (Bootstrap, Remix Icon, font) sudah disertakan secara lokal.

## Halaman

### 1. Halaman Konten (`content.html`)

Halaman utama yang menampilkan layout konten menggunakan Bootstrap Grid System:

| Komponen | Deskripsi |
|----------|-----------|
| **Header** | Navbar sticky-top dengan logo TECHBAR (teks) dan tombol Login |
| **Sidebar** (col-md-3) | 3 menu item cards + promo banner widget |
| **Main Content** (col-md-9) | 2 feature cards (2×col-md-6), main article card, FAQ accordion |
| **Footer** | Footer dark dengan link Privacy, Terms, Support |

**Bootstrap Components yang dipakai:**
- Grid System (`container`, `row`, `col-md-*`)
- Cards (`card`, `card-body`, `card-title`, `card-text`)
- Accordion (`accordion`, `accordion-item`, `data-bs-toggle="collapse"`)
- Badges (`badge`, `bg-warning`)
- Buttons (`btn`, `btn-primary`, `btn-warning`, `btn-success`)
- Utilities (`d-flex`, `shadow-sm`, `sticky-top`, `rounded-pill`, dll.)

### 2. Halaman Login/Register (`login.html`)

Halaman autentikasi dengan tab toggle Login/Register:

| Komponen | Deskripsi |
|----------|-----------|
| **Background** | Full-screen background image dengan dark overlay |
| **Logo** | TECHBAR dalam teks, link kembali ke content.html |
| **Tab Login** | Form email, password, remember me, forgot password |
| **Tab Register** | Form first name + last name (2 kolom), email, password + confirm (2 kolom), terms checkbox |

**Bootstrap Grid yang dipakai di form:**
- `col-lg-5 col-md-7 col-sm-10` — card responsif di tengah
- `col-md-6 col-12` — First Name & Last Name berdampingan
- `col-md-6 col-12` — Password & Confirm Password berdampingan
- `col-6` — Remember Me & Forgot Password kiri-kanan

## Color Palette

Seluruh warna mengikuti template referensi **Techbar**:

| Token | Hex | Penggunaan |
|-------|-----|------------|
| Primary | `#1f3469` | Header, heading, button utama |
| Secondary | `#959797` | Teks paragraf, placeholder |
| Success | `#198754` | Feature card 2, button success |
| Info | `#8cb0df` | Elemen informasi |
| Warning | `#e4ab00` | Aksen utama, icon, hover, badge, logo accent |
| Danger | `#dc3545` | Required asterisk (*) |
| Light | `#f8f9fa` | Background body, text light |
| Dark | `#283032` | Card gelap, footer, teks utama |

## Teknologi

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| [Bootstrap](https://getbootstrap.com/) | 5.3 | CSS framework, grid system, components |
| [Remix Icon](https://remixicon.com/) | 2.5 | Icon library |
| [Google Fonts — Nunito](https://fonts.google.com/specimen/Nunito) | 300–700 | Tipografi |
| HTML5 | — | Struktur halaman |
| CSS3 | — | Custom styling |

## Referensi Materi

- [Slide Bootstrap — Fajar Baskoro](https://www.slideshare.net/fajarbaskoro/bootstrap-250431193)
- [Materi Bootstrap (PDF)](https://drive.google.com/file/d/1B2vFh51pn5UvPT0ksmmVEat9wdCgsWUL/view?usp=drive_link)
- [Hands-on Labs (PDF)](https://drive.google.com/file/d/1JhjgxDsn68-AtJkDgLcs5SuqYlk9QsKP/view?usp=drive_link)
- [Bootstrap Latihan — Fajar Baskoro](https://www.slideshare.net/fajarbaskoro/bootstrap-latihan)
- [Video Tutorial YouTube](https://www.youtube.com/watch?v=tvVO6Lnk5J0&list=PLce3Eyp7oY9-o3JavSawkXcazJSYx7KAf)

## Referensi Latihan

1. **Halaman Konten:** [https://smadt.net/pweb1/boot1b.html](https://smadt.net/pweb1/boot1b.html)
2. **Halaman Login/Register:**
   - [Start Bootstrap — Sign In Split](https://startbootstrap.com/snippets/sign-in-split)
   - [Bootsnipp — Login Form](https://bootsnipp.com/snippets/21jx)

## Contoh Snippet Tambahan

- [Bootsnipp — Snippet bxzmb](https://bootsnipp.com/snippets/bxzmb)
- [Bootsnipp — Snippet 7nmOW](https://bootsnipp.com/snippets/7nmOW)

## FAQ

<details>
<summary><strong>Apakah perlu menginstall Node.js atau dependency lain?</strong></summary>

Tidak. Seluruh aset (Bootstrap CSS/JS, Remix Icon, font) sudah disertakan secara lokal di folder `css/`, `js/`, dan `font/`. Cukup buka file HTML langsung di browser.
</details>

<details>
<summary><strong>Bootstrap versi berapa yang digunakan?</strong></summary>

Bootstrap 5.3. File `bootstrap.min.css` dan `bootstrap.bundle.min.js` sudah di-bundle secara lokal.
</details>

<details>
<summary><strong>Kenapa ada folder `referensi/`?</strong></summary>

Folder `referensi/` berisi template Techbar asli yang dijadikan acuan desain (color palette, tipografi, elemen). Folder ini hanya untuk referensi dan dapat dihapus tanpa mempengaruhi fungsionalitas halaman.
</details>

<details>
<summary><strong>Apa itu Grid System / GSM dalam Bootstrap?</strong></summary>

Bootstrap Grid System menggunakan sistem 12 kolom. Misalnya `col-md-3` berarti 3/12 = 25% lebar layar (untuk sidebar), dan `col-md-9` berarti 9/12 = 75% lebar layar (untuk konten utama). Prefix `md` artinya aturan ini berlaku untuk layar ≥768px.
</details>

## License

This project is licensed under the MIT License.

---

Made with ❤️ untuk Tugas PWEB Week 7 — Bootstrap
