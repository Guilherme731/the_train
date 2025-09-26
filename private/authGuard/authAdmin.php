<?php
//session_start();

if ($_SESSION['tipo'] == 'admin') {
    return;
}

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

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];

$rootFS = find_project_root(__DIR__);

if ($rootFS === false) {
    $rootFS = realpath($_SERVER['DOCUMENT_ROOT']);
}

$docRoot = realpath($_SERVER['DOCUMENT_ROOT']);
$rootFsReal = realpath($rootFS);
$projectUrlPath = '';

if ($docRoot !== false && $rootFsReal !== false && strpos($rootFsReal, $docRoot) === 0) {
    $projectUrlPath = substr($rootFsReal, strlen($docRoot));
} else {
    $projectUrlPath = dirname($_SERVER['SCRIPT_NAME']);
}

$projectUrlPath = str_replace('\\','/',$projectUrlPath);
$projectUrlPath = '/' . trim($projectUrlPath, '/');

$loginUrl = rtrim($protocol . $host . $projectUrlPath, '/') . '/public/login.php';

header("Location: $loginUrl");
exit();
