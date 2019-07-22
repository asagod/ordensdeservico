<?php
require ("conexao.php");

$cliente=$_POST["cliente_id"];
$marca=$_POST["marca"];
$modelo=$_POST["modelo"];
$cor=$_POST["cor"];
$observacoes=$_POST["observacoes"];
$data_in=date("Y-m-d");

if (!$conexao) {
    die("Conexão com o banco falhou: " . mysqli_connect_error());
}

$cartuchoQuery = $conexao->prepare("INSERT INTO cartucho (marca, modelo, cliente_id, cor, observacoes, data_in) VALUES (?, ?, ?, ?, ?, ?)");
$cartuchoQuery->bind_param("isiiss", $cartuchoMarca, $cartuchoModelo, $cartuchoCliente, $cartuchoCor, $cartuchoObservacoes, $dataIn);
$cartuchoCliente = $cliente;
$cartuchoMarca = $marca;
$cartuchoModelo = $modelo;
$cartuchoCor = $cor;
$cartuchoObservacoes = $observacoes;
$dataIn = $data_in;
if ($cartuchoQuery->execute()) {
    header("Location:cartuchos");
} else {
    header("Location:erro");
};

mysqli_close($conexao);

?>