<?php 

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/controllers/ProfessorController.php';

use PHPUnit\Framework\TestCase;

class ProfessorTest extends TestCase
{
    private $conn;
    private $professor;

    protected function setUp(): void
    {
        
        $this->conn = new PDO('pgsql:host=localhost;dbname=Escola', 'postgres', '123'); 
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->professor = new Professor($this->conn);
    }

    
    public function testCreateProfessor()
    {
        $nome = "Professor A";
        $senha = "senha123";

        $result = $this->professor->create($nome, $senha);

        // Verifica se o professor foi criado com sucesso
        $this->assertTrue($result);

        // Verifica se o professor realmente foi inserido
        $stmt = $this->conn->prepare("SELECT * FROM professor WHERE nome = :nome");
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();

        $professor = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($professor);
        $this->assertEquals($nome, $professor['nome']);
    }

    public function testLoginSuccess()
    {
        $nome = "Professor B";
        $senha = "senha456";
        $this->professor->create($nome, $senha);  

        $result = $this->professor->login($nome, $senha);

        $this->assertNotFalse($result);
    }

    public function testLoginFailure()
    {
        $nome = "Professor C";
        $senha = "senha789";

        // Tenta o login com dados que nao existe
        $result = $this->professor->login($nome, $senha);

        $this->assertFalse($result);
    }

    public function testUpdateProfessor()
    {
        $nome = "Professor D";
        $senha = "senha101";
        $this->professor->create($nome, $senha);  

        $newNome = "Professor D Updated";
        $newSenha = "senha202";

        $id = $this->conn->lastInsertId(); 
        $result = $this->professor->update($id, $newNome, $newSenha);

        // Verifica se a atualização foi bem-sucedida
        $this->assertTrue($result);

        // Verifica se os dados foram atualizados
        $stmt = $this->conn->prepare("SELECT * FROM professor WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $professor = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($newNome, $professor['nome']);
    }

    public function testDeleteProfessor()
    {
        $nome = "Professor E";
        $senha = "senha303";
        $this->professor->create($nome, $senha);

        $id = $this->conn->lastInsertId();

        $result = $this->professor->delete($id);

        // Verifica se a exclusão foi bem-sucedida
        $this->assertTrue($result);

        // Verifica se o professor foi realmente excluído
        $stmt = $this->conn->prepare("SELECT * FROM professor WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $professor = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertFalse($professor);
    }

    public function testUsuarioJaExiste()
    {
        $nome = "Professor F";
        $senha = "senha404";
        $this->professor->create($nome, $senha);

        // Verifica se o nome de usuário já existe
        $result = $this->professor->usuarioJaExiste($nome);

        $this->assertTrue($result);
    }

    public function testUsuarioNaoExiste()
    {
        $nome = "Professor G";

        // Verifica se o nome de usuário não existe
        $result = $this->professor->usuarioJaExiste($nome);

        $this->assertFalse($result);
    } 
}