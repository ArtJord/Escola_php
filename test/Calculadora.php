<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/controllers/AlunoController.php';

use PHPUnit\Framework\TestCase;

class AlunoTest extends TestCase
{
    private $connMock;
    private $aluno;

    protected function setUp(): void
    {
        // Mock do PDO
        $this->connMock = $this->createMock(PDO::class);

        // Instanciando o objeto Aluno com o mock do PDO
        $this->aluno = new Aluno($this->connMock);
    }

    public function testCreateAluno()
    {
        // Dados do aluno
        $nome = 'João Silva';
        $matricula = '123456';
        $data_nasc = '2000-01-01';
        $professor_id = 1;

        // Preparar o mock para o método prepare() do PDO
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);
        
        // O mock de conn deve retornar o stmtMock quando prepare() for chamado
        $this->connMock->method('prepare')->willReturn($stmtMock);

        // Executar o método create()
        $result = $this->aluno->create($nome, $matricula, $data_nasc, $professor_id);

        // Verificar se o método execute() foi chamado
        $this->assertTrue($result);
    }

    public function testUpdateAluno()
    {
        // Dados de atualização do aluno
        $id = 1;
        $nome = 'João Silva Atualizado';
        $matricula = '123457';
        $data_nasc = '2000-01-02';
        $primeira_nota = 8.0;
        $segunda_nota = 7.5;

        // Mock do stmt
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);

        // O mock de conn deve retornar o stmtMock quando prepare() for chamado
        $this->connMock->method('prepare')->willReturn($stmtMock);

        // Executar o método update()
        $result = $this->aluno->update($id, $nome, $matricula, $data_nasc, $primeira_nota, $segunda_nota);

        // Verificar se o método execute() foi chamado e o resultado é verdadeiro
        $this->assertTrue($result);
    }

    public function testDeleteAluno()
    {
        $id = 1;

        // Mock do stmt
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);

        // O mock de conn deve retornar o stmtMock quando prepare() for chamado
        $this->connMock->method('prepare')->willReturn($stmtMock);

        // Executar o método delete()
        $result = $this->aluno->delete($id);

        // Verificar se o método execute() foi chamado e o resultado é verdadeiro
        $this->assertTrue($result);
    }

    public function testGetAllByUserId()
    {
        $userId = 1;

        // Dados fictícios retornados pelo banco de dados
        $alunos = [
            [
                'id' => 1,
                'nome' => 'João Silva',
                'matricula' => '123456',
                'data_nasc' => '2000-01-01',
                'professor_id' => 1
            ],
            [
                'id' => 2,
                'nome' => 'Maria Souza',
                'matricula' => '123457',
                'data_nasc' => '1999-01-01',
                'professor_id' => 1
            ]
        ];

        // Mock do stmt
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute');
        $stmtMock->method('fetchAll')->willReturn($alunos);

        // O mock de conn deve retornar o stmtMock quando prepare() for chamado
        $this->connMock->method('prepare')->willReturn($stmtMock);

        // Executar o método getAllByUserId()
        $result = $this->aluno->getAllByUserId($userId);

        // Verificar se o resultado é o esperado
        $this->assertCount(2, $result);
        $this->assertEquals('João Silva', $result[0]['nome']);
        $this->assertEquals('Maria Souza', $result[1]['nome']);
    }
}
