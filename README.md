# Back-end Challenge

A simple Laravel Web and REST API using Passport as OAuth2 authentication.

Web API can be accessed by the root path.

## Installation
* Using git, clone the repository.
* With a command line, go to the root folder and run both "composer install" and "npm install". 
* Create a new .env file from the .env.example or run "copy .env.example .env" in the command line.
* In the newly created .env, insert your database credentials accordingly.
* Generate your App and OAuth keys running "php artisan key:generate" and then "php artisan passport:install".
* Migrate all tables running "php artisan migrate".
* You're ready to go. Run "php artisan serve".

## API Endpoints

- [POST /api/login](#post-login)
- [POST /api/register](#post-register)
- [POST /api/event](#post-event)
- [POST /api/event/copy/{id}](#post-eventcopyid)
- [GET /api/event/{id?}](#get-eventid)
- [PUT /api/event/{id}](#put-eventid)
- [DELETE /api/event/{id}](#delete-eventid)

### User Credentials

#### POST /login

| Body Params | Description                             | Data Type | Required    |
|-------------|-----------------------------------------|-----------|-------------|
| email       | Your unique registered e-mail           | string    | yes         |
| password    | Your password created along with e-mail | string    | yes         |

~~~~
POST /login
{
    "data": {
        "id": 1,
        "name": "Example Name",
        "email": "example@test.com",
        "created_at": "2020-02-01 20:51:54",
        "updated_at": "2020-02-01 20:51:54"
    },
    "access_token": "<access_token>"
}
~~~~

#### POST /register

| Body Params           | Description                                                  | Data Type | Required |
|-----------------------|--------------------------------------------------------------|-----------|----------|
| name                  | Your display name                                            | string    | yes      |
| email                 | A unique e-mail                                              | string    | yes      |
| password              | A password with mininum 6 characters                         | string    | yes      |
| password_confirmation | Password confirmation string. Must be the same as "password" | string    | yes      |

~~~~
POST /register
{
    "data": {
        "id": 2,
        "name": "Newly Created User",
        "email": "registerExample@test.com",
        "created_at": "2020-02-01 20:51:54",
        "updated_at": "2020-02-01 20:51:54"
    },
    "access_token": "<access_token>"
}
~~~~

### Event Handling

All the events endpoints require an Bearer Token, which you can get by [logging or creating a new user at /login or /register](#user-credentials) respectively

| Header Fields | Description                                       | Data Type | Required |
|---------------|---------------------------------------------------|-----------|----------|
| Authorization | A valid access token (e.g. Bearer <access_token>) | string    | yes      |

#### POST /event

| Body Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| title       | The event title                                     | string    | yes      |
| description | A simple description about the event (maximum: 100) | string    | no       |
| date        | The event date (format: YYYY-MM-DD)                 | string    | yes      |

~~~~
POST /event
{
    "title": "Example Title",
    "description": "Example Description",
    "date": "2020-02-01",
    "user_id": 1,
    "updated_at": "2020-02-01 21:55:27",
    "created_at": "2020-02-01 21:55:27",
    "id": 12
}
~~~~

#### POST /event/copy/{id}

| Path Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| id          | id from the original event that will be copied      | number    | yes      |

| Body Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| date        | The new event date (format: YYYY-MM-DD)             | string    | yes      |

~~~~
POST /event/copy/13
{
    "title": "Copy Example Title",
    "description": "Copy Example Description",
    "date": "2025-04-24",
    "user_id": 1,
    "updated_at": "2020-02-01 21:55:27",
    "created_at": "2020-02-01 21:55:27",
    "id": 13
}
~~~~

#### GET /event/{id?}

| Path Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| id          | id from the original event that will be copied      | number    | no       |

~~~~
GET /event/1
{
    "title": "First Title",
    "description": "First Description",
    "date": "2020-01-14",
    "user_id": 1,
    "updated_at": "2020-02-01 20:35:42",
    "created_at": "2020-02-01 20:35:24",
    "id": 1
}
~~~~

Note: If the parameter "id" is not defined, the response will return all the events registered from the authenticated user.
~~~~
GET /event
[
    {
        "title": "First Title",
        "description": "First Description",
        "date": "2020-01-14",
        "user_id": 1,
        "updated_at": "2020-02-01 20:35:42",
        "created_at": "2020-02-01 20:35:24",
        "id": 1
    },
    {
        "title": "Example Title",
        "description": "Example Description",
        "date": "2020-02-01",
        "user_id": 1,
        "updated_at": "2020-02-01 21:55:27",
        "created_at": "2020-02-01 21:55:27",
        "id": 12
    },
    {
        "title": "Copy Example Title",
        "description": "Copy Example Description",
        "date": "2025-04-24",
        "user_id": 1,
        "updated_at": "2020-02-01 21:55:27",
        "created_at": "2020-02-01 21:55:27",
        "id": 13
    }
]
~~~~

#### PUT /event/{id}

| Path Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| id          | id from the event that will be updated              | number    | yes      |
  
| Body Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| title       | Updated event title                                 | string    | no       |
| description | Updated optional description                        | string    | no       |
| date        | Updated event date (format: YYYY-MM-DD)             | string    | no       |
  
~~~~
PUT /event/1
{
    "title": "Updated Title",
    "description": "Updated Description",
    "date": "2020-01-14",
    "user_id": 1,
    "updated_at": "2020-02-01 21:42:58",
    "created_at": "2020-02-01 20:35:24",
    "id": 1
}
~~~~
#### DELETE /event/{id}
  
| Path Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| id          | id from the event that will be deleted              | number    | yes      |

~~~~
DELETE /event/13
{
    "title": "Copy Example Title",
    "description": "Copy Example Description",
    "date": "2025-04-24",
    "user_id": 1,
    "updated_at": "2020-02-01 21:55:27",
    "created_at": "2020-02-01 21:55:27",
    "id": 13
}
~~~~
