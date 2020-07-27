# POST

---
Open application `postman` and copy this url
```php
{apiUrl}/api/v1/novel/create
```

### Parameter
When get data use `required` parameter in bottom

| Field | Type   | Desc |
| : |   :-   |  :  |
| title | String | Title novel  |
| description | String | Description |
| genre | String | Genre  |

#### Example Use
```php
{
    "title": "john",
    "description": "dev",
    "genre": "Comedy"
}
```

### Success Response
| Field | Type   | Desc |
| : |   :-   |  :  |
| novelId | Number | Unique ID Novel  |

```php
HTTP/1.1 200 OK
{
    "STATUS" : true,
    "MESSAGE" : "Success Save Data"
    "DATA" : [
        "novelId": 1
    ]
}