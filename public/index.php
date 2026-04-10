<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Projeto\ApiPets\DAO\Database;
use Projeto\ApiPets\DAO\TipoDAO;
use Projeto\ApiPets\DAO\PetDAO;
use Projeto\ApiPets\Service\TipoService;
use Projeto\ApiPets\Service\PetService;
use Projeto\ApiPets\Model\Tipo;
use Projeto\ApiPets\Model\Pet;
use Projeto\ApiPets\Controller\TipoController;
use Projeto\ApiPets\Controller\PetController;
use Projeto\ApiPets\Router\TipoRouter;
use Projeto\ApiPets\Router\PetRouter;

$app = AppFactory::create();

try {
    $db = Database::getConnection();

    $tipoDAO = new TipoDAO($db);
    $tipoService = new TipoService($tipoDAO);
    $tipoController = new TipoController($tipoService);

    $petDAO = new PetDAO($db);
    $petService = new PetService($petDAO, $tipoDAO);
    $petController = new PetController($petService);

    TipoRouter::registrar($app, $tipoController);
    PetRouter::registrar($app, $petController);

    $app->get('/', function ($request, $response) {
        $html = file_get_contents(__DIR__ . '/../src/View/home.php');

        $response->getBody()->write($html);
        return $response;
    });

    $app->get('/view/tipos', function ($request, $response) {
        $html = file_get_contents(__DIR__ . '/../src/View/tipos.php');

        $response->getBody()->write($html);
        return $response;
    });

    $app->post('/view/tipos/criar', function ($request, $response) use ($tipoService) {
        try {
            $body = $request->getParsedBody();
            $nome = trim((string)($body['nome'] ?? ''));
            $tipoService->create(new Tipo(0, $nome));
            $texto = 'Tipo cadastrado com sucesso.';
        } catch (Exception $e) {
            $texto = 'Erro ao cadastrar tipo: ' . $e->getMessage();
        }

        $response->getBody()->write($texto);
        return $response;
    });

    $app->post('/view/tipos/atualizar', function ($request, $response) use ($tipoService) {
        try {
            $body = $request->getParsedBody();
            $id = (int)($body['id'] ?? 0);
            $nome = trim((string)($body['nome'] ?? ''));
            $tipoService->update(new Tipo($id, $nome));
            $texto = 'Tipo atualizado com sucesso.';
        } catch (Exception $e) {
            $texto = 'Erro ao atualizar tipo: ' . $e->getMessage();
        }

        $response->getBody()->write($texto);
        return $response;
    });

    $app->get('/view/pets', function ($request, $response) {
        $html = file_get_contents(__DIR__ . '/../src/View/pets.php');

        $response->getBody()->write($html);
        return $response;
    });

    $app->post('/view/pets/criar', function ($request, $response) use ($petService) {
        try {
            $body = $request->getParsedBody();
            $nome = trim((string)($body['nome'] ?? ''));
            $idTipo = (int)($body['id_tipo'] ?? 0);
            $petService->create(new Pet(0, $nome, $idTipo));
            $texto = 'Pet cadastrado com sucesso.';
        } catch (Exception $e) {
            $texto = 'Erro ao cadastrar pet: ' . $e->getMessage();
        }

        $response->getBody()->write($texto);
        return $response;
    });

    $app->post('/view/pets/atualizar', function ($request, $response) use ($petService) {
        try {
            $body = $request->getParsedBody();
            $id = (int)($body['id'] ?? 0);
            $nome = trim((string)($body['nome'] ?? ''));
            $idTipo = (int)($body['id_tipo'] ?? 0);
            $petService->update(new Pet($id, $nome, $idTipo));
            $texto = 'Pet atualizado com sucesso.';
        } catch (Exception $e) {
            $texto = 'Erro ao atualizar pet: ' . $e->getMessage();
        }

        $response->getBody()->write($texto);
        return $response;
    });

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        "erro" => "Falha na inicialização do sistema",
        "detalhes" => $e->getMessage()
    ]);
    exit;
}

$app->run();