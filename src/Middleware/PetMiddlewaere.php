<?php

namespace Projeto\ApiPets\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;

class PetMiddleware {

    public function __invoke(Request $request, RequestHandler $handler): Response {
        $metodo = $request->getMethod();

        if ($metodo === 'POST' || $metodo === 'PUT') {
            $dados = $request->getParsedBody();

            if (!isset($dados['nome']) || empty(trim($dados['nome']))) {
                return $this->retornarErro("O campo 'nome' é obrigatório.");
            }

            if (!isset($dados['id_tipo']) || !is_numeric($dados['id_tipo'])) {
                return $this->retornarErro("O campo 'id_tipo' é obrigatório e deve ser um número.");
            }
        }

        return $handler->handle($request);
    }

    private function retornarErro(string $mensagem): Response {
        $response = new SlimResponse();
        $payload = json_encode(["erro" => $mensagem]);
        
        $response->getBody()->write($payload);
        
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    }
}