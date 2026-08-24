<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Calculadora PHP</title>

    <link rel="stylesheet" href="estilo_calculadora.css">
</head>

<body>

    <div class="calculadora">

        <h1>Calculadora</h1>

        <p class="subtitulo">Operações básicas em PHP</p>

        <form method="POST">

            <label for="numero1">Primeiro número:</label>
            <input type="number" step="any" name="numero1" id="numero1" required>

            <label for="numero2">Segundo número:</label>
            <input type="number" step="any" name="numero2" id="numero2" required>

            <label for="operacao">Escolha a operação:</label>

            <select name="operacao" id="operacao" required>
                <option value="">Selecione</option>
                <option value="soma">Adição (+)</option>
                <option value="subtracao">Subtração (-)</option>
                <option value="multiplicacao">Multiplicação (×)</option>
                <option value="divisao">Divisão (÷)</option>
            </select>

            <button type="submit">Calcular</button>

        </form>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $numero1 = $_POST["numero1"];
            $numero2 = $_POST["numero2"];
            $operacao = $_POST["operacao"];

            switch ($operacao) {

                case "soma":
                    $resultado = $numero1 + $numero2;
                    break;

                case "subtracao":
                    $resultado = $numero1 - $numero2;
                    break;

                case "multiplicacao":
                    $resultado = $numero1 * $numero2;
                    break;

                case "divisao":

                    if ($numero2 == 0) {
                        $resultado = "Não é possível dividir por zero.";
                    } else {
                        $resultado = $numero1 / $numero2;
                    }

                    break;

                default:
                    $resultado = "Selecione uma operação.";
            }

            echo "<div class='resultado'>";
            echo "<h2>Resultado</h2>";
            echo "<p>$resultado</p>";
            echo "</div>";
        }

        ?>

    </div>

</body>

</html>
