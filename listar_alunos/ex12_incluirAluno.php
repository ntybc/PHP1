<?php
    $msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $msg = "";

    if (!file_exists("alunos.txt")) {
        $arqAluno = fopen("alunos.txt","w") or die("erro ao criar arquivo");
        $linha = "matricula;nome;email\n";
        fwrite($arqAluno,$linha);
        fclose($arqAluno);
    }

    $arqAluno = fopen("alunos.txt","a") or die("erro ao abrir arquivo");
    $linha = $matricula . ";" . $nome . ";" . $email . "\n";
    fwrite($arqAluno,$linha);
    fclose($arqAluno);

    $msg = "Aluno cadastrado com sucesso!!!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilo_listarAlunos.css">
</head>
<body>

<h1>Cadastrar Novo Aluno</h1>

<form action="ex12_incluirAluno.php" method="POST">
    Matrícula: <input type="text" name="matricula">
    <br><br>
    Nome: <input type="text" name="nome">
    <br><br>
    Email: <input type="text" name="email">
    <br><br>
    <input type="submit" value="Cadastrar Aluno">
</form>

<p><?php echo $msg ?></p>
<br>
<a href="ex07_listarAlunos.php">Voltar para Listagem</a>

</body>
</html>