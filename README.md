1. chmod +x generate-ssl.sh
   ./generate-ssl.s
2. docker compose up -d

API
Соглашения
Все запросы осуществляются методом GET на адрес: https://postback-sms.com/api/, с указанием метода и передачей необходимых параметров.
Все ответы возвращаются в виде JSON.
Если в описании результата метода не указан явно статус ответа, то считать его 200.
При отсутствии обязательных параметров приложение отдаёт 'error', а в теле ответа содержится описание ошибки в следующем формате:
{
"code":"error",
"message":"Not parameters passed"
}




Методы
method
description
getNumber
Получить номер телефона (по региону и сервису)
getSms
Получить SMS для номера телефона (по activation id)
cancelNumber
Отменить номер (по activation id)
getStatus
Получить статус активации (по activation id)





Получить номер телефона (по региону и сервису)
GET /getNumber
Входные параметры:
{
"action": "getNumber",
"country": "se",
"service": "wa",
"token": "qergt34gqewf3245y6364ywergwergwergw234123r123r",
"rent_time": 4   //optional - если нужна аренда номера на определенное время (в часах)
}
Результат
{
"code":"ok",
"number":"18181817177",
"activation":"10869836",
"end_date":"2022-09-01 18:16:00", //если передавался параметр rent_time
"cost":0.01
}
Ошибки
{
"code":"error",
"message": "Number not found. Try again"
}












Получить SMS для номера телефона (по activation id)
СМС можно получать множественное количество раз в течение всего срока аренды номера
GET /getSms
Входные параметры:
{
"action": "getSms",
"token": "qergt34gqewf3245y6364ywergwergwergw234123r123r",
"activation": "10869836",
}
Результат
{
"code":"ok",
"sms":"12345"
}
Ошибки
{
"code":"error",
"message": *


    * "The 18181817177 number not found. Try again or change the service"
    * "SMS is not available for this number and service. Try change the service"
    * "There is no sms yet. Try again later"
}












Отменить номер (по activation id)
GET /cancelNumber
Входные параметры:
{
"action": "cancelNumber",
"token": "qergt34gqewf3245y6364ywergwergwergw234123r123r",
"activation": "10869836",
}
Результат
{
"code":"ok",
"activation":"10869836",
"status":"canceled"
}
Ошибки
{
"code":"error",
"message": *


    * "The 18181817177 number not found. Try again or change the service"
    * "The phone number is already canceled"
    * "The phone number cannot be canceled because an SMS has been received"
}














Получить статус активации (по activation id)
GET /getStatus
Входные параметры:
{
"action": "getStatus",
"token": "qergt34gqewf3245y6364ywergwergwergw234123r123r",
"activation": "10869836",
}
Результат
{
"code":"ok",
"status": *,
"count_sms":4,
"end_rent_date":"2022-10-04 13:09:05"   //для арендованных номеров
}
* Статусы
- Waiting first sms
- SMS received. You can get more
- SMS not received. Activation canceled
- SMS received. Activation finished
  Ошибки
  {
  "code":"error",
  "message": "Invalid activation value specified"
  }

