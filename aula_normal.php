<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header('Location: index.php?status=erro&msg=Acesso Negado');
    exit();
}

$nome = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="Imagens/teacher.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Aula - PHP</title>

    <style>
        body {
            background-color:white
        }

        .header {
            float: right;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="container-fluid" style="background-color:#DCDCDC; text-align:center; position:relative;">
    <img src="Imagens/Gemini_Generated.png" alt="Logo">

    <div class="header" style="position:absolute; top:10px; right:10px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-person-gear" viewBox="0 0 16 16">
            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
        </svg>

        <b><?= htmlspecialchars($nome) ?></b> |
        <a href="sair.php" style="color:black; text-decoration:none; font-weight:bold;">SAIR</a>
    </div>
</div>

<hr>

<!-- BOTÃO -->
<div class="text-center my-3">
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        CADASTRAR PESSOA
    </button>
</div>

<!-- TABELA -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

            <div class="card shadow border-2">
                <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg>

                    <b>PESSOAS CADASTRADAS</b>
                </div>

                <div class="card-body">

                    <?php
                    include 'conecta.php';

                    $sql = "SELECT * FROM pessoas ORDER BY nome";
                    $consulta = $pdo->query($sql);
                    $listapessoas = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    if (count($listapessoas) > 0) {

                        echo "<table class='table table-hover align-middle'>";
                        echo "<thead class='table-light'>
                                <tr>
                                    <th>ID</th>
                                    <th>NOME</th>
                                    <th>CPF</th>
                                    <th>CELULAR</th>
                                    
                                </tr>
                              </thead>";

                        echo "<tbody>";

                        foreach ($listapessoas as $item) {
                            $id = $item['id'];
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['cpf']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['celular']) . "</td>";
                           echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";

                    } else {
                        echo "<p class='text-danger'><b>NÃO EXISTEM PESSOAS CADASTRADAS NO MOMENTO!</b></p>";
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg>&nbsp; &nbsp; <h5 class="modal-title">CADASTRO DE PESSOAS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="cadastro_pessoa.php" method="POST">
                <label class="form-label">NOME</label>
                <input type="text" name="nome" class="form-control" required/>
                <br/> 
                <label class="form-label">CPF</label>
                <input type="number" name="cpf" class="form-control" required/>
                <br/> 
                <label class="form-label">CELULAR</label>
                <input type="number" name="celular" class="form-control" required/>
                <br/> 
                <button type="submit" class="btn btn-outline-success">CADASTRAR </button>    
                </form>
            </div>
            <div class="modal-footer">  
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">FECHAR</button>
                
            </div>

        </div>

    </div>
</div>


</body>
</html>