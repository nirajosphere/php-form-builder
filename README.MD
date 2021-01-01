# PHP Form Builder
![version](https://img.shields.io/badge/version-1.0.0-green.svg)
PHP Form Builder is a drag and drop Form Builder like Google Form built with PHP and MySQL. Why should choose this Form Builder over any other form builder app.
  - Easy to use, same as Google Forms
  - Self-Hosted
  - Open-Source and Easily Customizable


## Tech

PHP Form Builder uses the below mentioned techstack
* [PHP](https://www.php.net/) - Open Source Hypertext Preprocessor 
* [MySQL](https://www.mysql.com/) - Database
* [Simple PHP Router](https://github.com/steampixel/simplePHPRouter) - PHP Routing Library
* [Twitter Bootstrap](https://getbootstrap.com/) - great UI boilerplate for modern web apps
* [jQuery](https://jquery.com/) - A JS Library

And of course PHP Form Builder itself is open source on GitHub.

## Installation

PHP Form Builder requires [Apache](https://www.apache.org/g/) to run. You can use applications like [XAMPP](https://www.apachefriends.org/index.html) or [WAMPP](https://www.wampserver.com/en/) to setup apache environment along with MySQL on a Windows Development Environment. Follow the steps below to get started.

- Clone this repository to the serving folder (htdocs for XAMPP)
- Create a new database with name formbuilder
- import the SQL file into that database
- Now Change the below variables in the config file
    ```sh
    $application_url   //URL of the application ex. http://localhost/formBuilder
    $application_subdirectory   //Directory of the application (folder name) ex. /formBuilder. Use '/' for root
    $db_host       // database hostname ex.localhost
    $db_user       // database username ex.root
    $db_password   // database password ex.admin
    $db_table      // database table ex.formbuilder (need to change only if renamed)
    ```
- Open the application URL in browser
- Login with below credentials
  ```sh
  niraj.gohel : adm
  ```
- Good to go !

### Todos

- Add Registration Flow
- Integrate Social Logins
 - Add More Components (Form Controls)
 - Add Form Sharing 
 - Implement Form Preview Thumbnails 

License
----

MIT


**Free Software, Hell Yeah!**
