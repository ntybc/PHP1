<?php
    $msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $arqAluno = fopen("alunos.txt","r") or die("erro ao abrir arquivo");
    $arqAlunoNovo = fopen("alunos_novo.txt","w") or die("erro ao criar arquivo");

    $linha = fgets($arqAluno); // cabeçalho
    fwrite($arqAlunoNovo,$linha);

    while(!feof($arqAluno)) {
        $linha = fgets($arqAluno);
        if ($linha === false || trim($linha) == "") continue;

        $colunaDados = explode(";", $linha);

        if (trim($colunaDados[0]) == trim($matricula)) {
            $linha = $matricula . ";" . $nome . ";" . $email . "\n";
        }

        fwrite($arqAlunoNovo,$linha);
    }

    fclose($arqAluno);
    fclose($arqAlunoNovo);

    unlink("alunos.txt");
    rename("alunos_novo.txt","alunos.txt");

    $msg = "Aluno alterado com sucesso!!!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Alterar Aluno</h1>

<p><?php echo $msg ?></p>
<br>
<a href="ex07_listarAlunos.php">Voltar para Listagem</a>

</body>
</html>