# My Hobbies

Laravel + VueJS project for Dev&Go

## Setup

### Clone

```sh
git clone https://github.com/lipingZLP/my-hobbies.git
cd my-hobbies
cp .env.example .env
composer install
```

### Generate a Laravel Application key

```
php artisan key:generate
```

### Setup the database

Create a `myhobbies` database and run Laravel migrations:

```sql
CREATE DATABASE IF NOT EXISTS `myhobbies`
```

```sh
php artisan migrate
```

Modify the `my-hobbies/.env` file and set the following:

```
DB_HOST=<mysql_server_address>
DB_DATABASE=myhobbies
DB_USERNAME=<mysql_username_eg_root>
DB_PASSWORD=<mysql_password_eg_root>
```
