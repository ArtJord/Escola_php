<?php

require_once __DIR__ . '/../config/db.php';

class Aluno{
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($nome, $matricula, $data_nasc, $professor_id = null) {
        $query = "INSERT INTO aluno (nome, matricula, data_nasc, professor_id) 
                  VALUES (:nome, :matricula, :data_nasc, :professor_id)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':data_nasc', $data_nasc);
        $stmt->bindParam(':professor_id', $professor_id);
       
        
    
        return $stmt->execute();
    }
    
 
    public function update($id, $nome, $matricula, $data_nasc, $primeira_nota, $segunda_nota) {

        
        $primeira_nota = filter_var($primeira_nota, FILTER_VALIDATE_FLOAT);
        $segunda_nota = filter_var($segunda_nota, FILTER_VALIDATE_FLOAT);
    
        
        if ($primeira_nota === false) {
            $primeira_nota = 0.0;
        }
    
        if ($segunda_nota === false) {
            $segunda_nota = 0.0;
        }
    
       
        $primeira_nota = isset($primeira_nota) && $primeira_nota !== '' ? $primeira_nota : 0.0;
        $segunda_nota = isset($segunda_nota) && $segunda_nota !== '' ? $segunda_nota : 0.0;

        error_log("primeira_nota: $primeira_nota, segunda_nota: $segunda_nota");
    
        
        $query = "UPDATE aluno 
                  SET nome = :nome, matricula = :matricula, data_nasc = :data_nasc, primeira_nota = :primeira_nota, segunda_nota = :segunda_nota
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
    
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':data_nasc', $data_nasc);
        $stmt->bindParam(':primeira_nota', $primeira_nota);
        $stmt->bindParam(':segunda_nota', $segunda_nota);
    
        
        return $stmt->execute();
    }
    
    
    public function delete($id) {
        $query = "DELETE FROM aluno WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':id', $id);
    
        return $stmt->execute();
    }
    

    public function getAllByUserId($userId) {
        $query = "SELECT * FROM aluno WHERE professor_id = :professor_id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':professor_id', $userId);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}