Ensure that you have composer installed and have php7.2 and the following php7.2 extensions installed:  
`php72-mbstring php72-xml php72-fpm php72-pdo php72-myslnd`

Go to your /var/www/html folder  
Clone Repository:  
`git clone git@gitlab.clevercoding.com:client/Summa-Laravel.git`

Install composer:  
`composer install`

__Update Apache configuration files to pull from Laravel files:__  
Edit the following file with the editor of your choice:  
`/etc/httpd/conf/httpd.conf`  
Change the following lines:  
`119 DocumentRoot "/var/www/html/Summa-Laravel/public"`  
`131 <Directory "/var/www/html/Summa-Laravel/public">`  
`151 AllowOverride All`  
Save file

Run the following command to copy the example env file  
`cp .env_example .env`

Run the following command to generate an Application Key for Laravel  
`php artisan key:generate`

You should be able to browse to the site and see it now

Once you have a database setup that you want to use, update the following values in the .env file, to the ones that match your db, so Laravel knows which database to use:  
`DB_CONNECTION=mysql 
DB_HOST=127.0.0.1 
DB_PORT=3306 
DB_DATABASE=homestead 
DB_USERNAME=homestead 
DB_PASSWORD=secret`

If you need to setup the DB, then run the following command, which will run the basic migrations and setup your DB tables:  
`php artisan migrate`

Need to include flipbox/lumen-generator
`https://packagist.org/packages/flipbox/lumen-generator`
`should already be installed in composer.json file`

To install lumen-generator call:
`composer require flipbox/lumen-generator`


Command to make Controller (lumen-generator call):
`php artisan make:controller PluralmodelController`

To Create a migration script
`php artisan make:migration create_users_table`


Lumen Generator Available Commands"


`php artisan key:generate      Set the application key`

`php artisan make:command      Create a new Artisan command`
`php artisan make:controller   Create a new controller class`
`php artisan make:event        Create a new event class`
`php artisan make:job          Create a new job class`
`php artisan make:listener     Create a new event listener class`
`php artisan make:mail         Create a new email class`
`php artisan make:middleware   Create a new middleware class`
`php artisan make:migration    Create a new migration file`
`php artisan make:model        Create a new Eloquent model class`
`php artisan make:policy       Create a new policy class`
`php artisan make:provider     Create a new service provider class`
`php artisan make:seeder       Create a new seeder class`
`php artisan make:test         Create a new test class`

Additional Useful Command
`php artisan clear-compiled    Remove the compiled class file`
`php artisan serve             Serve the application on the PHP development server`
`php artisan tinker            Interact with your application`
`php artisan optimize          Optimize the framework for better performance`
`php artisan route:list        Display all registered routes.`