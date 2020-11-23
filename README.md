# Project Sistem Informasi Penjualan Menggunakan Codeigniter 4

## System Requirement

1. Minimal PHP 7.2
2. MAMP, XAMPP, Laragon, Nginx sebagai web server

## Cara Installasi dan Menjalankan Program

1. Clone atau download file
2. Ketik <code>composer install</code>
3. Buat database baru bernama <code>ci4_sip</code>
4. Rename <code>.env.example</code> jadi <code>.env</code> atau ketik <code>cp .env.example .env</code>
5. Konfigurasi database di <code>.env</code> sesuai web server yang kamu gunakan
6. Atur CI_ENVIRONMENT=production jadi CI_ENVIRONMENT=development (optional)
7. Ketik <code>php spark migrate</code>
8. Ketik <code>php spark db:seed AdminSeeder</code> dan <code>php spark db:seed CategorySeeder</code>
9. Extract <code>xdist.zip</code> yang ada di folder <code>public/themes</code>.
9. Jalankan php spark serve
10. Selesai

## Pengguna MAMP Pada Mac?

1. Buka <code>system/Database/MySQLi/Connection.php</code>
2. Pada baris ke 106, ubah <code>$socket = null;</code> menjadi <code>$socket = '/Applications/MAMP/tmp/mysql/mysql.sock';</code>