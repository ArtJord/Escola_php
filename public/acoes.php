<?php 

session_start();
require 'db.php';

    if(isset($POST['create_aluno'])){
        $nome = mysqli_real_escape_string($conexao, trim($POST['nome']));
        $matricula = mysqli_real_escape_string($conexao, trim($POST['matricula']));
        $data_nasc = mysqli_real_escape_string($conexao, trim($POST['data_nasc']));

        $sql = "INSERT INTO alunos (nome, matricula, data_nasc) VALUES ('$nome', '$matricula', '$data_nasc')";

        echo $sql;exit;

        mysqli_query($conexao, $sql);
        
    }


?>