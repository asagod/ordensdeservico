<?php
require ("conexao.php");

$nome=$_POST["nome"];
$telefone=$_POST["telefone"];
$telefone2=$_POST["telefone2"];
if(!isset($_POST["whatsapp"])){
    $whatsapp="0";
}else{
    $whatsapp="1";
};

if (!$conexao) {
    die("Conexão com o banco falhou: " . mysqli_connect_error());
}

$stmt = $conexao->prepare("INSERT INTO cliente (nome, telefone, telefone2, whatsapp) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $clienteNome, $clienteTelefone, $clienteTelefone2, $clienteWhatsapp);
$clienteNome = $nome;
$clienteTelefone = $telefone;
$clienteTelefone2 = $telefone2;
$clienteWhatsapp = $whatsapp;
if ($stmt->execute()){
    header("Location:cadastrar");
}else{
    header("Location:erro");
};

mysqli_close($conexao);

?>