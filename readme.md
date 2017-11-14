## Clone, Install, Config

1. `git clone`
2. Buat file `.env` dengan meng-copy file `.env.example`
3. `composer install`.
4. Create MySQL database.
5. Sesuaikan konfigurasi yang benar di `.env`
6. `php artisan key:generate`
7. `php artisan storage:link`
8. `php artisan migrate`
9. `php artisan db:seed`
10. `php artisan serve`
11. Seharusnya sudah bisa akses `http://127.0.0.1:8000`