# Makefile

# Читаем ES_DATA_DIR из .env, если переменная не передана в командной строке
ES_DATA_DIR ?= $(shell grep ^ES_DATA_DIR= .env | cut -d '=' -f2)

# Главная цель — поднять контейнеры
up:
	ES_DATA_DIR=$(ES_DATA_DIR) docker-compose up -d

# Остановить контейнеры
down:
	docker-compose down
