# Organizational Chart API

## Requirements
- Laravel 10
- MySQL 8

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/aldrin-prog/org_chart-app.git
2. Navigate to the project directory
    ```bash
    cd org-chart-api
3. Install dependencies
    ```bash
    composer install
4. Configure .env file with your database settings
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=org_chart
    DB_USERNAME=root
    DB_PASSWORD=yourpassword

5. Run migrations
    ```bash
    php artisan migrate
6. Start the server
    ```bash
    php artisan serve

## How to Test the API in Postman
## Base Url
    ```bash
    http://127.0.0.1:8000/api/

##