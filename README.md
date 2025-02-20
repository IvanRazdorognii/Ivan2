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
```php
<?php

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
```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']); // Главная страница
Route::get('/about', [HomeController::class, 'about']); // Страница "О нас"
```
## 4. Создание представлений (View)
Laravel ищет представления в папке resources/views. Нужно создать два файла:

## 4.1. Создаём home.blade.php
Откроем resources/views/home.blade.php и добавим:
```php
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
</head>
<body>
    <h1>Здравствуйте!Добро пожаловать!</h1>
</body>
</html>
```
## 4.2. Создаём about.blade.php
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

## №3.2. Создание маршрутов для задач
Создайте класс-контроллер TaskController для обработки запросов, связанных с задачами
```
php artisan make:controller TaskController
```
2. Добавление методов в TaskController
Откроем app/Http/Controllers/TaskController.php и добавим пустые методы для работы с задачами:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Отображение списка задач
    public function index()
    {
        return 'This is a list of tasks';
    }

    // Отображение формы создания задачи
    public function create()
    {
        return 'Task creation form';
    }

    // Сохранение новой задачи
    public function store(Request $request)
    {
        // Здесь будет код сохранения задачи
    }

    // Отображение конкретной задачи
    public function show($id)
    {
        return "Displaying task with ID: $id";
    }

    // Отображение формы редактирования задачи
    public function edit($id)
    {
        return "Editing task with ID: $id";
    }

    // Обновление существующей задачи
    public function update(Request $request, $id)
    {
        // Здесь будет код обновления задачи
    }

    // Удаление задачи
    public function destroy($id)
    {
        // Здесь будет код удаления задачи
    }
}

```
3. Создание маршрутов вручную в routes/web.php
Если бы мы создавали маршруты вручную, код выглядел бы так:

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index'); // Список задач
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create'); // Форма создания
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store'); // Создание задачи
    Route::get('/{id}', [TaskController::class, 'show'])->where('id', '[0-9]+')->name('tasks.show'); // Отображение задачи
    Route::get('/{id}/edit', [TaskController::class, 'edit'])->where('id', '[0-9]+')->name('tasks.edit'); // Форма редактирования
    Route::put('/{id}', [TaskController::class, 'update'])->where('id', '[0-9]+')->name('tasks.update'); // Обновление задачи
    Route::delete('/{id}', [TaskController::class, 'destroy'])->where('id', '[0-9]+')->name('tasks.destroy'); // Удаление задачи
});
```
4. Использование ресурсного контроллера
Laravel позволяет автоматизировать создание маршрутов с помощью Route::resource(). Это заменяет ручное создание маршрутов.

В файле routes/web.php заменим код на:
```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
Route::resource('tasks', TaskController::class);
```
Эта строка автоматически создаст маршруты для всех CRUD-операций.

5.Проверка маршрутов
![image](https://github.com/user-attachments/assets/d52bb2d8-d104-40b3-839c-8f0c22d13fc0)

## №4. Шаблонизация с использованием Blade
### №4.1. Создание макета страницы
В папке resources/views создаtv новую папку layouts и внутри неё создаем файл app.blade.php.

2. Использование макета в других страницах
3. Далее изменим страницу home.blade.php, которая будет использовать этот макет.
```
@extends('layouts.app')
@section('title', 'Главная страница')

@section('content')
    <div class="text-center">
        <h1>Добро пожаловать в ToDo App</h1>
        <p>Здесь вы можете управлять своими задачами.</p>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Список задач</a>
    </div>
@endsection
```
3. Изменение метода index() в HomeController
Откроем app/Http/Controllers/HomeController.php и заменим метод index() на:
```
public function index()
{
    return view('home');
}
```
![image](https://github.com/user-attachments/assets/42fa2556-fd38-4c70-b907-df675956ebdf)

### №4.3. Анонимные компоненты Blade
1. Изменим app.blade.php, добавим
```
<li class="nav-item"><a class="nav-link" href="{{ route('tasks.index') }}">Список задач</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('tasks.create') }}">Создание задачи</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('about') }}">О нас</a></li>
```
## Теперь изменим файл resources/views/home.blade.php, добавим кнопки создавать и редактировать задачи, а так же создадим страницу о нас resources/views/about.blade.php , куда тоже добавим контент

4. Страница задач: tasks/index.blade.php
Создаем папку resources/views/tasks/ и файл index.blade.php в этой папке:
```
@extends('layouts.app')

@section('title', 'Список задач')

@section('content')
    <h1>Список задач</h1>
    <ul>
        @foreach($tasks as $task)
            <li>
                <a href="{{ route('tasks.show', $task['id']) }}">{{ $task['title'] }}</a>
            </li>
        @endforeach
    </ul>
@endsection
```
5. Страница отображения задачи: tasks/show.blade.php
Создаем файл resources/views/tasks/show.blade.php:
```
@extends('layouts.app')

@section('title', 'Задача: ' . $task['title'])

@section('content')
    <h1>{{ $task['title'] }}</h1>
    <p>ID задачи: {{ $task['id'] }}</p>
    <p>Описание задачи: {{ $task['description'] ?? 'Нет описания' }}</p>
    <a href="{{ route('tasks.index') }}">Вернуться к списку задач</a>
@endsection
```
6. Контроллер для задач
Откроем файл app/Http/Controllers/TaskController.php и добавим следующие методы для отображения задач:
```
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Пример статических данных для задач
        $tasks = [
            ['id' => 1, 'title' => 'Задача 1'],
            ['id' => 2, 'title' => 'Задача 2'],
            ['id' => 3, 'title' => 'Задача 3'],
        ];

        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        // Пример статических данных для задачи
        $task = [
            'id' => $id,
            'title' => 'Задача ' . $id,
            'description' => 'Описание задачи ' . $id,
        ];

        return view('tasks.show', compact('task'));
    }
}
```
7. Маршруты для задач
Далее откроем routes/web.php и добавим маршруты для задач и страницы "О нас"

![image](https://github.com/user-attachments/assets/9be8c389-eec5-401c-98ae-b021893f8a8c)

![image](https://github.com/user-attachments/assets/7cb76d25-5e4f-4220-9a65-a6d60cd1af0e)

## №4.4. Стилизация страниц
Создадим файл стилей app.css в каталоге public/css, подключим его к макету layouts/app.blade.php и создадим стиль страницы.

## Контрольные вопросы
### Что такое ресурсный контроллер в Laravel и какие маршруты он создает?
Ресурсный контроллер создаёт маршруты для CRUD операций: index, create, store, show, edit, update, destroy.

### Объясните разницу между ручным созданием маршрутов и использованием ресурсного контроллера.
Ручное создание требует указания маршрутов вручную, ресурсный контроллер генерирует их автоматически.

### Какие преимущества предоставляет использование анонимных компонентов Blade?
Анонимные компоненты Blade упрощают создание и повторное использование HTML-фрагментов.

### Какие методы HTTP-запросов используются для выполнения операций CRUD?
GET — для чтения, POST — для создания, PUT/PATCH — для обновления, DELETE — для удаления.
