Scrapper Application
====================

Demo CLI application used to scrap content from other sources over the Internet, 
based on Laravel 5.5 framework.

Architecture
------------

A standalone package was created under `Scrapped` namespace, loaded from `src` folder via Composer, which takes the responsability to
implement a different classes, one for each source.

Each source class implements `Scrapper\SourceInterface` which exposes methods to list all availiable URLs
and to parse each individual URL.

A service-level class `Scrapper\ScrapperService` is used to handle the sources and it's integrated on Laravel
framework as a container service.

Under Laravel's architecture there is a model `Post` to store collected data into the database.

A migration class is available to create the database schema.

Two CLI commands are available to run the application:
- `php artisan scrapper:list`
- `php artisan scrapper:load {source} {limit}`

Check Artisan's help for details on arguments.

How to run
----------

1. Clone the code from Git repository
2. Run `composer install`
3. Create a new empty database on MySQL.
4. Update `.env` with database settings.
5. Run `php artisan migrate` to create database schema.

After that the application is ready to use.

Further improvements
--------------------

- Complete/improve source parsers.
- Implement promises to allow parallel loading on sources.
- Implement queued events in order to provide mass loading.
- Write unit tests to make code ready for CI.