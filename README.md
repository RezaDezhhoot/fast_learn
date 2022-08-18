# Fast Learn

A system for online studying

## Get start

After receiving the project, run
````bash
cp .env.example .env 
````

In the next step execute the following command to get dependencies
````bash
composer install
````
Now run
````bash
php artisan key:generate
````
And migrate
````bash
php artisan migrate 
````
And in the last step, you can enter the following command to access the app
````bash
php artisan app:start
````
Then
````bash
php artisan serve
````
Now you can enter the admin panel from the address ****127.0.0.1:8000/auth**** with the phone and password of the **1234** - **admin**
