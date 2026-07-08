- Регистрация и вход в личный кабинет
- Создание коротких ссылок
- Редирект на оригинальный URL с фиксацией статистики
- Список своих ссылок с количеством кликов
- Детальная статистика по каждой ссылке: IP, User-Agent, дата перехода
- Удаление ссылок

- Laravel 11
- PHP 8.3
- SQLite
- Laravel Breeze (аутентификация)
- Tailwind CSS (стили)

## Установка

```
git clone https://github.com/kolausid/shortUrl.git
cd shortUrl
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
npm install && npm run build
php artisan serve
```

Откройте http://localhost:8000 и зарегистрируйтесь.

Зарегистрируйтесь или войдите

На странице /dashboard вставьте ссылку в поле и нажмите «Сократить»

Скопируйте короткую ссылку и поделитесь ей

При переходе по короткой ссылке происходит редирект и сохраняется статистика

В личном кабинете можно посмотреть количество кликов, детальную статистику и удалить ссылку
