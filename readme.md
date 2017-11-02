# Pipeline

## Installation
1. Setup [Homestead](https://laravel.com/docs/5.4/homestead) or [Valet](https://laravel.com/docs/5.4/valet) on your local computer
2. Clone https://bitbucket.org/Three29media/pipeline-demo.three29.com/ to local computer
3. Run `composer update`
4. Create .env file in root folder
5. Setup Google Oauth for your local machine using [this article](https://blog.damirmiladinov.com/laravel/laravel-5.2-socialite-google-login.html)
##### Note: don't modify the `config/services.php` file. That has already been done.
6. Add GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET to your .env file
7. Run `php artisan migrate:refresh --seed` to create tables
