<?php

use Simple\Routing\Router;

Router::set('',['controller' => 'home', 'action' => 'index']);

Router::set('{controller:serial}/{action}');
