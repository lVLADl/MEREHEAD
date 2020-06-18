## Installation
- [add .env] copy .env.example, paste it and call ".env"
- [connect to the database using pair of login/password]  update your .env in the database-section
- [apply migrations] docker-compose exec php php /var/www/html/artisan migrate
- [update composer-dependencies] composer install
- [generate new auth-secret key] php artisan jwt:secret
