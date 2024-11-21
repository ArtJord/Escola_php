<?php 

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/controllers/AlunoController.php';

use PHPUnit\Framework\TestCase;

class AlunoTest extends TestCase
{
    private $conn;
    private $aluno;

    protected function setUp(): void
    {
        
        $this->conn = new PDO('pgsql:host=localhost;dbname=Escola', 'postgres', '123'); 
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->aluno = new Aluno($this->conn);
    }

    public function testCreateAluno()
{
    $nome = "Aluno A";
    $matricula = "123456";
    $data_nasc = "2000-01-01";
    $professor_id = 1; 

    
    $result = $this->aluno->create($nome, $matricula, $data_nasc, $professor_id);

    $this->assertTrue($result); 

    $stmt = $this->conn->query("SELECT * FROM aluno WHERE matricula = '$matricula'");
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->assertNotEmpty($aluno); 
    $this->assertEquals($nome, $aluno['nome']); 
    $this->assertEquals($professor_id, $aluno['professor_id']); 
}

    public function testUpdateAluno()
    {
        $professor_id = 1;
        $this->aluno->create("Aluno A", "123456", "2000-01-01", $professor_id);
        
        $id = $this->conn->lastInsertId();
    
        $nome = "Aluno Atualizado";
        $matricula = "123456";
        $data_nasc = "2000-01-01";
        $primeira_nota = 6.0;
        $segunda_nota = 8.0;
    
        $result = $this->aluno->update($id, $nome, $matricula, $data_nasc, $primeira_nota, $segunda_nota);
    
        $this->assertTrue($result);
    
        // Verifica se os dados foram atualizados no banco
        $stmt = $this->conn->query("SELECT * FROM aluno WHERE id = $id");
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->assertEquals($nome, $aluno['nome']);
        $this->assertEquals($primeira_nota, $aluno['primeira_nota']);
        $this->assertEquals($segunda_nota, $aluno['segunda_nota']);
    }
    
    public function testDeleteAluno()
{
    $professor_id = 1;
    $this->aluno->create("Aluno A", "123456", "2000-01-01", $professor_id);
    
    $id = $this->conn->lastInsertId();

    // Apaga o aluno
    $result = $this->aluno->delete($id);

    $this->assertTrue($result);

    // Verifica se o aluno foi apagado
    $stmt = $this->conn->query("SELECT * FROM aluno WHERE id = $id");
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->assertFalse($aluno); 
}

}
