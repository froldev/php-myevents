# Simple MVC

## Description

PROJECT  2 - L'Olympic Nantais !

DESCRIPTION :

This repository represents the project 2 for a period of 6 weeks, based on a PHP MVC structure.
It is the creation of the website of a new concert hall in Nantes.
It uses vendor/librairies such as Twig, Bootstrap and Grumphp.

We use the Scrum method to realise this project.

## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```
4. Import 'db.sql' in your SQL server,
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.


### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

`git config --global core.autocrlf true`

## URLs availables

* Home page [localhost:8000/](localhost:8000/)
* Events list (front) at [localhost:8000/](localhost:8000/)
* Event details (front) at [localhost:8000/detail/event/:id](localhost:8000/detail/event/{id})
* Event edit (back) [localhost:8000/events/edit/:id](localhost:8000/events/edit/{id})
* Event add (back) [localhost:8000/events/add/:id](localhost:8000/events/add/{id})
* Event deletion (back)[localhost:8000/events/delete/:id](localhost:8000/events/delete/{id})
... 
## How does URL routing work ?

![Simple MVC.png](https://raw.githubusercontent.com/WildCodeSchool/simple-mvc/master/Simple%20-%20MVC.png)

Project team :

- Elodie George : https://github.com/ellouly
- Benjamin Désigné : https://github.com/bnj-dez
- Fred Olive : https://github.com/froldev
- Aurélien Chaillot : https://github.com/achaillot