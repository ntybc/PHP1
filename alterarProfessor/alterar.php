<?php
require 'funcoes.php';

// A matrícula vem pela URL (ao abrir a página) ou pelo formulário (ao salvar)
$matricula = $_GET['matricula'] ?? $_POST['matricula'] ?? '';

$professores = lerProfessores();

// Procura o professor pela matrícula
$posicao = null;
foreach ($professores as $i => $p) {
    if ($p['matricula'] === $matricula) {
        $posicao = $i;
        break;
    }
}

$erros = [];
$professor = null;

if ($posicao !== null) {
    $professor = $professores[$posicao];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome     = limpar($_POST['nome'] ?? '');
        $cpf      = preg_replace('/\D/', '', $_POST['cpf'] ?? ''); // só números
        $endereco = limpar($_POST['endereco'] ?? '');

        if ($nome === '') {
            $erros[] = 'Informe o nome.';
        }
        if (strlen($cpf) !== 11) {
            $erros[] = 'O CPF deve ter 11 números.';
        }
        if ($endereco === '') {
            $erros[] = 'Informe o endereço.';
        }

        // Mantém no formulário o que a pessoa digitou (a matrícula não muda)
        $professor['nome']     = $nome;
        $professor['cpf']      = $cpf;
        $professor['endereco'] = $endereco;

        if (empty($erros)) {
            $professores[$posicao] = $professor;

            if (salvarProfessores($professores)) {
                header('Location: index.php?alterado=1');
                exit;
            }

            $erros[] = 'Não foi possível salvar. Verifique a permissão do arquivo professores.txt.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alterar professor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Alterar professor</h1>

        <?php if ($professor === null): ?>
            <p class="mensagem erro">Professor não encontrado.</p>
            <a class="botao" href="index.php">Voltar para a lista</a>
        <?php else: ?>

            <?php if (!empty($erros)): ?>
                <div class="mensagem erro">
                    <?php foreach ($erros as $erro): ?>
                        <p><?= e($erro) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="alterar.php">
                <label for="matricula">Matrícula</label>
                <input type="text" id="matricula" name="matricula"
                       value="<?= e($professor['matricula']) ?>" readonly>

                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome"
                       value="<?= e($professor['nome']) ?>" required>

                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" inputmode="numeric"
                       value="<?= e(formatarCpf($professor['cpf'])) ?>" required>

                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco"
                       value="<?= e($professor['endereco']) ?>" required>

                <div class="acoes">
                    <button type="submit" class="botao">Salvar alterações</button>
                    <a class="link" href="index.php">Cancelar</a>
                </div>
            </form>

        <?php endif; ?>
    </main>
</body>
</html>