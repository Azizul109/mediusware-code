# Install project

1. Download the project from github.com
2. Setup localhost server (xampp or wamp)
3. Run "composer install" after setting up the server
4. Run "php artisan migrate:refresh --seed" to migrate
5. Run "php artisan serve" to run the project on local server
6. Go to browser
7. Type http://127.0.0.1:8000/register to register as user
8. http://127.0.0.1:8000/login will redirect user to login page
9. http://127.0.0.1:8000/show-deposit will show deposit
10. http://127.0.0.1:8000/show-withdrawal will show withdraw
11. http://127.0.0.1:8000/deposit will deposit amount
12. http://127.0.0.1:8000/withdraw will make withdraw
13. Design was kept to minimal
14. That's all enjoy
