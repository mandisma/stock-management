# Launch the project

Complete the `.env` file and run the following commands :

```shell
# Install dependencies
composer install

npm install

# Compile assets
npm run dev

# Migrate and seed the database
php artisan migrate --seed

# Launch the server
php artisan serve

# Optionnaly launch the queue worker
php artisan queue:work
```

A default admin user is created with the credentials below :

Email: `admin@test.com`

Password : `admin`
