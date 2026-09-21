<?php
// Arquivo onde os professores ficam salvos (uma linha por professor)
// Formato da linha: matricula;nome;cpf;endereco
const ARQUIVO = __DIR__ . '/professores.txt';

// Lê o arquivo e devolve um array com todos os professores
function lerProfessores(): array
{
    $professores = [];

    if (!file_exists(ARQUIVO)) {
        return $professores;
    }

    $linhas = file(ARQUIVO, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($linhas as $linha) {
        $campos = explode(';', $linha);

        if (count($campos) < 4) {
            continue; // ignora linhas incompletas
        }

        $professores[] = [
            'matricula' => $campos[0],
            'nome'      => $campos[1],
            'cpf'       => $campos[2],
            'endereco'  => $campos[3],
        ];
    }

    return $professores;
}

// Regrava o arquivo inteiro com a lista de professores recebida
function salvarProfessores(array $professores): bool
{
    $conteudo = '';

    foreach ($professores as $p) {
        $conteudo .= implode(';', [
            $p['matricula'],
            $p['nome'],
            $p['cpf'],
            $p['endereco'],
        ]) . PHP_EOL;
    }

    return file_put_contents(ARQUIVO, $conteudo, LOCK_EX) !== false;
}

// Remove ; e quebras de linha para não quebrar o formato do arquivo
function limpar(string $texto): string
{
    return trim(str_replace([';', "\r", "\n"], ' ', $texto));
}

// Escapa texto para exibir com segurança no HTML
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

// 12345678901 -> 123.456.789-01
function formatarCpf(string $cpf): string
{
    if (strlen($cpf) !== 11) {
        return $cpf;
    }

    return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' .
           substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
}