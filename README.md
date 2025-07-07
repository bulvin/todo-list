# To-Do List App

## 🚀 Technologie
- PHP 8.2
- Laravel 11
- SQLite
- Laravel Blade
- Laravel Queues & Sc*heduler
- Tailwind CSS

## ⚙️ Wymagania
- PHP >= 8.2
- Composer
- Node.js + NPM
- SQLite lub MySQL

## 📦 Instalacja

   ```bash
   git clone https://github.com/bulvin/todo-list
   cd todo-list
   composer install
   npm install && npm run build
   cp .env.example .env
   php artisan key:generate
   touch database/database.sqlite
   php artisan migrate --seed
   composer run dev
   ```

## 🛠️ Konfiguracja
```
APP_NAME=TODOS
APP_ENV=local
APP_DEBUG=false
APP_URL=http://localhost:8080/
DB_CONNECTION=sqlite

```


🧪 Testy

Uruchom testy:

```php artisan test```
   

Aplikacje można uruchomić lokalnie:

przez APP_URL np. `http://localhost:8080/`
lub lokalnie Laravel Herd: `http://todo-list.test`
   
   

