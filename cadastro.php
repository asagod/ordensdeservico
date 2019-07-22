<?php
require ("conexao.php");

$cliente=$_POST["cliente_id"];
$equipamento=$_POST["tipo"];
$marca=$_POST["marca"];
$modelo=$_POST["modelo"];
$serie=$_POST["serie"];
$defeitos=$_POST["defeito"];
$acessorios=$_POST["acessorios"];
$data_in=date("Y-m-d");

if (!$conexao) {
    die("Conexão com o banco falhou: " . mysqli_connect_error());
}

$equipamentoQuery = $conexao->prepare("INSERT INTO equipamento (equipamento, marca, modelo, numero_serie, defeitos) VALUES (?, ?, ?, ?, ?)");
$equipamentoQuery->bind_param("sssss", $equipamentoNome, $equipamentoMarca, $equipamentoModelo, $equipamentoSerie, $equipamentoDefeitos);
$equipamentoNome = $equipamento;
$equipamentoMarca = $marca;
$equipamentoModelo = $modelo;
$equipamentoSerie = $serie;
$equipamentoDefeitos = $defeitos;
if ($equipamentoQuery->execute()) {
        $consultaEquipamento = mysqli_query($conexao,"SELECT * from equipamento ORDER by id DESC LIMIT 1");
        $countEquipamento = mysqli_num_rows($consultaEquipamento);
        while ($dados = mysqli_fetch_array($consultaEquipamento)){
        $equipamento_id = $dados['id'];
    }

    $ordemQuery = $conexao->prepare("INSERT INTO ordem (id_equipamento, id_cliente, data_in, acessorios) VALUES (?, ?, ?, ?)");
    $ordemQuery->bind_param("iiss", $equipamentoId, $ordemId_cliente, $ordemData_in, $ordemAcessorios);
    $equipamentoId = $equipamento_id;
    $ordemId_cliente = $cliente;
    $ordemData_in = $data_in;
    $ordemAcessorios = $acessorios;
    if ($ordemQuery->execute() ){
        header("Location:lista");
    } else {
        header("Location:erro");
    };
} else {
    header("Location:erro");
};



mysqli_close($conexao);

?>