# MosBiz Backend API

Backend для сайта Департамента предпринимательства и инновационного развития Москвы. Проект разработан в рамках учебной практики.

## 🚀 Деплой и доступ
*   **Сайт:** [http://kurmanni.beget.tech](http://kurmanni.beget.tech)
*   **API:** [http://kurmanni.beget.tech/api/v1/main-page](http://kurmanni.beget.tech/api/v1/main-page)

## 🔧 Админ-панель
Управление контентом сайта осуществляется через FilamentPHP.
*   **URL:** [http://kurmanni.beget.tech/admin](http://kurmanni.beget.tech/admin)
*   **Логин:** `admin@mail.ru`
*   **Пароль:** `12345`

## 📚 API Endpoints

### `GET /api/v1/main-page`
Получает все данные, необходимые для отображения главной страницы: шапку, главный блок с цифрами, команду, проекты, мероприятия, подведомственные структуры и подвал.

**Пример успешного ответа (200 OK):**
```json
{
  "header": {
    "phone": "+7 (499) 444-16-15",
    "email": "dpir-press@mos.ru"
  },
  "hero": {
    "main_title": "Программы и инструменты для развития бизнеса",
    "statistics": [
      {"value": "105 млрд ₽", "label": "Направлено на поддержку"},
      {"value": "1 млн", "label": "Оказанных услуг"},
      {"value": "250 000", "label": "Поддержанных предпринимателей"}
    ]
  },
  "team": [ ... ],
  "projects": [ ... ],
  "events": [ ... ],
  "footer": { ... }
}
