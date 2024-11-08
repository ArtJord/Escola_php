

<?php 

session_start();
require 'db.php';

    if(isset($POST['create_aluno'])){
        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $matricula = mysqli_real_escape_string($conexao, trim($_POST['matricula']));
        $data_nasc = mysqli_real_escape_string($conexao, trim($_POST['data_nasc']));

        $sql = "INSERT INTO alunos (nome, matricula, data_nasc) VALUES ('$nome', '$matricula', '$data_nasc')";

        mysqli_query($conexao, $sql);

        if(mysqli_affected_rows($conexao) > 0){
            $_SESSION['mensagem'] = 'Usuario criado com sucesso';
            header('Location: index.php');
            exit;
        }else{
            $_SESSION['mensagem'] = 'Usuario não foi criado';
            header('Location: index.php');
            exit;

        }
        
    }


?>