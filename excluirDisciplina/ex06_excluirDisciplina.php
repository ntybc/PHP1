<?php
    $msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $sigla = $_POST["sigla"];
    $msg = "";

    $arqDisc = fopen("disciplinas.txt","r") or die("erro ao abrir arquivo");
    $arqDiscNovo = fopen("disciplinas_novo.txt","w") or die("erro ao criar arquivo");

    $linha = fgets($arqDisc); // cabeçalho
    fwrite($arqDiscNovo,$linha);

    while(!feof($arqDisc)) {
        $linha = fgets($arqDisc);
        if ($linha === false) continue;

        $colunaDados = explode(";", $linha);

        if (trim($colunaDados[1]) != trim($sigla)) {
            fwrite($arqDiscNovo,$linha);
        }
    }

    fclose($arqDisc);
    fclose($arqDiscNovo);

    unlink("disciplinas.txt");
    rename("disciplinas_novo.txt","disciplinas.txt");

    $msg = "Disciplina excluída com sucesso!!!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="excluirDisciplina.css">
</head>
<body>

<h1>Excluir Disciplina</h1>

<form action="ex06_excluirDisciplina.php" method="POST">
    Sigla: <input type="text" name="sigla">
    <br><br>
    <input type="submit" value="Excluir Disciplina">
</form>

<p><?php echo $msg ?></p>
<br>
</body>
</html>