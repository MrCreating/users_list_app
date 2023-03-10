# Users list app

### Тестовое приложение со списками пользователей

## Запуск проекта
* Выполнить `git clone https://github.com/MrCreating/users_list_app`
* Перейти в корень проекта
* Выполнить `docker-compose build`
* Выполнить `docker-compose up -d`
* Перейти в браузере по адресу `http://localhost`

## Для остановки проекта
* Перейти в корень проекта
* Выполнить `docker-compose down`

## Папки и их назначение
* `bin` - ядро проекта (здесь основные объекты и компоненты)
* `build` - Docker-файлы
* `config` - Конфиги для разных сервисов
* `public` - точка входа и JS/CSS