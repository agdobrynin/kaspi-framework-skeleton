# kaspi-framework-skeleton


клонируем
````bash
git clone https://github.com/agdobrynin/kaspi-framework-skeleton.git
````
переходим в созданную директорию
````bash
cd kaspi-framework-skeleton
````
копируем и настраиваем .env и миграции phinx.yml
````bash
cp .env.dist .env
cp phinx.yml.example phinx.yml
````
устанавливаем зависимсти
````bash
composer install
````
запускаем миграции БД для проекта (пока ищем подходящее решение)
````bash

````

стартуем проект с встроенным web сервером в php
````bash
composer serve
````
переходим по адресу http://localhost:8080 

