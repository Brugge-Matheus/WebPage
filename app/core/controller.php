<?php 

function controller($matchedUri, $params) {
    list($contoller, $method) = explode('@' , array_values($matchedUri)[0]);
    $contollerWithNamespace = CONTROLLER_PATH.$contoller;

    if(!class_exists($contollerWithNamespace)) {
        throw new Exception("Controller {$contoller} não existe");
        
    }

    $contollerInstance = new $contollerWithNamespace;

    if(!method_exists($contollerInstance, $method)) {
        throw new Exception("Metódo {$method} não existe na classe {$contoller}"); 
    }
    
    return $contollerInstance->$method($params);
}