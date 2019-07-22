<!doctype html>
<html lang="pt-br">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>OS</title>

    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="css/bootstrap.min.js"></script>

    <!-- Estilos customizados para esse template -->
    <link href="form-validation.css" rel="stylesheet">
    <link href="css/css.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <?php require ("conexao.php");
    if (isset($_GET["id"])) {
        $osid=$_GET["id"];
    }

   $consulta = mysqli_query($conexao,"SELECT ordem.id AS ordemId, ordem.id_equipamento AS ordemEquipamento, ordem.id_cliente AS ordemCliente, ordem.diagnostico AS ordemDiagnostico, ordem.orcamento As ordemOrcamento, ordem.data_in AS ordemData_in, ordem.acessorios AS ordemAcessorios, ordem.data_out AS ordemData_out, ordem.autorizado AS ordemAutorizado, equipamento.id AS equipamentoId, equipamento.equipamento AS equipamentoNome, equipamento.marca AS equipamentoMarca, equipamento.modelo AS equipamentoModelo, equipamento.numero_serie AS equipamentoSerie, equipamento.defeitos AS equipamentoDefeitos, cliente.id AS clienteId, cliente.nome AS clienteNome, cliente.telefone AS clienteTelefone, cliente.telefone2 AS clienteTelefone2, cliente.whatsapp AS clienteWhatsapp
    FROM ordem INNER JOIN equipamento ON equipamento.id=ordem.id_equipamento INNER JOIN cliente ON cliente.id=ordem.id_cliente WHERE ordem.id=$osid ORDER by ordem.id");
    $count = mysqli_num_rows($consulta);
        while ($dados = mysqli_fetch_array($consulta)){
?>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="cartuchos">Cartuchos</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link btn btn-light" href="lista">Ordens de Serviço</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="orcamentos">Orçamentos</a>
            </li>
          </ul>
        </div>
      </nav>
        <div class="row">
            <div class="col-md-12 order-md-1">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col" style="text-align:center;"><img src="logo/logo.png"></th>
                        <th scope="col" colspan="4" style="text-align:center;"><p>Andrade Neves 410 - Salas 5 e 6, Centro<br>
                        Panambi, RS, CEP:98280-000<br>
                        CNPJ: 88.611.363/0002-95 | martinhoeletro@gmail.com<br>
                        3375-2222 | 9 9112-7031 (Whatsapp)<br>
                        </p></th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row" colspan="5" style="text-align:center;"><h1>OS Número <?php printf("%04d",$osid); ?></h1></th>
                        </tr>
                        <tr>
                        <th scope="row" colspan="5" style="text-align:center;">VIA DO CLIENTE</th>
                        </tr>
                        <tr>
                        <th scope="row">Cliente</th>
                        <td colspan="3"><?php echo(mb_strtoupper($dados['clienteNome'])); ?></td>
                        </tr>
                        <tr>
                        <th scope="row">Data de Entrada</th>
                        <td colspan="3"><?php $date = date_create($dados['ordemData_in']);
                            echo date_format($date, 'd/m/Y');
                        ?>
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">Equipamento</th>
                        <td colspan="3"><?php echo(mb_strtoupper($dados['equipamentoNome'])); ?></td>
                        </tr>
                        <tr>
                        <th scope="row">Defeito</th>
                        <td colspan="3"><?php echo(mb_strtoupper($dados['equipamentoDefeitos'])); ?></td>
                        </tr>
                    </tbody>
                </table>

                <p>É obrigatória a apresentação desta ordem de serviço durante a retirada do equipamento.</p>
                <p>Equipamentos não retirados após 12 meses da data de entrega serão enviados para descarte.</p>
                <p>Orçamentos não autorizados podem ter um custo de até R$40,00.</p>
                <br>
                <hr class="dash">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="row" colspan="6" style="text-align:center;">VIA DA EMPRESA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Data de Entrada</th>
                            <td colspan="2"><?php $date = date_create($dados['ordemData_in']);
                            echo date_format($date, 'd/m/Y');
                        ?></td>
                            <th scope="row">Número OS</td>
                            <td colspan="2"><?php printf("%04d",$osid); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Cliente</th>
                            <td colspan="5"><?php echo(mb_strtoupper($dados['clienteNome'])); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Contato</td>
                            <td  colspan="<?php if ($dados['clienteTelefone2']!=""){
                                echo("2");
                                } else {
                                echo("3");
                                }
                                ?>">
                            <?php echo($dados['clienteTelefone']);?>                        
                            </td>
                            <?php
                            if ($dados['clienteTelefone2']!="") {
                                echo("<td>" . $dados['clienteTelefone2']. "</td>");
                                } else {

                                }?>
                            <th scope="row">Whatsapp</td>
                            <td><?php if ($dados['clienteWhatsapp']=="0"){
                                echo("Não");
                            }else{
                                echo("Sim");
                                } ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Equipamento</th>
                            <td colspan="5"><?php echo(mb_strtoupper($dados['equipamentoNome'])); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Marca</th>
                            <td colspan="5"><?php echo(mb_strtoupper($dados['equipamentoMarca'])); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Modelo</th>
                            <td colspan="5"><?php echo(mb_strtoupper($dados['equipamentoModelo'])); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Número de Série</th>
                            <td colspan="5"><?php echo(mb_strtoupper($dados['equipamentoSerie'])); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Acessórios</th>
                            <td colspan="5"><?php echo(mb_strtoupper($dados['ordemAcessorios'])); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Defeito</th>
                            <td colspan="5"><?php echo(mb_strtoupper($dados['equipamentoDefeitos'])); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Diagnóstico</th>
                            <td colspan="5"><?php echo(mb_strtoupper($dados['ordemDiagnostico'])); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Orçamento</th>
                            <td colspan="3"><?php if($dados['ordemOrcamento']!=0){
                                echo("R$ ");
                                echo($dados['ordemOrcamento']);
                                echo(",00");
                            } ?></td>
                            <th scope="row">Aprovado</th>
                            <td colspan="2"><?php if ($dados['ordemAutorizado']=="1"){
                                echo("SIM");
                            }else if ($dados['ordemAutorizado']=="2"){
                                    echo("NÃO");
                                }else{
                                    echo("");
                                } ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Retirado</th>
                            <td colspan="2"><?php if ($dados['ordemData_out']!="0000-00-00"){
                                echo("SIM");
                            }else{
                                    echo("NÃO");
                                } ?></td>
                            <th scope="row">Data</th>
                            <td colspan="3"><?php $date = date_create($dados['ordemData_out']);
                            if ($dados['ordemData_out']!="0000-00-00"){
                                echo date_format($date, 'd/m/Y');
                            }else{
                                echo("");
                                } 
                        ?></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <br>
                <br>
                <p style="text-align:center;">____________________________________________________<br>
                Cliente</p>
            </div>
        </div>
        <?php } ?>
        <br>
        <br>
        <a class="btn btn-primary" href="imprimir?id=<?php echo($osid) ?>">Imprimir</a>
        <a href="editar?id=<?php echo($osid) ?>" class="btn btn-secondary">Editar</a>
        <a href="imprimir_externo?id=<?php echo($osid) ?>" class="btn btn-dark">Imprimir Externo</a>
        <a href="lista" class="btn btn-info">Voltar</a>
        <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 1983 - <?php echo(date('Y')) ?> Martinho Informática</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="">Ordem de Serviço</a></li>
                <li class="list-inline-item"><a href="detalhes">Termos</a></li>
                <li class="list-inline-item"><a href="suporte">Suporte</a></li>
            </ul>
        </footer>
    </div>

    <!-- Principal JavaScript do Bootstrap
    ================================================== -->
    <!-- Foi colocado no final para a página carregar mais rápido -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/vendor/holder.min.js"></script>
    <script>
    
    $('#cliente').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var recipient = button.data('whatever') // Extrai informação dos atributos data-*
    // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
    // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
    var modal = $(this)
    modal.find('.modal-title').text('Nova mensagem para ' + recipient)
    modal.find('.modal-body input').val(recipient)
    });


      // Exemplo de JavaScript para desativar o envio do formulário, se tiver algum campo inválido.
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Selecione todos os campos que nós queremos aplicar estilos Bootstrap de validação customizados.
          var forms = document.getElementsByClassName('needs-validation');

          // Faz um loop neles e previne envio
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
