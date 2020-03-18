# Snowtricks_Project6

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/8b9a914a39314f5eb479e3b47a176a56)](https://www.codacy.com/app/sergisergio/Snowtricks_Project6?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=sergisergio/Snowtricks_Project6&amp;utm_campaign=Badge_Grade)

## Setup

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:
                   
```
composer install
```

**Configure the the .env File**

First, you should have an `.env` file.
If you don't, copy `.env.dist` to create it.

Next, look at the configuration and make any adjustments you
need - specifically `DATABASE_URL`.

**Setup the Database**

Again, make sure `.env` is setup for your computer. Then, create
the database & tables!

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

If you get an error that the database exists, that should
be ok. But if you have problems, completely drop the
database (`doctrine:database:drop --force`) and try again.

**Start server**

```
php bin/console server:run
```

Now check out the site at `http://localhost:8000`

![api2](https://raw.githubusercontent.com/sergisergio/SYMFONY_Projet6_Snowtricks/master/snowtricks.png)


**Any Questions ?**

Feel free to contact me !
