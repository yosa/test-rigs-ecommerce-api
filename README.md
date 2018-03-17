## SETUP
- Create or move file .env.example
    + Copy
        + cp .env.example .env
    + or move execute (recommended)
        + mv .env.example .env
- Directory Permissions
    + chmod 777 bootstrap/
    + chmod 777 -R storage/
- Install dependencies
    + composer update
- Set database configuration
    + update .env file and set database config, for example:
        + DB_DATABASE=rigsEcommerce
        + DB_USERNAME=developer
        + DB_PASSWORD=123456789
- Create database
    + Assign privileges to the user to access the database
- Create the encryption keys needed to generate secure access tokens
    + php artisan passport:install
- Test in web browser
    + Navigate to website for example: https://rigs.melisa.mx
- Run migrations
    + php artisan migrate
- Run seeders
    + php artisan db:seed
        + Create administrator and registered user and fill table catalog of events
- Run fake product generator (optional)
    + php artisan fake-products
        +  It generates products with random data and it will be possible to see them from the web site or from the api /api/v1/products

## USE

### View documentation API Postman
- [View API Postman](https://documenter.getpostman.com/view/2057735/rigs-e-commerce/RVnZfx7A)
- [Import API Postman](https://www.getpostman.com/collections/ba0229f14b776907301d)

### Use API Postman
- It is necessary to define the following variables in an environment

```
server:https://rigs.melisa.mx/
apiVersion:v1/
apiSegment:api/
email:lheredia@melisa.mx
password:L12s$2018
token:your_token
```

### Run endpoints from postman
- Run the endpoint located in the security/login/success folder
    +  If the credentials are incorrect, the following json returns:

```
{
    "errors": [],
    "info": [],
    "debug": [],
    "success": true,
    "benchmark": "3.19MB",
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImIyZjEyMTUwZDUwY2RhYmE5Nzg2ZTE3ODJmYjMzNDc2Zjc5NThhOWE3MzEzOGUzN2UwN2U3MzUyZmU1NTcwMTJiNzAzYzJmZmQ3NjQzMTc2In0.eyJhdWQiOiIyIiwianRpIjoiYjJmMTIxNTBkNTBjZGFiYTk3ODZlMTc4MmZiMzM0NzZmNzk1OGE5YTczMTM4ZTM3ZTA3ZTczNTJmZTU1NzAxMmI3MDNjMmZmZDc2NDMxNzYiLCJpYXQiOjE1MjEyNDc2ODMsIm5iZiI6MTUyMTI0NzY4MywiZXhwIjoxNTIyNTQzNjgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.zGSAYDk24JKHqySLYIrJPvOWoEgXZLwYjhnYIC6kGE8kzWwFWJxTjVrfFrVd9vw7fBs07hwELNlAOnvQt6rm9-UvC4aGHfZHK7O1wxSwlHpXkZ5L1uHNDbQ-J5ixP_dY1-OdIurpuOVWi8drdgILnkd-OVWXXJzlQfrmB5YqQFnQjVeLMDJfyMfmtwzS1A0XHu_OboxAT_HnJCn_icjR6cCp18Tku_hJWouI_BJe_x3eZ3AwUZtnHAIKUrraVvbXAT0RCEUo3bdaO7y0x0K_ncyDraeqTwdERXu8zoYf8xt63u_whkCxlDMk4Ep7iUS36EBMw9Nb__Z3foSLqMpobkdGktV04xAcDI20tCXcOuENX8BqfIj-fDVkXULnIlXfkn8tgztqAjDh6__RqltoW5HmfN0RsKJihuZ1WEij9X9PUVSM2KdOKQQzrxfjGiEc_ipbewXnvuDRPZ04olzSQfzLicx8L3W91hoxTaXVSMY0W2Ot_cE-Cr9E1z4OIt_UlME5K_B_XzlD0mjiZfY2ksJTdX7T0FmMrTbe-zpBaSYdI6oHu3kpcvVN-QhoX7ME0uNuzsyN-s1NFfOEGiNmpBRnbP9R-Q_KReasdbV_PrL-PvyRB0hFvOWyzjDU_pMfP7aWohhLHzSYY5WPYTjg1ixDzlUL32hpxFPxDszZLfw",
        "expires_in": 1295999,
        "refresh_token": "def5020089cb4c49e366e828a39361199a9c7ff8ce9b2b837a0a691a9c06bbb539c152055ab7ddf164b4c53e8c5e0b41124e7b4ea8faaeb086136039ef9804aec7b59bf30e975b7d416b063cee5858725a343e8144842ffb1f17646d8acaaa8679a084b4b0a9909ab134bf4be45f9363e5a0fc2b4ed1b8f8b36fdb45d91b2830d371851be8111fc40d3c391ce6a69c1d145090b3eab8f250fb852793b1bb85847036af943f5ff107752a50dd40941f89082e8aab0aeb44dda2987b4f28089d8a38ef5d3942d972cefbd011c7f6631a933020cda472eb61c2109207e09bf7ff744b82ff4a6ad78427cce46bebc5fdfdd90063c924ea1562fa62921f201922a5f7c5710ec50f0c899099febc20471331d56957ce39ec8583e6d5abd7454a6c26ebf2b2abdbc0bfbe5daf549424024b221caf92a8263d713ca983fa6dc259a05eaaebecb42b5da27d14db272aaaeac5c018c39b24623bbeb65d99faf8e18c633c01e0",
        "user": {
            "id": 1,
            "name": "D'angelo Hilll Jr.",
            "email": "lheredia@melisa.mx",
            "created_at": "2018-03-16 17:38:02",
            "updated_at": "2018-03-16 17:38:02"
        }
    }
}
```

- In order to execute the other privileged endpoints it is necessary to copy the **access_token** in the token environment variable.

### Running unit tests
- Execute all unit tests
    + phpunit
- Run unit tests by groups
    + phpunit --group=dev
    + phpunit --group=completed
    + phpunit --group=products
    + phpunit --group=security
    + phpunit --group=create