# Лабораторная работа №2. HTTP-запросы и шаблонизация в Laravel 
# Цель работы:
Изучить основные принципы работы с HTTP-запросами в Laravel и шаблонизацию с использованием Blade на основе веб-приложения To-Do App для команд — приложения для управления задачами внутри команды.Приложение предназначено для команды, которая хочет управлять своими задачами, назначать их участникам, отслеживать статус и приоритет задач (похоже на Github Issues).
# №1. Подготовка к работе, установка Laravel
Откройте терминал и создайте новый проект Laravel с именем todo-app (имя проекта может быть любым) с помощью Composer: bash composer create-project laravel/laravel:^10 todo-app
Перейдите в директорию проекта: bash cd todo-app
Запустите встроенный сервер Laravel: bash php artisan serve Вопрос: Что вы видите в браузере, открыв страницу http://localhost:8000?
### Вижу главную страничку Laravel
# №2. Настройка окружения
Откройте файл .env и укажите следующие настройки приложения: ini APP_NAME=ToDoApp APP_ENV=local APP_KEY= APP_DEBUG=true APP_URL=http://localhost:8000
Сгенерируйте ключ приложения, который будет использоваться для шифрования данных: bash php artisan key:generate Вопрос: Что будет, если данный ключ попадет в руки злоумышленника?
### Если APP_KEY попадёт к злоумышленнику, он сможет расшифровать данные, подделывать сессии и токены API. Чтобы защититься, не загружайте .env в репозиторий, а при утечке сразу замените ключ и обновите зашифрованные данные.
# №3. Основы работы с HTTP-запросами
## 1.1. Открываем терминал и создаём контроллер
```
php artisan make:controller HomeController
```
## Добавление методов в HomeController
Открываем app/Http/Controllers/HomeController.php и добавляем два метода:
### 2.1. Метод index() для главной страницы
Метод будет возвращать представление home.blade.php.
```<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // Возвращает представление home.blade.php
    }

    public function about()
    {
        return view('about'); // Возвращает представление about.blade.php
    }
}
```
## 3. Создание маршрутов
Откроем файл routes/web.php и добавим маршруты:
```
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']); // Главная страница
Route::get('/about', [HomeController::class, 'about']); // Страница "О нас"
```
## 4. Создание представлений (View)
Laravel ищет представления в папке resources/views. Нужно создать два файла:

### 4.1. Создаём home.blade.php
Откроем resources/views/home.blade.php и добавим:
```
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
</head>
<body>
    <h1>Добро пожаловать на главную страницу!</h1>
</body>
</html>
```
4.2. Создаём about.blade.php
Откроем resources/views/about.blade.php и добавим:
```
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>О нас</title>
</head>
<body>
    <h1>О нас</h1>
    <p>Здесь будет информация о нашей компании.</p>
</body>
</html>
```
![image](https://github.com/user-attachments/assets/f0ff828e-ba01-45c6-8bb7-fc8676507cce)
