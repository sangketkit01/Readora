***
หาก Clone project แล้วเจอ errors ให้รันคำสั่ง  composer install

***
เวลาโปรเจ็คมีปัญหารันคำสั่ง composer install 

1.สร้าง Database ใหม่ใน php my admin แนะนำให้ตั้งชื่อว่า novel
2.แก้ไข file .env ดังนี้
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=novel
    DB_USERNAME=root
    DB_PASSWORD=

3.รันคำสั่ง php artisan migrate
