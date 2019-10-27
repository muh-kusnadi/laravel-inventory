# Laravel-Inventory

To use this application, there are several things that need to be configured.
One of them is configuring the .env file in the section

Database
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_inventory
DB_USERNAME=YOUR DB_USERNAME
DB_PASSWORD=YOUR DB_PASSWORD
```

SMTP GMAIL
```sh
MAIL_DRIVER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=YOUR GMAIL
MAIL_PASSWORD=YOUR GMAIL PASSWORD
MAIL_ENCRYPTION=ssl
```
Note: make sure you already set allowed/active "Less Secure App Access" on your gmail account

LOGIN URL ACCESS
1. ADMIN
```sh
http://localhost/YOUR-LARAVEL-PROJECT-NAME/public/admin/login
```
E-Mail : muh.kusnadi99@gmail.com 
Password : secret
2. USERS
```sh
http://localhost/YOUR-LARAVEL-PROJECT-NAME/public/login
```

User1
Username : 	user1@gmail.com
Password : 12345678
User2

Username : 	user1@gmail.com
Password : 12345678

Note : if you're using my database that i've been attached in project, you can use this email and password. The file name is "db_inventory.sql"
