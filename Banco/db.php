<?php

define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '1234');
define('DB', 'escola');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Não foi possivel conectar');

?>