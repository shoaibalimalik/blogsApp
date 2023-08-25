# Blogs App

Welcome to the **Blogs App**, a simple Laravel and Blade application developed using the latest Laravel version. This guide will walk you through the steps to get the app up and running.

## Installation

1. Clone the repository:
   
   git clone https://github.com/shoaibalimalik/blogsApp.git

2. Copy the contents of `.env.example` to `.env`.

3. Generate a new application key:

   php artisan key:generate

4. Run database migrations and seed data:
   
   php artisan migrate --seed  
   
   This will create necessary database tables and a user account with the following credentials:
   - Email: admin@example.com
   - Password: password

   You can also seed the database with 20 sample posts using:
   php artisan db:seed --class=PostsSeeder

5. Install project dependencies:
    
   composer install

6. Start the development server:

   php artisan serve

   This will serve your application on a local development server, usually at `http://127.0.0.1:8000`.

   ## Usage

   Once the application is up and running, you can access it by visiting the URL provided by the development server. You can log in using the provided admin credentials.
