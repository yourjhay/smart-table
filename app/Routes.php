<?php

use Simple\Routing\Router;

Router::set('',['controller' => 'home', 'action' => 'index']);

Router::set('{controller:serial}/{action}');

Router::set('{controller:weather}/{action}');

Router::set('{controller:myschedules}/{action}');
/** ---------------------------------------------
* Router::auth() is the routes for authentication
*/
Router::auth();