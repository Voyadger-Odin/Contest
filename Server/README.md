# Laravel + Docker + Nginx + MySQL + Redis

![title.png](info%2Fimg%2Ftitle.png)


# Порядок установки

1. Создать файл `.env` в корневой директории по образу [.env_template](.env_template)
2. В файле `.env`
   * Настроить имя проекта (**APP_NAME**)
   * Настроить параметры MySQL
   * Настроить порты
3. В файле `config/nginx/config.d/nginx.conf` настроить **root** на своё имя проекта (**APP_NAME**) 

   ![nginx_root.png](info%2Fimg%2Fnginx_root.png)
4. Из корневой папки запустить команду `sudo docker-compose run composer create-project laravel/laravel .`

5. Из корневой папки запустить команды
   * `sudo chmod -R 777 src` (Меняет права доступа папки `/src`)
   * `sudo chmod -R 777 dbdata` (Меняет права доступа папки `/dbdata`)
6. В файле `src/.env`
   * Настроить MySQL
   * Настроить Redis
7. Установить Redis командой `sudo docker-compose run composer require predis/predis`
8. Запустить контейнеры командой `sudo docker-compose up -d nginx`

**Всё готово**

# Ссылки

**Главная страница:** http://localhost:8000/

**phpMyAdmin:** http://localhost:8001/

**phpRedisAdmin:** http://localhost:8002/

# MySQL

![logo-mysql.png](info%2Fimg%2Flogo-mysql.png)

В локальной системе порт 3316, в контейнерах 3306

Имя хоста такое же, как у контейнера (`mysql`)

Конфигурация MySQL в **laravel** в файле `/src/.env`:
```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel
DB_PASSWORD=password
```

**phpMyAdmin:** http://localhost:8001/

# Redis

![redis-icon.svg](info%2Fimg%2Fredis-icon.svg)

В локальной системе порт 6379, в контейнерах 6379

Имя хоста такое же, как у контейнера (`redis`)

Конфигурация Redis в **laravel** в файле `/src/.env`
```dotenv
REDIS_HOST=redis
REDIS_USERNAME=redis
REDIS_PASSWORD=
REDIS_PORT=6379
REDIS_CLIENT=predis
REDIS_PREFIX=${APP_NAME}
```

**phpRedisAdmin:** http://localhost:8002/

---

# Команды

## Artisan
Команда для запуска artisan `sudo docker-compose run artisan`

**Пример:**

`sudo docker-compose run artisan migrate`

## Docker-compose

### Запустить

`sudo docker-compose up -d`

### Запустить только контейнер nginx

`sudo docker-compose up -d nginx`

При запуске автоматически запустятся контейнеры:
- php
- mysql
- redis

А также административные контейнеры:
- php-my-admin
- php-redis-admin

### Остановить

Просто остановить

`sudo docker-compose down`


Остановить и удалить

`sudo docker-compose down -v`


### Логи

`sudo docker-compose logs mysql`


### Изменять права доступа для проекта на текущего пользователя в текущей папки

`sudo chown -R $USER:$USER .`


### Изменить права доступа для папки storage в проекте

`sudo chmod -R 777 src`

## Полезные ссылки

[Ссылка на хороший урок](https://www.youtube.com/watch?v=5bSA__OWebM&list=PLVbFKmfZNpmS7vzmlwL3j7Mek7EMOGycN&index=9)

[Документация по phpRedisAdmin](https://hub.docker.com/r/erikdubbelboer/phpredisadmin/)