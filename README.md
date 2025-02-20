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
    <h1>Здравствуйте!Добро пожаловать!</h1>
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

## №3.2. Создание маршрутов для задач
Создайте класс-контроллер TaskController для обработки запросов, связанных с задачами
```
php artisan make:controller TaskController
```
2. Добавление методов в TaskController
Откроем app/Http/Controllers/TaskController.php и добавим пустые методы для работы с задачами:

```
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

```
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
```
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
Route::resource('tasks', TaskController::class);
```
Эта строка автоматически создаст маршруты для всех CRUD-операций.

5.Проверка маршрутов
![image](https://github.com/user-attachments/assets/d52bb2d8-d104-40b3-839c-8f0c22d13fc0)
