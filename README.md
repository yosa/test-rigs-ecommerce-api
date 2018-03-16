## USE


## SETUP
- Create file .env
    + cp .env.example .env
- Application key
    + php artisan key:generate
- Directory Permissions
    + chmod 777 bootstrap/
    + chmod 777 -R storage/
- Test in web browser
    + Navigate to website for example: http://rigs.melisa.mx
- Set database configuration
    + update .env file and set database config, for example:
        + DB_DATABASE=rigsEcommerce
        + DB_USERNAME=developer
        + DB_PASSWORD=123456789
- Create database
    + Assign privileges to the user to access the database
- Install dependencies
    + composer update
- Run migrations
    + php artisan migrate
    + If you see, Migration table created successfully. Be happy !!