<?php

// Simulação de dados de quadras
$quadras = [
    [
        'id' => 1,
        'nome' => 'Quadra 1',
        'tipo' => 'Futsal',
        'disponivel' => true,
        'descricao' => 'Quadra principal para futsal, com piso sintético'
    ],
    [
        'id' => 2,
        'nome' => 'Quadra 2',
        'tipo' => 'Basquete',
        'disponivel' => true,
        'descricao' => 'Quadra coberta para basquete, com piso de madeira'
    ],
    [
        'id' => 3,
        'nome' => 'Quadra 3',
        'tipo' => 'Vôlei',
        'disponivel' => false,
        'descricao' => 'Quadra de vôlei em manutenção'
    ]
];

// Exibindo os dados em formato HTML
echo "<!DOCTYPE html>";
echo "<html lang=\"pt-BR\">";
echo "<head>";
echo "    <meta charset=\"UTF-8\">";
echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
echo "    <title>Teste de Quadras</title>";
echo "    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">";
    echo "</head>";
    echo "<body>";
    echo "    <div class=\"container mt-5\">";
    echo "        <h1>Quadras Disponíveis</h1>";
        echo "        <div class=\"row\">";
        foreach ($quadras as $quadra) {
            echo "            <div class=\"col-md-4 mb-4\">";
            echo "                <div class=\"card\">";
            echo "                    <div class=\"card-body\">";
            echo "                        <h5 class=\"card-title\">" . htmlspecialchars($quadra['nome']) . "</h5>";
            echo "                        <p class=\"card-text\">";
            echo "                            <strong>Tipo:</strong> " . htmlspecialchars($quadra['tipo']) . "<br>";
            echo "                            <strong>Status:</strong> ";
            echo "                            <span class=\"badge " . ($quadra['disponivel'] ? 'bg-success' : 'bg-danger') . "\">";
            echo "                                " . ($quadra['disponivel'] ? 'Disponível' : 'Indisponível') . "";
            echo "                            </span>";
            echo "                        </p>";
            if ($quadra['descricao']) {
                echo "                        <p class=\"card-text\">" . htmlspecialchars($quadra['descricao']) . "</p>";
            }
            echo "                    </div>";
            echo "                </div>";
            echo "            </div>";
        }
        echo "        </div>";
    echo "    </div>";
    echo "    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>";
    echo "</body>";
    echo "</html>";
