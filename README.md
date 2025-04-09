### Развертывание:

- Установить Symfony CLI: https://symfony.com/download
- Установить зависимости ```composer install```
- Создать файл БД: var/data.db и выполнить ```php bin/console doctrine:database:create```
- Выполнить миграции ```php bin/console doctrine:migrations:migrate```
- Запуск локального сервера ```symfony server:start```
- Перейти ```http://127.0.0.1:8000/```

### API для локального теста

### Метод парсинга

1. Отправляет файл для обработки.

   - **URL**: `POST http://127.0.0.1:8000/parsing/`

       **Параметры**:
      - `file` (обязательный) - Файл для обработки. Должен быть отправлен как часть form-data.

      **Пример успешного ответа:**

     - ``{
          "status": 200,
          "message": "Данные успешно сохранены",
          "id": <id записи в БД>
      }``