# Auth API Spec

## Register User

Endpoint : POST /api/register

Request Body :

```json
{
    "name": "User",
    "email": "user@gmail.com",
    "password": "user1234"
}
```

Response Body Success :

```json
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Register success"
    },
    "data": {
        "user": {
            "name": "User",
            "email": "user@gmail.com",
            "updated_at": "2023-09-10T06:38:27.000000Z",
            "created_at": "2023-09-10T06:38:27.000000Z",
            "id": 1
        },
        "token_type": "Bearer",
        "token": "1|rGeCuWdjligBCncK4PaZsyMMY80QlQwFPl9FJ9YL"
    }
}
```

Response Body Error :

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

<br>

## Login User

Endpoint : POST /api/login

Request Body :

```json
{
    "email": "user@gmail.com",
    "password": "user1234"
}
```

Response Body Success :

```json
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Login success"
    },
    "data": {
        "user": {
            "id": 1,
            "name": "User",
            "email": "user@gmail.com",
            "email_verified_at": null,
            "created_at": "2023-09-10T06:38:27.000000Z",
            "updated_at": "2023-09-10T06:38:27.000000Z"
        },
        "token_type": "Bearer",
        "token": "3|Xx0ykq1JE7Gv3kcBqvB4Uxw839QqfZeGxfl3sE5J"
    }
}
```

Response Body Error :

```json
{
    "meta": {
        "code": 401,
        "status": "error",
        "message": "Unauthorized"
    },
    "data": null
}
```

<br>

## Logout User

Endpoint : POST /api/logout

Response Body Success :

```json
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Logout success"
    },
    "data": null
}
```

Response Body Error :

```json
{
    "message": "Unauthenticated."
}
```
