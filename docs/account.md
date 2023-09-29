# Account API Spec

## Get all account

Endpoint : GET /api/accounts

Response Body Success :

```json
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Account fetched"
    },
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "name": "Transportation",
            "type": "credit",
            "created_at": "2023-09-10T11:15:17.000000Z",
            "updated_at": "2023-09-10T11:15:17.000000Z"
        },
        {
            "id": 2,
            "user_id": 1,
            "name": "Gift",
            "type": "debit",
            "created_at": "2023-09-10T11:18:33.000000Z",
            "updated_at": "2023-09-10T11:18:33.000000Z"
        }
    ]
}
```

## Show detail account

Endpoint : GET /api/accounts/:id

Response Body Success :

```json
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Account found"
    },
    "data": {
        "id": 1,
        "user_id": 1,
        "name": "Transportation",
        "type": "credit",
        "created_at": "2023-09-10T11:15:17.000000Z",
        "updated_at": "2023-09-10T11:15:17.000000Z"
    }
}
```

Response Body Error :

```json
{
    "meta": {
        "code": 404,
        "status": "error",
        "message": "Account not found"
    },
    "data": null
}
```

## Create new account

Endpoint : POST /api/accounts

Request Body :

```json
{
    "name": "Transportation",
    "type": "credit"
}
```

Response Body Success :

```json
{
    "meta": {
        "code": 201,
        "status": "success",
        "message": "Account created successfully"
    },
    "data": {
        "id": 1,
        "user_id": 1,
        "name": "Transportation",
        "type": "credit",
        "created_at": "2023-09-10T11:15:17.000000Z",
        "updated_at": "2023-09-10T11:15:17.000000Z"
    }
}
```

Response Body Error :

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "type": ["The type field is required."]
    }
}
```

## Edit Account

Endpoint : PUT /api/accounts:id

Request Body :

```json
{
    "name": "Transportation Edited",
    "type": "credit"
}
```

Response Body Success :

```json
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Account updated successfully"
    },
    "data": {
        "id": 1,
        "user_id": 1,
        "name": "Transportation Edited",
        "type": "credit",
        "created_at": "2023-09-10T11:15:17.000000Z",
        "updated_at": "2023-09-10T11:29:12.000000Z"
    }
}
```

Response Body Error :

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "type": ["The type field is required."]
    }
}
```

## Delete account

Endpoint : DELETE /api/accounts

Response Body Success :

```json
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Account deleted successfully"
    },
    "data": null
}
```

Response Body Error :

```json
{
    "meta": {
        "code": 404,
        "status": "error",
        "message": "Account not found"
    },
    "data": null
}
```
