<?php
    $matricula = "";
    $nome = "";
    $email = "";
    $msg = "";
    $encontrou = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $matricula = $_GET["matricula"];

    $arqAluno = fopen("alunos.txt","r") or die("erro ao abrir arquivo");
    $linha = fgets($arqAluno); // cabeçalho

    while(!feof($arqAluno)) {
        $linha = fgets($arqAluno);
        if ($linha === false || trim($linha) == "") continue;

        $colunaDados = explode(";", $linha);

        if (trim($colunaDados[0]) == trim($matricula)) {
            $nome = trim($colunaDados[1]);
            $email = trim($colunaDados[2]);
            $encontrou = true;
            break;
        }
    }
    fclose($arqAluno);

    if (!$encontrou) {
        $msg = "Aluno não encontrado!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Excluir Aluno</h1>

<?php if ($encontrou) { ?>
<p>Confirma a exclusão do aluno abaixo?</p>
<form action="ex11_excluirAlunoNoArquivo.php" method="POST">
    Matrícula: <?php echo $matricula ?>
    <input type="hidden" name="matricula" value='<?php echo $matricula ?>'>
    <br><br>
    Nome: <?php echo $nome ?>
    <br><br>
    Email: <?php echo $email ?>
    <br><br>
    <input type="submit" value="Confirmar Exclusão" class="btn-excluir">
</form>
<?php } ?>

<p><?php echo $msg ?></p>
<br>
<a href="ex07_listarAlunos.php">Voltar para Listagem</a>

</body>
</html>
