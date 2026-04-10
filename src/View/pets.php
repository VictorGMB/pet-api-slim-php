<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
    </style>
</head>
<body>
    <h1>Pets</h1>

    <p><a href="/">Inicio</a></p>
    <p><a href="/view/tipos">Tipos</a></p>
    <p><a href="/pets">Listar Pets (API)</a></p>

    <h2>Cadastrar Pet</h2>
    <form method="post" action="/view/pets/criar">
        <label for="nome">Nome:</label>
        <input id="nome" type="text" name="nome">
        <br>
        <label for="idTipo">ID Tipo:</label>
        <input id="idTipo" type="number" name="id_tipo">
        <input type="submit" value="Cadastrar">
    </form>

    <h2>Atualizar Pet</h2>
    <form method="post" action="/view/pets/atualizar">
        <label for="id">ID:</label>
        <input id="id" type="number" name="id">
        <br>
        <label for="nomeUpdate">Novo nome:</label>
        <input id="nomeUpdate" type="text" name="nome">
        <br>
        <label for="idTipoUpdate">Novo ID Tipo:</label>
        <input id="idTipoUpdate" type="number" name="id_tipo">
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
