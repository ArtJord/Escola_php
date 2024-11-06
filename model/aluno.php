<?php

class Aluno {
  public static function all($conexao) {
    $sql = "SELECT * FROM alunos";
    $result = mysqli_query($conexao, $sql);
    $alunos = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $alunos[] = $row;
    }
    return $alunos;
  }
}