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
    + Navigate to website for example: http://rigs.melisa.mx
- Run migrations
    + php artisan migrate
- Run seeders
    + php artisan db:seed
        + Create administrator and registered user and fill table catalog of events
- Run fake product generator
    + php artisan fake-products
        +  It generates products with random data and it will be possible to see them from the web site or from the api /api/v1/products

## USE

### View documentation API Postman
    + [View API Postman](https://documenter.getpostman.com/view/2057735/rigs-e-commerce/RVnZfx7A)
    + [Import API Postman](https://www.getpostman.com/collections/ba0229f14b776907301d)

### Use API Postman
- It is necessary to define the following variables in an environment

```
server:http://rigs.dev.melisa.mx/
apiVersion:v1/
apiSegment:api/
email:lheredia@melisa.mx
password:L12s$2018
token:your_token
```

### Run endpoints from postman
- Run the endpoint located in the security / login / success folder
    +  If the credentials are incorrect, the following json returns:

```
{
    "errors": [],
    "info": [],
    "debug": [],
    "success": true,
    "benchmark": "2.85MB",
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImMyNDNiNmYxMTQzY2I2YTA1ZTczZmE3MTA0NTUyMjE0NjY0NWUyZjIyNjQ5MGE2NzI5N2Q5MTVjZGQ1MzdjMTRiMjE5YjQzYjNiYzExMTNkIn0.eyJhdWQiOiIyIiwianRpIjoiYzI0M2I2ZjExNDNjYjZhMDVlNzNmYTcxMDQ1NTIyMTQ2NjQ1ZTJmMjI2NDkwYTY3Mjk3ZDkxNWNkZDUzN2MxNGIyMTliNDNiM2JjMTExM2QiLCJpYXQiOjE1MjEyNDY1NjQsIm5iZiI6MTUyMTI0NjU2NCwiZXhwIjoxNTIyNTQyNTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.owfSiXwojLBl3-NqB94nQ1bWd6UDq80-49ySfzhkLuQhiQOQmNzcitw0ABDEG1dfFK1bFfg5RBpXG-EIZMKZBnk7gWuJhK-dJKHLRXur6bnaypqGZqK0CVzTa5u_11TkIF0DAbEPJI_eQYiOusEvxp0q84QHzEnOWffV6SgY2CArAqbkEbvdzlKgj_AM6inYXvmvIv2omcmN4983TcCoHsEnDknQkK-uJM8dcmHG_oGrikQrHokv81HxYgA94p7jsuQCrDrnG6TMr8X1DOeJKxIIsjMCTXsbsFxXa5HM7e_uBCLMlHh2cNAzfBNIC65PxDgheJUfcByPD8Gbimm6x5Wx7ezQscZM6SPN0TyE7bvnSMm2loJTsdknFe3KqlqSQq1TntBV2DkrZEwovvsOFEaz1eVWnoR1bQQyFPi5KaUDFvnkBM9y0KxtDdblzjpr0zVXUOQ2haN3P2h80TVCp2EiA1lvOmKKj6RDeJDqP5LtlpD7T96ZkKWOPxVyIaM33tHABm_iKWGn0BSUj995jEo3xdyvC99okdSRliNlS1piAN7Pzu7gcezYPbdYl3KS2Vf-ng7PFvNXcMoxY5gJVEahFXQs1Izc_ye_zdCPRmsAAc64TgLbI4faGfcJgKRi0waqTJEswDpNfknYI6c3gv0dnEhySWbSNwSnw3_-lUY",
        "expires_in": 1296000,
        "refresh_token": "def502006c89f6b9f27fd88802557645f5e5e02e59c2265fdc706afc85a01d51acce356973c5b64eb3c3cf99c9eae780437d60b6f9d15e70a97cbf2971ed617b2071fa6c7f334d124dce3644fc14d80f7da15e6509f8b63de62be258009783f1f3c8a3ea7edbe4b141d74911dd52e2e14124e7bf1e9d67617e6484bcbbecde488f672c4a57dea65c5cc869db7a4d8742ae2c79bdd014d68ca4b12699c5bf766a758d092d4be65ba2c6137696f3e8b467415b7fe6398f5218934fe100339c9bc7058b2dabf0410f8bc84c603b4763488f32466faf11e3b23e7660138433e5ee4192eb2e604cc0071cb0ad36d1aa6ee984b06c29054f78ddabb6ae5941da6af9923efe8d269860a0b523ee945f4490b50de15703fd2a872d89ed50aa371a506ca624431aa9ea89ad45e3d360a4565b14a26bcc8fd4b334a2a635ba5479bcdc1a3ec1ab654e3da04fe68717b232d66d47b12a5e5269a73a86e0786025230df7715541",
        "user": {
            "id": 1,
            "name": "Seamus Grady",
            "email": "lheredia@melisa.mx",
            "isAdmin": 1,
            "created_at": "2018-03-16 17:51:50",
            "updated_at": "2018-03-16 18:11:27"
        }
    }
}
```

- In order to execute the other privileged endpoints it is necessary to copy the ** access_token ** in the token environment variable.

### Running unit tests
- Execute all unit tests
    + phpunit
- Run unit tests by groups
    + phpunit --group=dev
    + phpunit --group=completed
    + phpunit --group=products
    + phpunit --group=security
    + phpunit --group=create