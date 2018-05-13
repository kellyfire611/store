# Cách chạy dự án
## Môi trường
1. PHP 7+ (7.0.23)
2. MySQL 5.6+

## 1. Copy file .env.eample thành .env
```
copy .env.example .env
```
## 2. Thay đổi thông số kết nối DB 
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=store_manager
DB_USERNAME=root
DB_PASSWORD=
```

## 3. Clear cache
```
composer dump-autoload
php artisan clear
php artisan config:cache
php artisan key:generate
```

## 4. Chạy câu lệnh khởi tạo DB + data
```
php artisan migrate --seed
```

## 5. Start server
```
php artisan serve
```

## 6. Truy cập Web
http://localhost:8000/admin

Tài khoản/password: `admin/admin`
