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
                                    <th>AÇÕES</th>
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
                            echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modalEditar' data-id='$id'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
</svg></a> | <a href='excluir.php?id=$id'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
  <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
</svg></a></td>echo </tr>";
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
<!-- Janela modal - editar pessoas-->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg>&nbsp; &nbsp; <h5 class="modal-title" id="modalEditar">EDIÇÃO DE PESSOAS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
           <div class="modal-body">
        <form action="editar_pessoa.php" method="POST">
            <input type="hidden" id="edit_id" name="id" value="">
                <label class="form-label">NOME</label>
                <input type="text" name="nome" class="form-control" id="edit_nome" required/>
                <br/> 
                <label class="form-label">CPF</label>
                <input type="number" name="cpf" class="form-control" id="edit_cpf" required/>
                <br/> 
                <label class="form-label">CELULAR</label>
                <input type="number" name="celular" class="form-control" id="edit_celular" required/>
                <br/> 
                <button type="submit" class="btn btn-outline-success">ATUALIZAR </button>    
                </form>
           </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    document.getElementById('modalEditar').addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-id');
        // Aqui você pode usar o ID para buscar os dados da pessoa e preencher o formulário de edição
        fetch('buscar_pessoa.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                // Preencha os campos do formulário com os dados retornados
                document.getElementById('edit_id').value = data.id; // Supondo que você tenha um campo oculto para o ID
                document.getElementById('edit_nome').value = data.nome;
                document.getElementById('edit_cpf').value = data.cpf;
                document.getElementById('edit_celular').value = data.celular;
                
                // document.querySelector('#modalEditar input[name="nome"]').value = data.nome;
                // document.querySelector('#modalEditar input[name="cpf"]').value = data.cpf;
                // document.querySelector('#modalEditar input[name="celular"]').value = data.celular;
            });
    });
</script>

</body>
</html>