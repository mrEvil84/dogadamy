
## How to start dogadamy
- clone repo
- docker up  : ./vendor/bin/sail up 
- strona na porcie 82 : http://localhost:82/

- Uwaga::jesli bedziesz testowal z poziomu Postmana albo innego klienta to trzeba z pliku .env odkomentowac linie:
- DB_HOST=dogadamy_mysql_1 (nazwa ta to nazwa kontenera sql na dockerze, jest jakis issue laravelowy ze innaczej nie dziala) 
- i zakomentowac linie: 
- DB_HOST=127.0.0.1 
- podobna uwaga ponizej jak chce sie testowac z poziomu testow

- api endpoints: http://localhost:82/api/categories/[locale]
- db na porcie : 3307
- z konsoli wejsc do katalogu projektu i wykonac polecenia  

- sudo chmod -R 777 ./storage/logs/
- sudo chmod -R 777 ./storage/framework/

## 1. baza danych 

### 1.1 migracja
- php artisan migrate

### 1.2 seedowanie bazy danych 
- php artisan db:seed --class=LocaleSeeder
- php artisan db:seed --class=CategoriesSeeder

## zmiana konfiguracji (!!!)

- wyedytowac plik .env , ustawic linijke na : DB_HOST=dogadamy_mysql_1  , nazwa db host to nazwa kontenera , nazwe dostaniesz z polcenia: docker-compose ps

## endpointy do zadania : 

- [GET] : http://localhost:82/api/categories/en
- [POST] : http://localhost:82/api/categories/en , {'category_name' : string, 'locale': string}

## Testowanie: 

### Testowanie endpointow przez phpunit real connection tests (zakladam ze php jest zainstalowany w /usr/bin/php):
- wejsc do konsoli i do katalogu projektu , uruchmic poleceniem:
- /usr/bin/php ./vendor/phpunit/phpunit/phpunit --configuration ./phpunit.xml

## Gdzie szukac podgladu logowania, tego co leci z eventu podczas tworzenia kategorii
- ./storage/logs/laravel.log

## 2. rabbit mq 

### 2.1 Copy env

```bash
cp .env.pellet_box .env
```

### 2.2 Testowanie publishera (dane testowe)
```
curl --location --request POST 'http://localhost:82/api/restricted/pellet/consume' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODJcL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2NDM3Mjg2MjcsImV4cCI6MTY0MzczMjIyNywibmJmIjoxNjQzNzI4NjI3LCJqdGkiOiIwYmRQQ05GUlIwOExVY1h6Iiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.nQl0EBYjZOjXDcKOrjTlRocp5vI3oMKA0sYHW3V9Kv8' \
--form 'name="Piotr Kowerzanow"' \
--form 'email="piotr.kowerzanow@gmail.com"' \
--form 'password="admin1234"' \
--form 'password_confirmation="admin1234"'
```

### 2.3 Testowanie consumera
- docker exec -it pellet-box_webserwer_1 bash
- php artisan pellet:consume-unit
 
- docker exec -it pellet-box_mysql_1 bash
- mysql -u sail -p 
- pass is : password
- select * from pelletbox.pellet_usage;


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
