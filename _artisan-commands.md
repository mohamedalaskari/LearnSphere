# Run App
php artisan serve
php artisan ser
php artisan serve --port=2444
php artisan ser --port=8520

# Create Controller
php artisan make:controller CustomerController
php artisan make:controller SupplierController -r

# List all Routes
php artisan route:list


# Database Migrations

**Docs**
https://laravel.com/docs/11.x/migrations

**Run Pending migrations**
php artisan migrate

**Create a table**
php artisan make:migration create_posts_table

**undo last migration**
php artisan migrate:rollback

**undo specific steps**
php artisan migrate:rollback --step=3

**Check migrations status**
php artisan migrate:status

**undo all migrations**
php artisan migrate:refresh 

**restart all migrations**
php artisan migrate:fresh


 # create model
 php artisan make:model PostModel

 # create seeder
 php artisan make:seed PostSeeder

 # create model with seeder
 php artisan make:model PostModel -s

 # create model with migration
 php artisan make:model PostModel -m

 # create model with factory
 php artisan make:model PostModel -f

 # create model with all 7 files
 php artisan make:model PostModel -a



 # run database seeder (database/seeders/DatabaseSeeder.php)
 php artisan db:seed
 
 # run database seeder for specific class(seeder)
 php artisan db:seed --class=ReactionTypeSeeder


 # Tinker
 php artisan tinker

 # Help
 php artisan help make:model
 php artisan help make:controller
 php artisan help make:factory

# Guide
php artisan make:model

# Install API
php artisan install:api
php artisan migrate


# Make Request
php artisan make:request StoreUserRequest


# Make Middleware
php artisan make:middleware MiddleWareName


# create a trait
php artisan make:trait Path/TraitNameTrait
# create connetct with stripe to payment in vendor
composer require stripe/stripe-php
