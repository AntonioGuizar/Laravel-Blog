
# Promass Technical Test

Web application (Blog) developed in Laravel version 10



## Run Locally

Use the terminal of your OS for execute the following commands

Clone the project

```bash
    git clone git@github.com:AntonioGuizar/Protec.git
```

Go to the project directory

```bash
    cd my-project
```

Install dependencies

```bash
    composer install
    npm install
```

Rename the .env file

```bash
    mv .env.example .env
```

Configure the database into the .env file, set a database name and use your user and password to allow the database creation

```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=protec
    DB_USERNAME=root
    DB_PASSWORD=
```

Generate the APP KEY

```bash
    php artisan key:generate
```

Run migrations to populate the database

```bash
    php artisan migrate --seed
```

The last command will create the database, tables and some example data

Start the Laravel server

```bash
    php artisan serve
```

Start the development server

```bash
    npm run dev
```

Remember that you are in a development environment, so the application needs to run the development server. If you want to make changes, this will help you with Laravel hot reload and debugger.

## Congratulations, the application is running
You can use the aplication in http://127.0.0.1:8000

#### Now you can see the posts list and login or register an user

There are 3 test user, you can use one of them or create your own user

**Each test user has 5 posts created**


```bash
    email: user1@example.com
    password: password1

    email: user2@example.com
    password: password2

    email: user3@example.com
    password: password3
```

#### As a guest you will be able to see the list of posts and the full content of each post.

#### As a user you can create, edit or delete the posts you have created.

## Requirements

To run this application you must take into account the following requirements.

- PHP >= 8.1
- Composer
- A database server running (MySQL)



## Authors

- [@antonioguizar](https://www.github.com/antonioguizar)

