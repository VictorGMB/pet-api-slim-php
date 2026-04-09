<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Teste Rápido - API Pets</title>
</head>
<body>
    <h1>Painel de Testes</h1>
    
    <section>
        <h2>Lista de Pets (via API)</h2>
        <div id="lista-pets">Carregando...</div>
    </section>

    <script>
        // Função simples para testar sua rota GET /pets
        async function carregarPets() {
            try {
                const response = await fetch('/pets');
                const pets = await response.json();
                
                const div = document.getElementById('lista-pets');
                if (pets.length === 0) {
                    div.innerHTML = "<p>Nenhum pet encontrado no banco.</p>";
                    return;
                }

                div.innerHTML = "<ul>" + pets.map(p => `<li>${p.nome} (ID Tipo: ${p.id_tipo})</li>`).join('') + "</ul>";
            } catch (error) {
                document.getElementById('lista-pets').innerHTML = "Erro ao conectar na API: " + error;
            }
        }

        carregarPets();
    </script>
</body>
</html>