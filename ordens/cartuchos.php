<!doctype html>
<html lang="pt-br">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Cartuchos</title>

    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="css/bootstrap.min.js"></script>

    <!-- Estilos customizados para esse template -->
    <link href="form-validation.css" rel="stylesheet">
    <link href="css/css.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body class="bg-light">
    <?php require ("conexao.php");
    if (isset($_GET['estado'])){
      $variavel=($_GET['estado']);
      $coluna="cartucho.situacao";
    } else if (isset($_GET['pesquisa'])){
      $coluna="cliente.nome";
      $pesquisa=$_GET['pesquisa'];
      $variavel="'%".$pesquisa."%'";
    } else {
      $coluna="cliente.nome";
      $variavel="'% %'";
    }
    ?>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link btn btn-light" href="cartuchos">Cartuchos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="lista">Ordens de Serviço</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="orcamentos">Orçamentos</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="py-5 text-center">
        <h2>LISTA DE CARTUCHOS PARA RECARGA</h2>
        <p class="lead"></p>
      </div>
      <div class="container">
      <form action="cartuchos?pesquisa=" method="GET">
      <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
      <div class="btn-group mr-2" role="group" aria-label="Adicionar">
          <a class="btn btn-success" href="cadastrar-cartuchos">Novo</a>
        </div>
        <div class="btn-group mr-2" role="group" aria-label="Pesquisa">
          <a class="btn btn-outline-dark" href="cartuchos?pesquisa= ">Todos</a>
          <a class="btn btn-outline-dark" href="cartuchos?estado=0">Carregando</a>
          <a class="btn btn-outline-dark" href="cartuchos?estado=1">Finalizado</a>
          <a class="btn btn-outline-dark" href="cartuchos?estado=2">Entupido</a>
          <a class="btn btn-outline-dark" href="cartuchos?estado=3">Queimado</a>
        </div>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text" id="btnGroupAddon">Nome:</div>
          </div>
            <input type="text" class="form-control" placeholder="Fulano de Tal" name="pesquisa">
          <div class="input-group-append">
            <button class="btn btn-outline-dark" type="submit">Pesquisar</button>
          </div>
        </div>
      </div>
      </form>
      </div>
      <br>
      <br>
      <div class="row">
      <table class="table table-borderless table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Cartucho</th>
            <th scope="col">Nome</th>
            <th scope="col">Modelo</th>
            <th scope="col">Entrada</th>
            <th scope="col">Situação</th>
            <th scope="col">Saída</th>
            <th scope="col">Observações</th>
            <th scope="col">Impressora</th>
            <th scope="col">Detalhes</th>
          </tr>
        </thead>
        <tbody>
          <?php
                $consulta = mysqli_query($conexao,"SELECT cartucho.id AS id, cartucho.situacao AS cartuchoSituacao, cartucho.modelo AS cartuchoModelo, cliente.nome AS clienteNome, cartucho.data_in AS dataIn, cartucho.data_out AS dataOut, cartucho.observacoes AS cartuchoObservacoes from cartucho INNER JOIN cliente ON cartucho.cliente_id = cliente.id WHERE $coluna LIKE $variavel ORDER by id DESC");
                    $count = mysqli_num_rows($consulta);
                        while ($dados = mysqli_fetch_array($consulta)){
            ?><tr>
                <th scope="row"><?php $os=$dados['id']; printf("%04d",$os)?></td>
                <td><?php echo mb_strtoupper($dados['clienteNome']); ?></td>
                <td><?php echo mb_strtoupper($dados['cartuchoModelo']); ?></td>
                <td><?php $date = date_create($dados['dataIn']);
                echo date_format($date, 'd/m/Y');
                ?></td>
                <td><?php $situacao=$dados['cartuchoSituacao'];
                switch($situacao){
                  case 0: echo "Carregando";
                          break;
                  case 1: echo "Finalizado";
                          break;
                  case 2: echo "Entupido";
                          break;
                  case 3: echo "Queimado";
                          break;
                 } ?></td>
                <td><?php $date = date_create($dados['dataOut']);
                            if ($dados['dataOut']!="0000-00-00"){
                                echo date_format($date, 'd/m/Y');
                            } else {
                                echo("Não");
                            } 
                ?></td>
                <td><?php echo mb_strtoupper($dados['cartuchoObservacoes']); ?></td>
                <td><?php $date = date_create($dados['dataOut']);
                            if ($dados['dataOut']!="0000-00-00"){
                                echo ("Sim");
                            } else {
                                echo("Não");
                            } 
                ?></td>
                <td><a href="cartucho-detalhes?id=<?php echo $dados['id']; ?>" class="btn btn-info" title="Editar"><i class="material-icons">build</i></a></td>
              </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
        </div>
    <br>
     <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 1983 - <?php echo(date('Y')) ?> Martinho Informática</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="">Ordem de Serviço</a></li>
          <li class="list-inline-item"><a href="detalhes">Termos</a></li>
          <li class="list-inline-item"><a href="suporte">Suporte</a></li>
        </ul>
      </footer>
    </div>

    <!-- Principal JavaScript do Bootstrap -->
    <!-- Foi colocado no final para a página carregar mais rápido -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/vendor/holder.min.js"></script>
    <script>
    
    $('#cliente').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('whatever')
    var modal = $(this)
    modal.find('.modal-title').text('Nova mensagem para ' + recipient)
    modal.find('.modal-body input').val(recipient)
    });

      (function() {
        'use strict';

        window.addEventListener('load', function() {
          var forms = document.getElementsByClassName('needs-validation');
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
