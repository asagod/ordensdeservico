<?php
require ("conexao.php");


$id=$_GET["id"];
$contato=$_POST["contato"];
$whatsapp=$_POST["whatsapp"];
$acessorios=$_POST["acessorios"];
$defeitos=$_POST["defeitos"];
$diagnostico=$_POST["diagnostico"];
$orcamento=$_POST["orcamento"];
$autorizado=$_POST['autorizado'];
$situacao=$_POST['situacao'];
if (!isset($_POST['data_out'])){
    $data_out=date("Y-m-d");
} else {
    $data_out=date($_POST['data_out']);
}

if (!$conexao) {
    die("Conexão com o banco falhou: " . mysqli_connect_error());
}

$update=mysqli_query($conexao, "UPDATE ordem
SET diagnostico = '$diagnostico', orcamento = '$orcamento', acessorios = '$acessorios', data_out = '$data_out', autorizado = '$autorizado', situacao ='$situacao' WHERE id = '$id';");



mysqli_close($conexao);

if ($update) {
    header("Location:lista");
}else{
    header("Location:erro");
};

?>