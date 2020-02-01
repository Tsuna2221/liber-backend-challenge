## API Endpoints
- POST /login
- POST /register
- POST /event
- POST /event/copy/{id}
- GET /event/{id?}
- PUT /event/{id}
- DELETE /event/{id}

### User Credentials

POST /login
| Body Params | Description                             | Data Type | Required    |
|-------------|-----------------------------------------|-----------|-------------|
| email       | Your unique registered e-mail           | string    | yes         |
| password    | Your password created along with e-mail | string    | yes         |

POST /register
| Body Params           | Description                                                  | Data Type | Required |
|-----------------------|--------------------------------------------------------------|-----------|----------|
| name                  | Your display name                                            | string    | yes      |
| email                 | A unique e-mail                                              | string    | yes      |
| password              | A password with mininum 6 characters                         | string    | yes      |
| password_confirmation | Password confirmation string. Must be the same as "password" | string    | yes      |

### Event Handling

POST /event
| Body Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| title       | The event title                                     | string    | yes      |
| description | A simple description about the event (maximum: 100) | string    | no       |
| date        | The event date (format: YYYY-MM-DD)                 | string    | yes      |

POST /event/copy/{id}

| Path Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| id          | id from the original event that will be copied      | number    | yes      |

| Body Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| date        | The new event date (format: YYYY-MM-DD)             | string    | yes      |

GET /event/{id}

| Path Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| id          | a unique id from a event                            | number    | no       |

Note: If the parameter "id" is not defined, the response will return all the events registered from the authenticated user.

PUT /event/{id}

| Path Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| id          | id from the event that will be updated              | number    | yes      |

DELETE /event/{id}

| Path Params | Description                                         | Data Type | Required |
|-------------|-----------------------------------------------------|-----------|----------|
| id          | id from the event that will be deleted              | number    | yes      |
