<?php

define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '1234');
define('DB', 'escola');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Não foi possivel conectar');


$sql = "SELECT * FROM alunos";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Nome: " . $row["nome"]. "<br>";
  }
} else {
  echo "0 resultados";
}

$conexao->close();


?>