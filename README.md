xentry
------

Social network site where you can see a list of users and follow them.

Laravel app setup
=================

* configure .env (read below)
* setup nginx (or other web server) and run it ;-)
* `php artisan app:setup`

Database: sqlite.

Rails app setup
===============

* configure .env (read below)
* `rake app:setup`
* `rails server`

Database: sqlite.


.env
====


    DB_CONNECTION=sqlite

    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailgun.org
    MAIL_PORT=587
    MAIL_USERNAME=username
    MAIL_PASSWORD=password
    MAIL_ENCRYPTION=tls

    IMAGE_BASE_PATH=https://s3.amazonaws.com/uifaces/faces/twitter/
