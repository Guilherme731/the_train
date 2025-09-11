<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "the_train_db;";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexao falhou: " . $conn->connect_error);
}