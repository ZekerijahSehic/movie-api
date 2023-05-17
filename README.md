## Movie API

This is a Laravel-based movie API that allows users to interact with movies, create posts, and manage their favorite movies. 
Only users with the admin role have the privilege to add new movies.

### Features

- **User Management:**
    - Register new users
    - User authentication and authorization
    - Role-based access control (admin and user roles)
- **Movie Management:**
    - View movie details
    - Add movies to favorites
    - Search for movies
    - Retrieve a list of favorite movies for a user
- **Post Management:**
    - Create posts about movies
    - View posts about movies

### Models

The movie API includes the following models:

- **User Model:**
    - Represents a user of the application
    - Attributes: id, username, email, password, role_id
- **Movie Model:**
    - Represents a movie
    - Attributes: id, title, slug, release_year, duration_minutes, plot_summary, user_id, created_at, updated_at
- **Post Model:**
    - Represents a post about a movie
    - Attributes: id, title, slug, review, rate, movie_id, user_id, created_at, updated_at

### Usage

1. Clone the repository to your local environment.
2. Install the required dependencies using composer: composer install.
3. Set up your database connection in the .env file.
4. Run database migrations and seeders: php artisan migrate --seed.
5. Start the development server: php artisan serve.

### Postman Collection

A Postman collection is available in the repository that includes pre-configured API endpoints for easy testing and integration.

