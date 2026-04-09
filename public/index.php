<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Projeto\ApiPets\DAO\Database;
use Projeto\ApiPets\DAO\TipoDAO;
use Projeto\ApiPets\DAO\PetDAO;
use Projeto\ApiPets\Service\TipoService;
use Projeto\ApiPets\Service\PetService;
use Projeto\ApiPets\Controller\TipoController;
use Projeto\ApiPets\Controller\PetController;
use Projeto\ApiPets\Router\TipoRouter;
use Projeto\ApiPets\Router\PetRouter;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

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

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        "erro" => "Falha na inicialização do sistema",
        "detalhes" => $e->getMessage()
    ]);
    exit;
}

$app->run();