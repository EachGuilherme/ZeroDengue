<?php

$cep = $_POST["cep"];
$logradouro = $_POST["logradouro"];
$subregiao = $_POST["subregiao"];
$descricao = $_POST["descricao"];
$imagem = basename($_FILES["imagem"]["name"]);

$host = "localhost";
$dbname = "zerodengue";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$sql = "INSERT INTO denuncias (cep, logradouro, subregiao, descricao, imagem) VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sssss", $cep, $logradouro, $subregiao, $descricao, $imagem);

if (mysqli_stmt_execute($stmt)) {
    echo "Denúncia salva.";
} else {
    echo "Erro ao salvar denúncia: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
