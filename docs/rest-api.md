# REST API Documentation


## GET `/categories`

Get all the categories

```json
{
    "categories": [
        {
            "id": 1,
            "name": "Books",
            "icon": "books.jpg"
        }
    ]
}
```


## POST `/hobbies/add`

Add a hobby

### Request

```json
{
    "categoryId": 2,
    "title": "Book XXX from YYY",
    "description": "Blabla blabla",
    "rating": 2,
}
```

### Response

```json
```


## GET `/users/{id}/hobbies`

Return the latest 30th hobbies of a given user

```json
{
    "user": {
        "id": 4,
        "name": "Liping",
        "nickname": "Lime",
        "avatar": "photo.jpg",
        "followers": 200,
        "following": 30,
    },
    "hobbies": [
        {
            "id": 1,
            "title": "Book XXX from YYY",
            "date": 1596895089,
            "author": {
                "id": 4,
                "name": "Liping",
                "nickname": "Lime",
                "avatar": "photo.jpg"
            },
            "category": {
                "id": 1,
                "name": "Books",
                "icon": "books.jpg"
            },
            "description": "Blabla blabla",
            "photos": ["a.jpg", "b.jpg"],
            "rating": 8,
            "commentsNb": 3
        }
    ]
}
```


## PUT /users/me

Edit oneself's info

```json
{
    "name": "Liping",
    "nickname": "Lime",
    "email": "lime@ema.il",
    "password": "encrypted_password",
    "avatar": "photo.jpg"
}
```


## POST `/users/{id}/follow

Follow a user

### Request

```json
```

### Response

```json
```


## GET /users/{id}/followers

Get all the followers

```json
{
    "followers": [
        {
            "id": 4,
            "name": "Liping",
            "nickname": "Lime",
            "avatar": "photo.jpg"
        }
    ]
}
```

## GET /users/{id}/following

Get all the people a given user follows

```json
{
    "following": [
        {
            "id": 4,
            "name": "Liping",
            "nickname": "Lime",
            "avatar": "photo.jpg"
        }
    ]
}
```


## GET `/hobbies/latest`

Return the latest 30th posts from people you follow

```json
{
    "hobbies": [
        {
            "id": 1,
            "title": "Book XXX from YYY",
            "date": 1596895089,
            "author": {
                "id": 4,
                "name": "Liping",
                "nickname": "Lime",
                "avatar": "photo.jpg"
            },
            "category": {
                "id": 1,
                "name": "Books",
                "icon": "books.jpg"
            },
            "description": "Blabla blabla",
            "photos": ["a.jpg", "b.jpg"],
            "rating": 8,
            "commentsNb": 3
        }
    ]
}
```


## GET `/hobbies/{id}/comments`

Return all the comments of a given hobby

```json
{
    "comments":[
        {
          "id": 1,
          "author": {
              "id": 4,
              "name": "Liping",
              "nickname": "Lime",
              "avatar": "photo.jpg"
          },
          "content": "commentaire1"
        },
        ...
    ]
}
```


## POST /hobbies/{id}/comment

Add a comment on a hobby

### Request

```json
{
    "content": "commentaire1"
}
```


## GET `/categories/{id}/hobbies`

Return the latest 30th posts of a given category

```json
{
    "category": {
        "id": 1,
        "name": "Books",
        "icon": "books.jpg"
    },
    "hobbies": [
        {
            "id": 1,
            "title": "Book XXX from YYY",
            "date": 1596895089,
            "author": {
                "id": 4,
                "name": "Liping",
                "nickname": "Lime",
                "avatar": "photo.jpg"
            },
            "description": "Blabla blabla",
            "photos": ["a.jpg", "b.jpg"],
            "rating": 8,
            "commentsNb": 3
        }
    ]
```





# Currently useless

## GET /users RETURN AN ARRAY CONTAINS ALL THE USERS

```json
{
    "users": [
        "id": Number,
        "name": String,
        "nickname": String,
        "email": String,
        "avatar": String,
    ]
}
```


## GET /users/me

```json
{
    "name":
    "nickname":
    "email":
    "avatar":
}
```
