Installation

Development environment requirements :

    Docker >= 17.06 CE
    Docker Compose

Setting up your development environment on your local machine :

$ git clone https://github.com/roevevgen/blog.git
$ cd laravel-blog
$ cp .env.example .env
$ docker-compose run --rm --no-deps blog-server composer install
$ docker-compose run --rm --no-deps blog-server php artisan key:generate
$ docker-compose run --rm --no-deps blog-server php artisan horizon:install
$ docker-compose run --rm --no-deps blog-server php artisan telescope:install
$ docker-compose run --rm --no-deps blog-server php artisan storage:link
$ docker run --rm -it -v $(pwd):/app -w /app node yarn
$ docker-compose up -d

Now you can access the application via http://localhost:8000.

There is no need to run php artisan serve. PHP is already running in a dedicated container.
Before starting

You need to run the migrations with the seeds :

$ docker-compose run --rm blog-server php artisan migrate --seed

This will create a new user that you can use to sign in :

email: darthvader@deathstar.ds
password: 4nak1n

And then, compile the assets :

$ docker run --rm -it -v $(pwd):/app -w /app node yarn dev

Starting job for newsletter :

$ docker-compose run blog-server php artisan tinker
> PrepareNewsletterSubscriptionEmail::dispatch();

Useful commands

Seeding the database :

$ docker-compose run --rm blog-server php artisan db:seed

Running tests :

$ docker-compose run --rm blog-server ./vendor/bin/phpunit --cache-result --order-by=defects --stop-on-defect

Running php-cs-fixer :

$ docker-compose run --rm --no-deps blog-server ./vendor/bin/php-cs-fixer fix --config=.php_cs --verbose --dry-run --diff

Generating backup :

$ docker-compose run --rm blog-server php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
$ docker-compose run --rm blog-server php artisan backup:run

Generating fake data :

$ docker-compose run --rm blog-server php artisan db:seed --class=DevDatabaseSeeder

Discover package

$ docker-compose run --rm --no-deps blog-server php artisan package:discover

In development environnement, rebuild the database :

$ docker-compose run --rm blog-server php artisan migrate:fresh --seed

Accessing the API

Clients can access to the REST API. API requests require authentication via token. You can create a new token in your user profile.

Then, you can use this token either as url parameter or in Authorization header :

# Url parameter
GET http://laravel-blog.app/api/v1/posts?api_token=your_private_token_here

# Authorization Header
curl --header "Authorization: Bearer your_private_token_here" http://laravel-blog.app/api/v1/posts

API are prefixed by api and the API version number like so v1.

Do not forget to set the X-Requested-With header to XMLHttpRequest. Otherwise, Laravel won't recognize the call as an AJAX request.

To list all the available routes for API :

$ docker-compose run --rm --no-deps blog-server php artisan route:list --path=api

Contributing

Do not hesitate to contribute to the project by adapting or adding features ! Bug reports or pull requests are welcome.
License

This project is released under the MIT license.
