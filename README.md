### Задание:
Создать апи для библиотеки. У книг есть название и авторы, у автора есть
имя.

### Методы:

● Получить список книг

● Получить одну книгу со всеми авторами

● Получить список книг по конкретному автору

● Добавление новой книги

● Отредактировать книгу

● Добавление нового автора

### Технологии:

● Задание должно быть выполнено на фреймворке Laravel

● База данных: MySQL, MariaDB, PostgreSQL

### Усложнения (не обязательно):

❖ Документация OpenApi

❖ Тесты

❖ Аутентификация через JWT токены

❖ Версионность

❖ Использовать Docker, сервис должен запускаться с помощью docker-compose up

# Решение
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

REST-like API на основе Laravel с версионированием API через URI, версионированием репозитория согласно спецификации SemVer, авторизацией по JWT токенам, тестами, документацией OpenAPI v3.0.0 и контейнеризацией в Docker.
Из инструментов статич. анализа PHP Codesniffer.  
Недоработка RESTful в виде преднамеренного отсутствия HATEOAS (возможна доработка в будущем)

В основу архитектуры старался заложить Onion Architecture 
https://jeffreypalermo.com/tag/onion-architecture/

###  Docker

Контейнеры собирались под Xubuntu

Чтобы запустить, наберите в консоли docker-compose up --build

Откройте в браузере **mysite.local**

Не забудьте добавить **mysite.local** в hosts.