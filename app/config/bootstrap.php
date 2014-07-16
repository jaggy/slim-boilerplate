<?php

/**
 * Application root
 */
define('APP_ROOT', dirname(dirname(__DIR__)));

/**
 * Set the application webroot
 *
 */
define('WEBROOT', APP_ROOT . DS . 'public');

require_once APP_ROOT . DS . 'vendor' . DS . 'autoload.php';
require_once 'core.php';

/**
 * Configure the model namespace
 *
 * @var string
 */
Model::$auto_prefix_models = '\\Model\\';