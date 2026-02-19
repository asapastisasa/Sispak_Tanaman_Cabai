## 📝 Pengembang

Tugas Kelompok
Mata Kuliah: Sistem Pakar
Program Studi: Informatika

## 📌 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan pengembangan akademik.

# 🌶️ Sistem Pakar Diagnosa Penyakit dan Hama Tanaman Cabai

## Metode Forward Chaining

## 📌 Deskripsi

Sistem ini merupakan aplikasi **Sistem Pakar** yang digunakan untuk mendiagnosa penyakit dan hama pada tanaman cabai berdasarkan gejala yang dipilih oleh pengguna.

Metode yang digunakan adalah **Forward Chaining**, yaitu metode penalaran yang dimulai dari fakta (gejala) menuju kesimpulan (diagnosa penyakit/hama).

Aplikasi ini dibangun menggunakan:

* **PHP Native**
* **MySQL**
* **HTML, CSS, JavaScript**

---

## 🎯 Tujuan Sistem

1. Membantu petani atau pengguna dalam mengetahui penyakit/hama tanaman cabai.
2. Memberikan solusi penanganan berdasarkan hasil diagnosa.
3. Mengimplementasikan metode Forward Chaining dalam sistem pakar berbasis web.

---

## ⚙️ Metode yang Digunakan

### 🔎 Forward Chaining

Forward Chaining adalah metode inferensi yang bekerja dengan:

1. Mengumpulkan fakta (gejala yang dipilih pengguna)
2. Mencocokkan dengan rule (aturan)
3. Menarik kesimpulan berupa diagnosa penyakit/hama

Proses:

```
Gejala → Rule → Diagnosa → Solusi
```

---

## 🛠️ Instalasi & Cara Menjalankan

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/Sispak_Tanaman_Cabai.git
```

### 2️⃣ Pindahkan ke Folder Server

Jika menggunakan XAMPP:

```
C:\xampp\htdocs\
```

### 3️⃣ Import Database

1. Buka phpMyAdmin
2. Buat database baru (misalnya: `db_sispak_cabai`)
3. Import file `.sql` yang tersedia

### 4️⃣ Atur Koneksi Database

Edit file `config.php`:

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_sispak_cabai";
```

### 5️⃣ Jalankan di Browser

```
http://localhost/Sispak_Tanaman_Cabai
```

---

## 👥 Fitur Sistem

### 👨‍🌾 User

* Melakukan konsultasi
* Memilih gejala
* Mendapatkan hasil diagnosa
* Melihat solusi penanganan

### 👨‍💻 Admin

* Kelola data gejala
* Kelola data penyakit/hama
* Kelola aturan (rule)
* Melihat riwayat konsultasi

---

## 🗃️ Struktur Database (Konsep)

Tabel utama:

* `gejala`
* `penyakit`
* `aturan`
* `konsultasi`
* `detail_konsultasi`

---

## 📊 Contoh Rule

| IF (Gejala)   | THEN (Diagnosa)        |
| ------------- | ---------------------- |
| G01, G02, G03 | Penyakit Layu Fusarium |
| G04, G05      | Hama Thrips            |

---

## 📚 Konsep Sistem Pakar

Sistem pakar terdiri dari:

* Basis Pengetahuan (Knowledge Base)
* Mesin Inferensi (Inference Engine)
* Antarmuka Pengguna

Metode Forward Chaining digunakan untuk mencocokkan fakta dengan aturan hingga ditemukan kesimpulan yang sesuai.





