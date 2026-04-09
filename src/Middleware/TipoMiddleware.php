<?php

namespace Projeto\ApiPets\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;

class TipoMiddleware {

    public function __invoke(Request $request, RequestHandler $handler): Response {
        $metodo = $request->getMethod();

        if ($metodo === 'POST' || $metodo === 'PUT') {
            $dados = $request->getParsedBody();

            if (!isset($dados['nome']) || empty(trim($dados['nome']))) {
                $response = new SlimResponse();
                $erro = ["erro" => "O campo 'nome' é obrigatório para esta operação."];
                
                $response->getBody()->write(json_encode($erro));

                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
        }

        return $handler->handle($request);
    }
}