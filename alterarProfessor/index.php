<?php
require 'funcoes.php';

$professores = lerProfessores();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Professores</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Professores</h1>

        <?php if (isset($_GET['alterado'])): ?>
            <p class="mensagem sucesso">Professor alterado com sucesso.</p>
        <?php endif; ?>

        <?php if (empty($professores)): ?>
            <p>Nenhum professor cadastrado.</p>
        <?php else: ?>
            <div class="tabela-rolagem">
                <table>
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Endereço</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($professores as $p): ?>
                            <tr>
                                <td><?= e($p['matricula']) ?></td>
                                <td><?= e($p['nome']) ?></td>
                                <td><?= e(formatarCpf($p['cpf'])) ?></td>
                                <td><?= e($p['endereco']) ?></td>
                                <td>
                                    <a class="botao" href="alterar.php?matricula=<?= urlencode($p['matricula']) ?>">Alterar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>