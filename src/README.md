## Installation
- [add .env] copy .env.example, paste it and call ".env"
- [connect to the database using pair of login/password]  update your .env in the database-section
- [apply migrations] docker-compose exec php php /var/www/html/artisan migrate
- [update composer-dependencies] composer install
- [generate new auth-secret key] php artisan jwt:secret

Postman-documentation: https://documenter.getpostman.com/view/11768541/SzzkdxX1?version=latest#ef4cbb5a-0899-4ca7-be4b-5df7df1446c0
