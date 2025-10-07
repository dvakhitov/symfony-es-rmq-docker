# Symfony + Elasticsearch Starter

Этот проект представляет собой **готовую Docker-среду для быстрого старта** разработки REST API на **Symfony 7.2** с использованием **PHP 8.4**, **PostgreSQL**, **Elasticsearch**, **RabbitMQ** и **Kibana**.

---

## 🧩 Назначение

Шаблон предназначен для упрощения настройки окружения при создании проектов с использованием современного backend-стека:  
Symfony, PostgreSQL, Elasticsearch и RabbitMQ.

Он позволяет сразу приступить к разработке — без необходимости вручную настраивать инфраструктуру и связи между сервисами.

---

## 🚀 Функциональность

- **REST API на Symfony 7.2** — базовый пример CRUD-операций.
- **DTO + Валидация** — входящие данные сериализуются и проверяются.
- **Elasticsearch** — интегрирован для полнотекстового поиска.
- **RabbitMQ** — используется для асинхронной индексации и фоновых задач.
- **Kibana** — подключена для визуализации и анализа данных Elasticsearch.
- **PostgreSQL** — основная реляционная база данных проекта.

---

## ⚙️ Стек технологий

- PHP 8.4
- Symfony 7.2
- PostgreSQL
- RabbitMQ
- Elasticsearch 7.17
- Kibana 7.17
- Docker & Docker Compose
- Nginx
- Doctrine ORM
- PHPUnit

---

## 🧱 Архитектура контейнеров

- `php` — Symfony-приложение
- `nginx` — веб-сервер
- `postgres` — база данных
- `elasticsearch`, `elasticsearch2` — кластер Elasticsearch
- `kibana` — интерфейс для Elasticsearch
- `rabbitmq` — брокер сообщений

---

## 🔧 Установка

Клонируйте репозиторий:
```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
```

Установите зависимости:
```bash
composer install
```

Скопируйте файл окружения:
```bash
cp .env .env.local
```

Создайте базу данных и выполните миграции:
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

---

## 🐳 Запуск через Docker

```bash
docker-compose up -d
```

После запуска:
- Symfony API → [http://localhost:8080](http://localhost:8080)
- Kibana → [http://localhost:5601](http://localhost:5601)
- RabbitMQ UI → [http://localhost:15672](http://localhost:15672) (логин: `user`, пароль: `password`)

---

## 📘 Документация API

Swagger-документация доступна по адресу:  
[http://localhost:8080/api/doc](http://localhost:8080/api/doc)

---

## 🧪 Тестирование

Подготовка тестовой базы данных:
```bash
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:schema:create
php bin/console --env=test doctrine:fixtures:load
```

Запуск тестов:
```bash
./bin/simple-phpunit
```

---

## 🧰 Применение

Этот шаблон можно использовать как:
- основу для разработки новых REST API проектов;
- окружение для экспериментов с интеграцией Elasticsearch, RabbitMQ и Symfony;
- базу для учебных и демонстрационных проектов.

---

💡 *На основе этого шаблона можно быстро развернуть новый проект, добавив свои сущности, маршруты и бизнес-логику.*