<?php

namespace Projeto\ApiPets\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Projeto\ApiPets\Service\PetService;
use Projeto\ApiPets\Model\Pet;
use Exception;

class PetController {
    private PetService $petService;

    public function __construct(PetService $petService) {
        $this->petService = $petService;
    }

    public function listar(Request $request, Response $response): Response {
        try {
            $pets = $this->petService->findAll();
            $response->getBody()->write(json_encode($pets));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            return $this->gerarErro($response, "Erro ao listar pets", 500);
        }
    }

    public function buscarPorId(Request $request, Response $response, array $args): Response {
        try {
            $id = (int)$args['id'];
            $pet = $this->petService->findById($id);
            $response->getBody()->write(json_encode($pet));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            return $this->gerarErro($response, $e->getMessage(), 404);
        }
    }

    public function criar(Request $request, Response $response): Response {
        try {
            $body = $request->getParsedBody();

            $pet = new Pet(
                0, 
                $body['nome'] ?? '', 
                (int)($body['id_tipo'] ?? 0)
            );
            
            $this->petService->create($pet);
            
            $response->getBody()->write(json_encode(["mensagem" => "Pet cadastrado com sucesso!"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } catch (Exception $e) {
            return $this->gerarErro($response, $e->getMessage(), 400);
        }
    }

    public function atualizar(Request $request, Response $response, array $args): Response {
        try {
            $id = (int)$args['id'];
            $body = $request->getParsedBody();
            
            $pet = new Pet($id, $body['nome'] ?? '', (int)($body['id_tipo'] ?? 0));
            $this->petService->update($pet);
            
            $response->getBody()->write(json_encode(["mensagem" => "Dados do pet atualizados!"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            return $this->gerarErro($response, $e->getMessage(), 400);
        }
    }

    public function excluir(Request $request, Response $response, array $args): Response {
        try {
            $id = (int)$args['id'];
            $this->petService->delete($id);
            
            $response->getBody()->write(json_encode(["mensagem" => "Pet removido do sistema!"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (Exception $e) {
            return $this->gerarErro($response, $e->getMessage(), 400);
        }
    }

    private function gerarErro(Response $response, string $msg, int $status): Response {
        $payload = json_encode(["erro" => $msg]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }
}