<?php
session_start();
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $celular = $_POST['celular'];
    try {
        $sqlCheck = "SELECT COUNT(*) FROM pessoas WHERE cpf = :cpf";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':cpf', $cpf);
        $stmtCheck->execute();
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>
                    alert('Pessoa já existe em nosso banco de dados!');
                    history.back();
                  </script>";
        }
        else {
            $sqlInsert = "INSERT INTO pessoas (nome, cpf, celular)
                          VALUES (:nome, :cpf, :celular)";
        
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':nome', $nome);
            $stmtInsert->bindParam(':cpf', $cpf);
            $stmtInsert->bindParam(':celular', $celular);
            if ($stmtInsert->execute()) {
               if ($tipo == "admin") {
                echo "<script>
                           alert('Pessoa cadastrada com sucesso!');
                           window.location.href ='aula_admin.php';
                         </script>";
               } else {

                   echo "<script>
                           alert('Pessoa cadastrada com sucesso!');
                           window.location.href ='aula_normal.php';
                         </script>";
                   exit();
               }
            } else {
                echo "<script>
                        alert('Erro ao cadastrar pessoa!');
                        history.back();
                      </script>";
            }
        }
    } catch (PDOExcepetion $e) {
       echo "Erro:".$e->getMessage();
    }
}
?>