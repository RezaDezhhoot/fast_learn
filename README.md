# Fast Learn

A system for online studying

## Get start

After receiving the project, execute the following command to get dependencies
````bash
composer install
````

In the next step run
````bash
cp .env.example .env 
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
php attisan app:start
````
Then
````bash
php attisan serve
````
Now you can enter the admin panel from the address ****127.0.0.1:8000/auth**** with the phone and password of the **1234** - **admin**
