# PUT

---
Open application `postman` and copy this url
```php
{apiUrl}/api/v1/novel/update/{id}
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
    "title": "Doe",
    "description": "dev",
    "genre": "Adventure"
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
    "MESSAGE" : "Success Update Data"
    "DATA" : [
        "novelId": 1
    ]   
}