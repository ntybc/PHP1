<?php
header('Content-Type: application/json; charset=utf-8');

$dados = json_decode(file_get_contents('php://input'), true);
$a  = $dados['a']  ?? null;
$b  = $dados['b']  ?? null;
$op = $dados['op'] ?? null;

if (!is_numeric($a) || !is_numeric($b)) {
    http_response_code(400);
    echo json_encode(['erro' => 'Informe dois números válidos.']);
    exit;
}
$a = (float) $a;
$b = (float) $b;

switch ($op) {
    case '+': $resultado = $a + $b; break;
    case '-': $resultado = $a - $b; break;
    case '*': $resultado = $a * $b; break;
    case '/':
        if ($b == 0) {
            http_response_code(400);
            echo json_encode(['erro' => 'Não é possível dividir por zero.']);
            exit;
        }
        $resultado = $a / $b;
        break;
    default:
        http_response_code(400);
        echo json_encode(['erro' => 'Operação inválida.']);
        exit;
}
echo json_encode(['resultado' => $resultado]);