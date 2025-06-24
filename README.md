# Mémoire

An inventory management application built with [Laravel](https://laravel.com/docs/12.x) and [Filament](https://filamentphp.com/docs/4.x).

## Install

Make sur to use PHP 8.2 or higher.

```
composer install
```

And node 18 or higher.

```
npm install
```

Create `.env`:

```
cp .env.example .env
```

Create database:
- using mysql: `create database memoire;`
- using sqlite:
  - `touch database/database.sqlite`
  - set `DB_CONNECTION=sqlite` in `.env`

Generate app key:

```
php artisan key:generate
```

Create link from public/storage to storage/app/public:

```
php artisan storage:link
```

Run migrations and seeders:

```
php artisan migrate --seed
```

## Run

```
composer run dev
```

## Data model

- https://excalidraw.com/#json=jEchcqJC6gQCgpv8KwJ6R,3zmDpjz_lEzJViPD3KZAPw
