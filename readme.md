# Welcome to the Client Transactions CRM. Here are some steps to get started:

# Prerequisites

* Make sure that the 'php' extension is to the path is available inside of your command prompt, and check that 'php artisan' commands are working correctly.

* Clone or download the project into the root directory of your local web server.

* Navigate (or 'cd') into the root directory of the laravel project and make sure composer is installed on the local system by running the command 'composer install'. If any alerts appear saying that files are not up to date, run the command 'composer update'.

* Create a new blank database in the local phpmyadmin and call it something relevant (eg. client_transactions).

* Rename the .env.example file to '.env'.

* Inside of the .env file alter the 'APP_URL' to 'http://127.0.0.1:8000', and change the 'DB_DATABASE' to the name of your newly created database. Alter the 'DB_USERNAME' and 'DB_PASSWORD' credentials so as to establish a connection. 

* Navigate to the root folder of the project inside the command prompt or terminal and run 'php artisan migrate --seed' to build and populate the databases.

* From the root directory, run 'php artisan serve'.

* Inside of the .env file, after the 'APP_KEY=' constant use the following application key: 'ABCDEF123ERD456EABCDEF123ERD456E'. Then run 'php artisan config cache'.

* Navigate to http://127.0.0.1:8000 in your url field, and log in with 'admin@admin.com' and password: 'password'. The app will then launch, and display the 8 clients that were initially populated with the seeder.

* Click 'add' to add a new client to the list.

* Click on the blue client name to see the details of any of the existing clients, and a list of their associated transactions.

* Click on the grey cross ('x') next to each of the client names to delete a client.

* Transactions can be added, deleted or edited in a similar fashion, within each of the client panels.

* A full list of all the transactions in the system is available from the 'Transactions' menu item in the left hand sidebar. These transactions can be deleted in turn.

# Testing

* There are some browser tests located in the folder ('/tests/Browser'), written with Laravel Dusk. To run the tests, use the command 'php artisan dusk' when inside of the laravel root directory. 

* You may need to ensure that the chromedrivers are up to date first. To double check this, run 'php artisan dusk:chrome-driver --all'.

* If you are experiencing connection issues you might want to run the chrome driver first of all in a separate window by using the command './vendor/laravel/dusk/bin/chromedriver-win.exe" --verbose', and then in a different console run the command 'php artisan dusk'. 