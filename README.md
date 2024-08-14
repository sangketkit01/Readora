***
หาก Clone project แล้วเจอ errors ให้รันคำสั่งกห  composer install

***
เวลาโปรเจ็คมีปัญหารันคำสั่ง composer install

1.สร้าง Database ใหม่ใน php my admin แนะนำให้ตั้งชื่่อว่า Novel
2.แก้ไข file .env ดังนี้
    *** แก้ไข ***
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=novel
    DB_USERNAME=root
    DB_PASSWORD=

    *** เพิ่ม ***
    GOOGLE_CLIENT_ID = 733711703263-p9smopp5dd9mrbma1482n2l9um749hrg.apps.googleusercontent.com
    GOOGLE_CLIENT_SECRET = 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

3.รันคำสั่ง php artisan migrate
