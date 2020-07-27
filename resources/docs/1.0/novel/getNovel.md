# GET

---
Open application `postman` and copy this url
```php
{apiUrl}/api/v1/novel
```

### Parameter
When get data use `required` parameter in bottom

| Field | Type   | Desc |
| : |   :-   |  :  |
| id | Number | Unique ID Novel  |
| title | String | Title novel  |
| genre | String | Genre  |

#### Example Use
```php
{apiUrl}/api/v1/novel?id=1
```

### Success Response
| Field | Type   | Desc |
| : |   :-   |  :  |
| id | Number | Unique ID Novel  |
| title | String | Title novel  |
| genre | String | Genre  |

```php
HTTP/1.1 200 OK
{
    "STATUS" : true,
    "MESSAGE" : "Data Found"
    "DATA" : [
        "id": 1,
        "title": "john",
        "description": "dev",
        "genre": "Comedy",
        "created_at": "2020-05-10"
    ]
}
```