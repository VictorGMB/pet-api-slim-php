<?php

namespace Projeto\ApiPets\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Projeto\ApiPets\Service\TipoService;
use Projeto\ApiPets\Model\Tipo;
use Exception;

class TipoController {
    private TipoService $tipoService;

    public function __construct(TipoService $tipoService) {
        $this->tipoService = $tipoService;
    }

    public function listar(Request $request, Response $response): Response {
        try {
            $dados = $this->tipoService->findAll();
            $response->getBody()->write(json_encode($dados));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            return $this->gerarErro($response, $e->getMessage(), 500);
        }
    }

    public function buscarPorId(Request $request, Response $response, array $args): Response {
        try {
            $id = (int)$args['id'];
            $tipo = $this->tipoService->findById($id);
            $response->getBody()->write(json_encode($tipo));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            return $this->gerarErro($response, $e->getMessage(), 404);
        }
    }

    public function criar(Request $request, Response $response): Response {
        try {
            $body = $request->getParsedBody();
            $tipo = new Tipo(0, $body['nome'] ?? '');
            
            $this->tipoService->create($tipo);
            
            $payload = json_encode(["mensagem" => "Tipo criado com sucesso!"]);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } catch (Exception $e) {
            return $this->gerarErro($response, $e->getMessage(), 400);
        }
    }

    public function atualizar(Request $request, Response $response, array $args): Response {
        try {
            $id = (int)$args['id'];
            $body = $request->getParsedBody();
            $tipo = new Tipo($id, $body['nome'] ?? '');
            
            $this->tipoService->update($tipo);
            
            $response->getBody()->write(json_encode(["mensagem" => "Tipo atualizado!"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            return $this->gerarErro($response, $e->getMessage(), 400);
        }
    }

    public function excluir(Request $request, Response $response, array $args): Response {
        try {
            $id = (int)$args['id'];
            $this->tipoService->delete($id);
            
            $response->getBody()->write(json_encode(["mensagem" => "Tipo removido!"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            return $this->gerarErro($response, $e->getMessage(), 400);
        }
    }

    private function gerarErro(Response $response, string $msg, int $status): Response {
        $erro = ["erro" => $msg];
        $response->getBody()->write(json_encode($erro));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }
}