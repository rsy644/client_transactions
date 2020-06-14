# Welcome to the Employee Companies CRM. Here are some steps to get started:

# Prerequisites

* Make sure that the 'php' extension is to the path is available inside of your command prompt, and check that 'php artisan' commands are working correctly.

* Clone or download the project into the root directory of your local web server.

* Navigate (or 'cd') into the root directory of the laravel project and make sure composer is installed on the local system by running the command 'composer install'. If any alerts appear saying that files are not up to date, run the command 'composer update'.

* Create a new blank database in the local phpmyadmin and call it something relevant (eg. company_employees).

* Rename the .env.example file to '.env'.

* Inside of the .env file alter the 'APP_URL' to 'http://127.0.0.1:8000', and change the 'DB_DATABASE' to the name of your newly created database. Alter the 'DB_USERNAME' and 'DB_PASSWORD' credentials so as to establish a connection. 

* Navigate to the root folder of the project inside the command prompt or terminal and run 'php artisan migrate --seed' to build and populate the databases.

* From the root directory, run 'php artisan serve'.

* Navigate to http://127.0.0.1:8000 in your url field, and log in with 'admin@admin.com' and password: 'password'. The app will then launch.

* If the screen prompts that 'No Application Key has been specified', use the following key: 'ABCDEF123ERD456EABCDEF123ERD456E' and place this straight after the 'APP_KEY=' constant in the env file. Then run 'php artisan config cache'.