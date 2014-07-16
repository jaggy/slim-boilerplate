<?php

$container  = new Pimple\Container;
$dependency = new core\Dependency($container);

/*
|--------------------------------------------------------------------------
| Dependencies
|--------------------------------------------------------------------------
*/
// $container['user'] = $dependency->inject('user');


return $container;
