# Finbridge тестовое задание

скопируйте настройки окружения .env в отдельный файл .env.local и проставте настройки которые вам нужны

проект нужно собрать с помощь docker-compose командой `docker-compose up`
когда образ соберется и запустится успешно нужно зайти в него через `docker-compose exec app sh` и выполнить команды `composer update && php yii migrate --interactive=0`