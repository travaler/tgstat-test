создать таблицу с двумя столбцами

дата перехода | юзер
21.07.2022      1234

при каждом переходе вставлять в нее строку
при выводе статистики делать группировку по дате

если нагрузка слишком большая, то надо использовать какой-нибудь буфер перед записью
например, redis, apache kafka, куда сначала будет все складироваться, а оттуда уже в базу пачками записываться
вместо базы можно использовать clickhouse
он хорошо подходит для большого количества инсертов и отображения группированных данных