<?php 

class AlunoController {
  private $conexao;

  public function __construct($conexao) {
    $this->conexao = $conexao;
  }

  public function index() {
    $alunos = Aluno::all($this->conexao);
  }
  public function create() {}
}