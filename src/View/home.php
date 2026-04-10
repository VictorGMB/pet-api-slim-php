<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #222;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
        }

        h1 {
            margin-top: 0;
        }

        ul {
            padding-left: 20px;
        }

        a {
            color: #0b5ed7;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Pets</h1>
        <p>Camada de visualizacao simples para a atividade.</p>

        <h2>Menu</h2>
        <ul>
            <li><a href="/view/tipos">Gerenciar Tipos</a></li>
            <li><a href="/view/pets">Gerenciar Pets</a></li>
        </ul>

        <h2>API (Insomnia)</h2>
        <ul>
            <li><a href="/tipos">GET /tipos</a></li>
            <li><a href="/pets">GET /pets</a></li>
        </ul>
    </div>
</body>
</html>
