# kaspi-framework-skeleton

Демо приложение для простого [фреймворрка kaspi-framework](https://github.com/agdobrynin/kaspi-framework) демонстрирующим MVC паттерн для web приложений, с реализацией простого контейнера зависимостей, роутинга, рендеринга шаблонов, и очень простой ORM позволяющей работать моделями данных в базе.

---

### Старт демо-приложения

Клонируем
````shell
git clone https://github.com/agdobrynin/kaspi-framework-skeleton.git
````
переходим в созданную директорию
````shell
cd kaspi-framework-skeleton
````
копируем и настраиваем .env
````shell
cp .env.dist .env
````
_в файле `.env` есть параметры для входа как администратор в демо приложение `ADMIN_LOGIN` и `ADMIN_PASSWORD` измените их если требуется_

⚠ Потребуется установленный 🐳 docker или же 🐋 docker desktop 
проект будет работать как на Windows с поддержкой WSL2 так 
и на Linux машине.

Для сборки образа выполните команду в директории проекта
```shell
docker-compose up -d --build
```

Устанавливаем зависимости в запущенном контейнере **web** от имени пользователя **dev** в контейнере
````shell
docker-compose exec -u dev web composer install
````
Настраиваем миграции БД для проекта и запускам их
```shell
docker-compose exec -u dev web ./vendor/bin/kaspi-migrate -c config/config.php init
```
```shell
docker-compose exec -u dev web ./vendor/bin/kaspi-migrate -c config/config.php up
````

переходим по адресу http://localhost:8080 

