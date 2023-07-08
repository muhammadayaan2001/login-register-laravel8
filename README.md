Laravel 8 login and register::

This example demonstrates a custom authentication system for login and registration in Laravel 8. It includes role-based access control, where users are authenticated based on their assigned roles. Middleware and session management are used to secure the pages and protect the user's session. The implementation showcases separate routes for login and registration, along with user and admin dashboards. The routes are protected using middleware to ensure that only authenticated users with the appropriate roles can access the respective dashboards

# Steps

- Copy .env .example and paste it in directory and rename it .env
- Connect your database in .env

<!-- Commands you have to run in this project -->
# For migrate tables::
- php artisan migrate

# For run the project::
- php artisan serve
