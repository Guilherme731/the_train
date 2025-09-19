<?php
session_start();

// Se já logado, segue
if (isset($_SESSION['usuario'])) {
    return;
}

/**
 * Procura a "raiz do projeto" subindo pastas a partir de $startDir
 * até encontrar algum arquivo marcador (login.php, index.php, config.php, composer.json).
 * Retorna caminho absoluto do diretório encontrado ou false.
 */
function find_project_root($startDir = __DIR__, $markers = ['login.php','index.php','config.php','composer.json']) {
    $dir = realpath($startDir);
    if (!$dir) return false;
    $last = '';
    while ($dir && $dir !== $last) {
        foreach ($markers as $m) {
            if (file_exists($dir . DIRECTORY_SEPARATOR . $m)) {
                return $dir;
            }
        }
        $last = $dir;
        $dir = dirname($dir);
    }
    return false;
}

// monta protocolo e host
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];

// tenta detectar a raiz do projeto (começa em __DIR__, que é o diretório do arquivo atual)
$rootFS = find_project_root(__DIR__);

// fallback para DOCUMENT_ROOT caso não encontre
if ($rootFS === false) {
    $rootFS = realpath($_SERVER['DOCUMENT_ROOT']);
}

// tenta transformar caminho físico em caminho URL relativo ao DOCUMENT_ROOT
$docRoot = realpath($_SERVER['DOCUMENT_ROOT']);
$rootFsReal = realpath($rootFS);
$projectUrlPath = '';

if ($docRoot !== false && $rootFsReal !== false && strpos($rootFsReal, $docRoot) === 0) {
    $projectUrlPath = substr($rootFsReal, strlen($docRoot));
} else {
    // se não for possível, usa como fallback a raiz do script requisitado
    $projectUrlPath = dirname($_SERVER['SCRIPT_NAME']);
}

// normaliza barras e monta URL final (aponta para login.php na raiz do projeto)
$projectUrlPath = str_replace('\\','/',$projectUrlPath);
$projectUrlPath = '/' . trim($projectUrlPath, '/');

$loginUrl = rtrim($protocol . $host . $projectUrlPath, '/') . '/public/login.php';

// redireciona
header("Location: $loginUrl");
exit();
