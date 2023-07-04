# calendar
<h2 style="color:cyan">Installation</h2>
<p style="color:yellow">Я рекомендую додати домен <b>test-its.ua</b><p>
<p>Ось як ви можете запустити проєкт локально</p>
<p>В "open server" це можна зробити так:<p>
<ul>

1. Клонувати репозиторій:
    ```sh
    git clone https://github.com/kachula-ivan/calendar.git
    ```
     ```sh
     cd calendar
     ``` 

2. 
    ```sh
    composer install
    ``` 
<li>  Просто створити базу даних, без таблиць(назва за замовчуванням: "test-its")</li>

3. 
    ```sh
    cp .env.example .env
    ```
    
<li>  Налаштувати .env файл</li>
<li>  Зайти в "Налаштування" open server, підпункт "Домени"</li>
<ul>
    <li> Управління доменами: "Ручне"</li>
    <li> Ім'я домена: "test-its.ua"</li>
    <li> Папка домена: "\test-itspace\public"</li>
    <li> Кнопка: "Добавити"</li>
</ul>
<li>  Команди в консолі:</li>

4.
 ```sh
 npm install
 npm run dev
 ``` 

5.
 ```sh
 php artisan migrate:fresh --seed
 ``` 

6.
 ```sh
 php artisan queue:work
 ``` 

7.
 ```sh
 cd CalendarBot
 python bot.py
 ```

<li> <a href="http://test-its.ua/">http://test-its.ua/</a> </li>
</ul>
<p style="color:aquamarine">Проте також є простіша версія інсталяції проєкту<p>
<ul>

1. Клонувати репозиторій:
```sh
git clone https://github.com/kachula-ivan/calendar.git
```
```sh
 cd calendar
``` 


2.
 ```sh
 composer install
 ``` 
<li>  Просто створити базу даних, без таблиць(назва за замовчуванням: "test-its")</li>

3. 
    ```sh
    cp .env.example .env
    ```
    
<li>  Налаштувати .env файл</li>

<li>  Команди в консолі:</li>

4.
 ```sh
 npm install
 npm run dev
 ``` 

5.
 ```sh
 php artisan migrate:fresh --seed
 ``` 

6.
 ```sh
 php artisan queue:work
 ``` 

7.
 ```sh
php artisan serve
 ``` 

8.
 ```sh
 cd CalendarBot
 python bot.py
 ```

<li> <a href="http://127.0.0.1:8000/">http://127.0.0.1:8000/</a> </li>
</ul>
