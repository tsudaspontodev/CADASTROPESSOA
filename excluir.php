<?php
   include'conecta.php';
   if(isset($_GET['id']) && !empty($_GET['id'])){
     $id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
     try {
        $sql ="DELETE FROM pessoas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            header("Location: aula_admin.php?msg=Sucesso");
            exit;
        
        }
        else{
            header("Location: aula_admin.php?msg=Não conseghui apagar");
        }
     } catch (PDOExcepetion $e) {
        die("Erro:".$e->getMessage());
     }
   }
   else{
    header("Location: aula/admin.php");
            exit;
   }
?>