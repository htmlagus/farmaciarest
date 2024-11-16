<?php
    
    require_once 'libs/router.php';

    require_once 'app/controllers/farmacia.api.controller.php';
    
    $router = new Router();

    #                  endpoint        verbo      controller                  metodo
    $router->addRoute('compras',       'GET',    'FarmaciaApiController',    'getAll');
    $router->addRoute('compras/:id',   'GET',    'FarmaciaApiController',    'get');
    $router->addRoute('compras',       'POST',   'FarmaciaApiController',    'create');
    $router->addRoute('compras/:id',   'PUT',    'FarmaciaApiController',    'update');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);