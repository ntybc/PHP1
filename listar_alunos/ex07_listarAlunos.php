<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilo_listarAlunos.css">
</head>
<body>

<h1>Listar Alunos</h1>

<ul>
    <li><a href="ex12_incluirAluno.php">Novo Aluno</a></li>
</ul>

<table>
    <tr>
        <th>Matrícula</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>

<?php
    $arqAluno = fopen("alunos.txt","r") or die("erro ao abrir arquivo");

    $linha = fgets($arqAluno); // pula o cabeçalho

    while(!feof($arqAluno)) {
        $linha = fgets($arqAluno);
        if ($linha === false || trim($linha) == "") continue;

        $colunaDados = explode(";", $linha);
        $matricula = trim($colunaDados[0]);
        $nome = trim($colunaDados[1]);
        $email = trim($colunaDados[2]);

        echo "<tr>";
        echo "<td>" . $matricula . "</td>";
        echo "<td>" . $nome . "</td>";
        echo "<td>" . $email . "</td>";
        echo "<td>";
        echo "<form action='ex08_mostrarAlunoAlterar.php' method='GET' style='display:inline;'>";
        echo "<input type='hidden' name='matricula' value='" . $matricula . "'>";
        echo "<input type='submit' value='Alterar'>";
        echo "</form> ";
        echo "<form action='ex10_mostrarAlunoExcluir.php' method='GET' style='display:inline;'>";
        echo "<input type='hidden' name='matricula' value='" . $matricula . "'>";
        echo "<input type='submit' value='Excluir' class='btn-excluir'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    fclose($arqAluno);
?>
</table>

<br>
<a href="ex07_listarAlunos.php">Atualizar Lista</a>

</body>
</html>