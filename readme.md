# UT Dallas Research Laravel Scaffolding

This is a scaffolding for getting a basic Laravel app up and running with some common things that we probably want in all web apps, including:

- LDAP Authentication

## Installation

- First, make sure you have the [prerequisites for Laravel](https://laravel.com/docs/5.5/installation#server-requirements).

- Clone the project:

```
git clone git@github.com:utdallasresearch/laravel-scaffold.git
```

- Install dependencies:

```
cd laravel-scaffold
composer install
```

- Create your `.env` file. Add your LDAP server info and any other customizations to the `.env` file:

```
cp .env.example .env
```

- Generate an app key:

```
php artisan key:generate
```

- Create and/or set up your database. Copy the database info into the `.env` file. Then, run the migration:

```
php artisan migrate
```

- Install the front-end development dependencies. You can use NPM, but I prefer [Yarn](https://yarnpkg.com/en/docs/install):

```
yarn
```

- Make an awesome app!