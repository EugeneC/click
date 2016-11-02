<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

if (isset($_ENV['BOOTSTRAP_CLEAR_CACHE_ENV'])) {
    passthru(sprintf(
        'php "%s/console" doctrine:cache:clear-metadata --env=%s',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));

    passthru(sprintf(
        'php "%s/console" cache:clear --env=%s --no-warmup',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));

    passthru(sprintf(
        'php "%s/console" doctrine:database:drop --env=%s --force',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));

    passthru(sprintf(
        'php "%s/console" doctrine:database:create --env=%s',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));

    passthru(sprintf(
        'php "%s/console" doctrine:schema:update --env=%s --force',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));
}

require __DIR__ . '/../var/bootstrap.php.cache';