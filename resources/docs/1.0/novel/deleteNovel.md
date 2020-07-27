# DELETE

---
Open application `postman` and copy this url
```php
{apiUrl}/api/v1/novel/delete/{id}
```

### Parameter
When get data use `required` parameter in bottom

| Field | Type   | Desc |
| : |   :-   |  :  |
| id | Number | Unique ID  |

### Success Response
| Field | Type   | Desc |
| : |   :-   |  :  |
| data | object[] | empty array  |

```php
HTTP/1.1 200 OK
{
    "STATUS" : true,
    "MESSAGE" : "Success Delete Data"
    "DATA" : []   
}