## Что делает

При вводе адреса в форму на главной странице, проверяет есть ли уже в базе адреса с таким городом или посчелением. Если есть, сообщает об этом и сохраняет адрес. Если нет, просто сохраняет.
На странице вывода адресов показывает, сколько есть адресов по регионам.

## Установка
- Склонируйте к себе репозиторий
- Укажите в .env доступы к базе данных, а также `DADATA_TOKEN` и `DADATA_SECRET` ( регистрация в dadata.ru [тут](https://dadata.ru/) )
- Выполните команду:

```sh
$ make install
```
