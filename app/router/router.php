<?php

require 'routes.php';


function exactMathUriInArrayRoutes($uri, $routes) {

    if(array_key_exists($uri , $routes)) {
        return var_dump(['achou']);
    }

    return var_dump(['não achou']);
}


function router() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $routes = routes();

    $matchedUri = exactMathUriInArrayRoutes($uri, $routes);

    
    
}
