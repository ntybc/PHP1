<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST["nome"];
    $matricula = $_POST["matricula"];
    $curso = $_POST["curso"];

    $msg = "";

    if (!file_exists("alunos.txt")) {

        $arqAluno = fopen("alunos.txt", "w") or die("erro ao criar arquivo");

        $linha = "nome;matricula;curso\n";

        fwrite($arqAluno, $linha);

        fclose($arqAluno);
    }

    $arqAluno = fopen("alunos.txt", "a") or die("erro ao criar arquivo");

    $linha = $nome . ";" . $matricula . ";" . $curso . "\n";

    fwrite($arqAluno, $linha);

    fclose($arqAluno);

    $msg = "Aluno cadastrado com sucesso! 💗";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Aluno</title>

    <link rel="stylesheet" href="estilo_cadastro.css">
    
</head>

<body>

    <div class="container">

        <h1>Cadastro de Aluno</h1>

        <p class="subtitulo">
            Preencha os dados do aluno
        </p>

        <form action="incluir_aluno.php" method="POST">

            <label for="nome">Nome:</label>

            <input
                type="text"
                name="nome"
                id="nome"
                required
            >

            <label for="matricula">Matrícula:</label>

            <input
                type="text"
                name="matricula"
                id="matricula"
                required
            >

            <label for="curso">Curso:</label>

            <input
                type="text"
                name="curso"
                id="curso"
                required
            >

            <input
                type="submit"
                value="Cadastrar Aluno"
            >

        </form>

        <?php if (!empty($msg)) { ?>

            <p class="mensagem">
                <?php echo $msg; ?>
            </p>

        <?php } ?>

    </div>

</body>

</html>
