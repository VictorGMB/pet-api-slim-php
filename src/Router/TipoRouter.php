<?php

namespace Projeto\ApiPets\Router;

use Slim\App;
use Projeto\ApiPets\Controller\TipoController;
use Projeto\ApiPets\Middleware\TipoMiddleware;

class TipoRouter {

    public static function registrar(App $app, TipoController $controller) {
        $app->group('/tipos', function ($group) use ($controller) {

            $group->get('', [$controller, 'listar']);
            $group->get('/{id}', [$controller, 'buscarPorId']);
            
            $group->post('', [$controller, 'criar'])->add(new TipoMiddleware());
            $group->put('/{id}', [$controller, 'atualizar'])->add(new TipoMiddleware());
            
            $group->delete('/{id}', [$controller, 'excluir']);
        });
    }
}