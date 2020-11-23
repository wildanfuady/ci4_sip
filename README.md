# Project Sistem Informasi Penjualan Menggunakan Codeigniter 4

Ikuti langkah berikut ini:
1. Clone atau download file
2. Ketik composer install
3. Buat database baru bernama <code>ci4_sip</code>
4. Rename .env.example jadi .env
5. Konfigurasi database di .env sesuai web server yang kamu gunakan
6. Atur environment dari production jadi development (optional)
7. Ketik php spark migrate
8. Ketik php spark db:seed
9. Extract xdist.zip yang ada di folder public/themes.
9. Jalankan php spark serve
10. Selesai

## Bermasalah Pada Mac?

1. Buka <code>system/Database/MySQLi/Connection.php</code>
2. Pada baris ke 106, ubah <code>$socket = null;</code> menjadi <code>$socket = '/Applications/MAMP/tmp/mysql/mysql.sock';</code>