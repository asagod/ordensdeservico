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
    <?php require ("conexao.php");?>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link btn btn-light" href="cartuchos">Cartuchos<span class="sr-only">(Página atual)</span></a>
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
        <h2>CARTUCHOS</h2>
        <p class="lead">Preencha os dados do cliente e os cartuchos!</p>
      </div>
      <div class="modal fade" id="modal-cliente" tabindex="-1" role="dialog" aria-labelledby="clienteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="clienteLabel">Novo Cliente</h5>
                            <form action="cadastro-cliente" method="POST">
                              <div class="modal-body">
                                  <div class="form-group">
                                      <label for="nome" class="col-form-label">Nome:</label>
                                      <input type="text" class="form-control cliente" id="nome" name="nome">
                                  </div>
                                  <div class="form-group">
                                      <label for="telefone2" class="col-form-label">Telefone (Fixo):</label>
                                      <input type="text" class="form-control cliente" id="telefone2" name="telefone2">
                                  </div>
                                  <div class="form-group">
                                      <label for="telefone" class="col-form-label">Telefone (Celular):</label>
                                      <input type="text" class="form-control cliente" id="telefone" name="telefone">
                                  </div>
                                  <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input cliente" id="whatsapp" name="whatsapp">
                                      <label class="custom-control-label" for="whatsapp">Whatsapp</label>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                  <button type="submit" class="btn btn-primary">Cadastrar</button>
                              </div>
                              </form>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
      <div class="row">
        <div class="col-md-12 order-md-1">
        <div class="mb-2">
            <h4 class="mb-2">Cliente</h4>
            <form action="cadastro-cartuchos.php" method="POST">
                <div class="input-group mb-3">
                <input list="cliente" class="custom-select d-block w-75" name="cliente_id">
                <datalist id="cliente" required>
                  <?php $consulta = mysqli_query($conexao,"SELECT * from cliente ORDER by id DESC");
                        $count = mysqli_num_rows($consulta);
                        while ($dados = mysqli_fetch_array($consulta)){
                          ?>
                  <option value="<?php echo $dados['id']; ?>"><?php echo $dados['nome']; ?></option>
                  <?php } ?>
                </datalist>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#modal-cliente" data-whatever="cliente">Cadastrar</button>
                    </div>
                </div>
            </div>
          <h4 class="mb-2">Equipamento</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-2">
                <label for="marca">Marca</label>
                <select class="form-control" id="marca" name="marca"  required>
                <option value="1">HP</option>
                <option value="2">Canon</option>
                <option value="3">Epson</option>
                <option value="4">Outra</option>
                </select>
                <div class="invalid-feedback">
                  É obrigatório inserir uma marca de cartucho.
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <label for="cor">Cor</label>
                <select class="form-control" id="cor" name="cor"  required>
                <option value="1">Preto</option>
                <option value="2">Colorido</option>
                <option disabled>--------</option>
                <option value="3">Amarelo</option>
                <option value="4">Ciano</option>
                <option value="5">Magenta</option>
                </select>
                <div class="invalid-feedback">
                  É obrigatório selecionar uma cor de cartucho.
                </div>
              </div>
            </div>
            <div class="mb-2">
            <div class="row">
              <div class="col-md-4 mb-2">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo">
              </div>
              <div class="col-md-4 mb-2">
                <label for="observacoes">Observações</label>
                <input type="text" class="form-control" id="observacoes" name="observacoes">
              </div>
              <div class="col-md-4 mb-2">
              <label for="impressora">Impressora</label>
              <select class="form-control" id="impressora" name="impressora"  required>
                <option value="0">Não</option>
                <option value="1">Sim</option>
                </select>
              </div>
            </div>
            </div>
            <br>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Cadastrar</button>
        </form>
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
