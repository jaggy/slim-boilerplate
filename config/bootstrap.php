<?php

/**
 * Directory Separator Shorthand
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * Application root
 */
define('APP_ROOT', dirname(__DIR__));

/**
 * Set the application webroot
 *
 */
define('WEBROOT', APP_ROOT . DS . 'public');

require_once APP_ROOT . DS . 'vendor' . DS . 'autoload.php';
