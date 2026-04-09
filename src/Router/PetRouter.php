<?php

namespace Projeto\ApiPets\Router;

use Slim\App;
use Projeto\ApiPets\Controller\PetController;
use Projeto\ApiPets\Middleware\PetMiddleware;

class PetRouter {

    public static function registrar(App $app, PetController $controller) {
        $app->group('/pets', function ($group) use ($controller) {

            $group->get('', [$controller, 'listar']);
            $group->get('/{id}', [$controller, 'buscarPorId']);
            
            $group->post('', [$controller, 'criar'])->add(new PetMiddleware());
            $group->put('/{id}', [$controller, 'atualizar'])->add(new PetMiddleware());
            
            $group->delete('/{id}', [$controller, 'excluir']);
        });
    }
}