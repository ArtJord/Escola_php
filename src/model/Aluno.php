<?php

require_once __DIR__ . '/../config/db.php';

class Aluno{
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($nome, $matricula, $data_nasc, $professor_id) {
        $query = "INSERT INTO aluno (nome, matricula, data_nasc, professor_id) 
                  VALUES (:nome, :matricula, :data_nasc, :professor_id)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':data_nasc', $data_nasc);
        $stmt->bindParam(':professor_id', $professor_id);
       
        
    
        return $stmt->execute();
    }
    

    public function update($id, $nome, $matricula, $data_nasc) {
        $query = "UPDATE aluno 
                  SET nome = :nome, matricula = :matricula, data_nasc = :data_nasc
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':data_nasc', $data_nasc);
        
    
        return $stmt->execute();
    }
    

    public function delete($id) {
        $query = "DELETE FROM aluno WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':id', $id);
    
        return $stmt->execute();
    }
    

    public function getAllByUserId($userId) {
        $query = "SELECT * FROM livro WHERE professor_id = :professor_id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':professor_id', $userId);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateNotas($id, $primeira_nota, $segunda_nota) {
        $query = "UPDATE aluno
                  SET primeira_nota = :nome, segunda_nota = :segunda_nota
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':primeira_nota', $primeira_nota);
        $stmt->bindParam(':segunda_nota', $segunda_nota);
        
        return $stmt->execute();
    }


    
}