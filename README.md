# MosBiz Backend API

## Технологии
- PHP
- Laravel
- FilamentPHP
- MySQL
- Beget

---

## Структура базы данных

**header_info** — шапка сайта  
- phone, email, feedback_link

**hero_blocks** — главный блок  
- main_title, bottom_title, background_image  
- stat_1_value, stat_1_label  
- stat_2_value, stat_2_label  
- stat_3_value, stat_3_label

**team_members** — сотрудники  
- name, position, photo

**projects** — проекты  
- title, description, photo, link, link_text

**events** — мероприятия  
- title, description, photo, start_date, end_date, type

**subordinate_structures** — подведомственные структуры  
- title, description, photo, link, link_text

**footer_info** — подвал  
- email, address, privacy_policy_link, newsletter_link

---

## API Endpoints

### GET /api/v1/main-page
Получает все данные для главной страницы.

Формат ответа: JSON со всеми разделами (header, hero, team, projects, events, structures, footer).

---

## Админ-панель

URL: http://kurmanni.beget.tech/admin  
Логин: admin@mail.ru  
Пароль: 12345

Доступные разделы:
- Шапка сайта
- Главный блок
- Сотрудники
- Проекты
- Мероприятия
- Подведомственные структуры
- Подвал

---

## Развертывание проекта

### 1. Клонирование репозитория
git clone https://github.com/ZitroneLemon/mosbiz-backend-practic.git
cd mosbiz-backend-practic

### 2. Установка зависимостей
composer install

### 3. Настройка окружения
cp .env.example .env
php artisan key:generate

### 4. Настройка базы данных в .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=название_бд
DB_USERNAME=пользователь
DB_PASSWORD=пароль

### 5. Запуск миграций
php artisan migrate

### 6. Создание символической ссылки для фото
php artisan storage:link

### 7. Запуск сервера
php artisan serve

После этого сайт доступен по адресу http://localhost:8000

---

## На Beget

1. Загрузить файлы проекта в папку `public_html` или создать симлинк:
ln -s /путь/к/проекту/public /путь/к/public_html

2. Настроить .env с параметрами базы данных хостинга

3. Убедиться, что используется PHP 8.2

4. Запустить миграции:
php artisan migrate

5. Создать символическую ссылку:
php artisan storage:link
