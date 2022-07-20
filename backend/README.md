# MailUp back-end challenge

A Laravel/MySQL challenge for MailUp.

## Environment requirements

- PHP ^8.0
- MySQL

## Installation

- Run the migrations `php artisan migrate`.
- Seed the database `php artisan db:seed`.
- Start local server `php artisan serve`.

## Endpoints

```curl
GET /api/products
POST /api/products
GET /api/products/:id
PUT /api/products/:id
DELETE /api/products/:id
```

## Topics

- MySQL
- Eloquent
- Routing
- Responses
- Http codes
- Seeders
