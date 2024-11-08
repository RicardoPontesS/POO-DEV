<?php
require_once "classes/SessionManager.php";
require_once "classes/Usuario.php";
require_once "classes/Chamado.php";
require_once "classes/SessionManager.php";

SessionManager::validarAcesso();

try {
    $usuario = new Usuario(SessionManager::getEmail());
    $id_usuario = $usuario->getId();

    $result_chamados = Chamado::consultarChamados($id_usuario);
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
    exit();
}
?>


<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="home.php">
        <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class ="navbar-nav">
        <li class ="nav-item">
          <a class ="nav-link" href ="logoff.php">SAIR</a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamados
            </div>
            
            <div class="card-body">
              <?php
                if (mysqli_num_rows($result_chamados) > 0) {
                  // Exibe os chamados do usuário logado
                  while ($chamado = mysqli_fetch_assoc($result_chamados)) {
                    echo '<div class="card mb-3 bg-light">';
                    echo '  <div class="card-body">';
                    echo '    <h5 class="card-title">' . $chamado['titulo'] . '</h5>';
                    echo '    <h6 class="card-subtitle mb-2 text-muted">' . $chamado['categoria'] . '</h6>';
                    echo '    <p class="card-text">' . $chamado['Descricao'] . '</p>';
                    echo '  </div>';
                    echo '</div>';
                  }
                } else {
                  echo '<div class="alert alert-warning">Nenhum chamado encontrado.</div>';
                }
              ?>

              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" href="home.php">Voltar</a>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>

  </body>
</html>
