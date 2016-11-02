click installation
=====

A Symfony project created on November 1, 2016, 9:27 am.

1) The first step to download Composer:

```bash
$ curl -s http://getcomposer.org/installer | php
```

2) Install bundles:

```bash
$ php composer.phar install
```

3) Create database and update schema:

```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
```