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

    $consulta = mysqli_query($conexao,"SELECT cartucho.id AS cartuchoId, cartucho.modelo AS cartuchoModelo, cartucho.marca AS cartuchoMarca, cartucho.cor AS cartuchoCor, cartucho.cliente_id As cartuchoCliente, cartucho.data_in AS cartuchoData_in, cartucho.data_out AS cartuchoData_out, cartucho.situacao AS cartuchoSituacao, cartucho.observacoes AS cartuchoObservacoes, cartucho.impressora AS cartuchoImpressora, cliente.nome AS clienteNome
    FROM cartucho INNER JOIN cliente ON cliente.id=cartucho.cliente_id WHERE cartucho.id=$osid ORDER by cartucho.id");
    $count = mysqli_num_rows($consulta);
        while ($dados = mysqli_fetch_array($consulta)) {
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
              <a class="nav-link btn btn-light" href="outros">Orçamentos</a>
            </li>
          </ul>
        </div>
      </nav>
        <div class="row">
            <div class="col-md-12 order-md-1">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="row" colspan="5" style="text-align:center;"><h1>Cartucho <?php printf("%04d",$osid); ?></h1></th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr>
                            <th scope="row">Cliente</th>
                            <td colspan="3"><input class="form-control" type="text" name="cliente" value="<?php echo($dados['clienteNome']); ?>"></td>
                        </tr>
                        <tr>
                        <th scope="row">Data de Entrada</th>
                            <td colspan="3"><input type="date" class="form-control" name="data_in" value="<?php $date = date_create($dados['cartuchoData_in']);
                            if ($dados['cartuchoData_in']!="0000-00-00") {
                                #echo date_format($date, 'd/m/Y');
                                echo $dados['cartuchoData_in'];
                            } else {
                                echo("");
                                }
                        ?>"></td>
                        </tr>
                        <tr>
                            <th scope="row">Marca</th>
                            <td colspan="3">
                            <select class="form-control" name="marca">
                                    <option value="1" <?php echo $dados['cartuchoMarca']==1 ? "selected" : ""; ?>>HP</option>
                                    <option value="2" <?php echo $dados['cartuchoMarca']==2 ? "selected" : ""; ?>>Canon</option>
                                    <option value="3" <?php echo $dados['cartuchoMarca']==3 ? "selected" : ""; ?>>Epson</option>
                                    <option value="4" <?php echo $dados['cartuchoMarca']==4 ? "selected" : ""; ?>>Outra</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Modelo</th>
                            <td colspan="3"><input class="form-control" type="text" name="modelo" value="<?php echo($dados['cartuchoModelo']); ?>"></td>
                        </tr>
                        <tr>
                            <th scope="row">Cor</th>
                            <td colspan="3">
                            <select class="form-control" name="cor">
                                    <option value="0" <?php echo $dados['cartuchoCor']==0 ? "selected" : ""; ?>>Preto</option>
                                    <option value="1" <?php echo $dados['cartuchoCor']==1 ? "selected" : ""; ?>>Colorido</option>
                                    <option value="2" <?php echo $dados['cartuchoCor']==2 ? "selected" : ""; ?>>Amarelo</option>
                                    <option value="3" <?php echo $dados['cartuchoCor']==3 ? "selected" : ""; ?>>Ciano</option>
                                    <option value="4" <?php echo $dados['cartuchoCor']==4 ? "selected" : ""; ?>>Magenta</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Impressora</th>
                            <td>
                            <select class="form-control" name="impressora">
                                    <option value="0" <?php echo $dados['cartuchoImpressora']==0 ? "selected" : ""; ?>>Não</option>
                                    <option value="1" <?php echo $dados['cartuchoImpressora']==1 ? "selected" : ""; ?>>Sim</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Observações</th>
                            <td colspan="3"><input class="form-control" type="text" name="observacoes" value="<?php echo($dados['cartuchoObservacoes']); ?>"></td>
                        </tr>
                        <tr>
                        <th scope="row">Data de Saída</th>
                            <td colspan="3"><input type="date" class="form-control" name="data_out" value="<?php $date = date_create($dados['cartuchoData_out']);
                            if ($dados['cartuchoData_out']!="0000-00-00") {
                                #echo date_format($date, 'd/m/Y');
                                echo $dados['cartuchoData_out'];
                            } else {
                                echo("");
                                }
                        ?>"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        <br>
        <br>
        <select class="form-control col-3" name="situacao">
            <option value="0" <?php echo $dados['cartuchoSituacao']==0 ? "selected" : ""; ?>>Carregando</option>
            <option value="1" <?php echo $dados['cartuchoSituacao']==1 ? "selected" : ""; ?>>Finalizado</option>
            <option value="2" <?php echo $dados['cartuchoSituacao']==2 ? "selected" : ""; ?>>Entupido</option>
            <option value="3" <?php echo $dados['cartuchoSituacao']==3 ? "selected" : ""; ?>>Queimado</option>
        </select>
        <?php } ?>
        <br>
        <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
        <a href="cartuchos" class="btn btn-info">Voltar</a>
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
