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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body class="bg-light">
    <?php require ("conexao.php");
    if (isset($_GET['estado'])){
      $variavel=($_GET['estado']);
      $coluna="ordem.situacao";
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
            <li class="nav-item ">
              <a class="nav-link btn btn-light" href="cadastrar">Cadastrar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-light" href="lista">Lista</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link btn btn-light" href="outros">Outros</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="py-5 text-center">
        <h2>NADA AQUI</h2>
        <p class="lead">Esta página ainda não possui conteúdo!</p>
      </div>
    <div class="container">
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
