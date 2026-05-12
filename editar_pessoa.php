<?php
    include 'conecta.php';
    $id = $_POST['id']; 
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $celular = $_POST['celular'];
    $sql = "UPDATE pessoas SET nome = :nome, cpf = :cpf, celular = :celular WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $stmt->bindParam(':celular', $celular, PDO::PARAM_STR);
    $stmt->execute();
    header("Location: aula_admin.php"); 
    exit;
?>