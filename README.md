# Тестовое задание для компании Elfsight

Использованные технологии:

- Symfony 6.4 (Мой первый опыт использования фреймворка)
- MySQL
- PHP 8.2

## Разворачивание проекта

1. Клонируем репозиторий: git clone https://github.com/GenduDeveloper/elfsight-test-task.git
2. Заполняем `.env` для первого запуска контейнров (потом переносим всё .env.local, а .env остается без значений)

Обязательно для заполнения:

MYSQL_ROOT_PASSWORD=    
MYSQL_DATABASE=    
MYSQL_USER=   
MYSQL_PASSWORD=   
DATABASE_URL=

Для работы внешнего API указываем базовый URL:

RICK_AND_MORTY_API_BASE_URL=https://rickandmortyapi.com/api/

3. Билдим и поднимаем контейнеры:

`docker compose up -d --build`

4. Устанавливаем зависимости:

`docker compose exec app composer install`


4. Запускаем миграции из контейнера `app`:

`docker compose exec app bin/console doctrine:migrations:migrate`

5. Проект будет доступен по адресу: `http://127.0.0.1:8080`

## Endpoints

Получение списка эпизодов из стороннего API:   
`GET` http://127.0.0.1:8080/api/v1/episodes

Добавление отзыва к эпизоду:   
`POST` http://127.0.0.1:8080/api/v1/episodes/{episodeId}/reviews

Получение конкретного эпизода с 3 последними отзывами:   
`GET` http://127.0.0.1:8080/api/v1/episodes/{episodeId}

Postman коллекция находится в папке `src/PostmanCollection`
