# Finbridge тестовое задание

Скопируйте настройки окружения .env в отдельный файл .env.local и проставте настройки которые вам нужны

Проект нужно собрать с помощь docker-compose командой `docker-compose up`

Когда образ соберется и запустится успешно нужно зайти в него через `docker-compose exec app sh`

и выполнить команды `composer update && php yii migrate --interactive=0`
