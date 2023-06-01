# airplane-tickets-api

The goal of this assignment is to create a minimal airplane ticket reservation system as an API. You are free to change / improve features, as well as implement more features you feel should benefit the system.

## Task
Implement a minimal and useful API for an airplane ticket management system. This management system is a service used by 3rd party systems.

One airplane ticket should contain flight departure time, source and destination airport as well as passenger seat which should be a random number (between 1 and 32) per flight and passenger's passport ID.

The API should support following operations:

- Create new Ticket
- Cancel Ticket
- Bonus task: ability to change seat for a given ticket

## Requirements
This project was developed using the TALL Stack
Tailwind, Alpine.js, Laravel, Livewire.

Additionally, it was developer on WSL using Docker, Composer and npm



## Run Locally

Clone the project

```bash
git clone https://link-to-project
```
Go to the project directory
```bash
cd my-project
```
Install Composer
```bash
composer install
```
Install dependencies
```bash
npm install
```
Copy environment from example
```bash
cp .env.example .env
```
Run Laravel Sail
```bash
./vendor/bin/sail up
```
This will take sometime, but after configure the alias for sail
```bash
sudo nano ~/.bashrc
```
Then enter the following under the alias section
```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
You will be able to run instead
```bash
sail up
```
Now, generate app key
```bash
sail artisan key:generate
```
Then, run migration
```bash
sail artisan migrate
```
Then, run seed
```bash
sail db:seed
```
Lastly, run dev
```bash
npm run dev
```
You can now go to 
```bash
http://localhost/
```
After Succesful set up you can log in with 'admin@admin.com password'

For support, email elmohuitz@gmail.com and I wll gladly assist with any questions. 

## API
It uses Sanctum for API, and it stores the bearer token in storage/logs/larave.log
Here is a list of API routes

GET|HEAD        api/airlines ....................................................... airlines.index › Api\AirlineController@index
  POST            api/airlines ....................................................... airlines.store › Api\AirlineController@store
  GET|HEAD        api/airlines/{airline} ............................................... airlines.show › Api\AirlineController@show
  PUT|PATCH       api/airlines/{airline} ........................................... airlines.update › Api\AirlineController@update
  DELETE          api/airlines/{airline} ......................................... airlines.destroy › Api\AirlineController@destroy
  GET|HEAD        api/flights .......................................................... flights.index › Api\FlightController@index
  POST            api/flights .......................................................... flights.store › Api\FlightController@store
  GET|HEAD        api/flights/{flight} ................................................... flights.show › Api\FlightController@show
  PUT|PATCH       api/flights/{flight} ............................................... flights.update › Api\FlightController@update
  DELETE          api/flights/{flight} ............................................. flights.destroy › Api\FlightController@destroy
  GET|HEAD        api/tickets .......................................................... tickets.index › Api\TicketController@index
  POST            api/tickets .......................................................... tickets.store › Api\TicketController@store
  GET|HEAD        api/tickets/{ticket} ................................................... tickets.show › Api\TicketController@show
  PUT|PATCH       api/tickets/{ticket} ............................................... tickets.update › Api\TicketController@update
  DELETE          api/tickets/{ticket} ............................................. tickets.destroy › Api\TicketController@destroy

For Tickets Create
    'flight_id' => 'required|exists:flights,id',
    'holder_name' => 'required',
    'passport_number' => 'required'

For Tickets Update
    'flight_id' => 'nullable|exists:flights,id',
    'holder_name' => 'nullable',
    'passport_number' => 'nullable',
    'update_seat' => 'required|boolean'

In the seeder there have been added (4) Airlines, (1) Flight, (1) Ticket

## Future

Some future upgrades to this project are:
1. add validation for flights to be in the future, as for now it allows any date
2. add an interface to view data
3. fix to more objective code
4. be able to view a list of available seats and/or choose custom seat.
5. add token abilities to make it available to admin, airlines, third party agents.
6. show token in user profile


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
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

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

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
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
