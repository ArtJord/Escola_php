<?php


require_once __DIR__ . '/../model/Aluno.php';

class AlunoController
{
    private $aluno;

    public function __construct($db)
    {
        $this->aluno = new Aluno($db);
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        
        if (isset($data->nome) && isset($data->matricula) && isset($data->data_nasc)) {
            try {
                $resultado = $this->aluno->create($data->nome, $data->matricula, $data->data_nasc, $data->professor_id ?? null);
                http_response_code(200);
                echo json_encode(["message" => "Aluno cadastrado com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao cadastrar Aluno."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"));
    
        
        if (isset($data->id) && isset($data->nome) && isset($data->matricula) && isset($data->data_nasc) && isset($data->primeira_nota) && isset($data->segunda_nota)) {
            try {
                
                $primeira_nota = floatval($data->primeira_nota); 
                $segunda_nota = floatval($data->segunda_nota); 
    
               
                $result = $this->aluno->update($data->id, $data->nome, $data->matricula, $data->data_nasc, $primeira_nota, $segunda_nota);
    
                if ($result) {
                    http_response_code(200);
                    echo json_encode(["message" => "Aluno atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar Aluno."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar o Aluno."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
    

    public function delete()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->id)) {
            try {
                $result = $this->aluno->delete($data->id);
                if ($result) {
                    http_response_code(200);
                    echo json_encode(["message" => "Aluno deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar Aluno."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar Aluno."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function getAllByUserId()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->professor_id)) {
            try {
                $result = $this->aluno->getAllByUserId($data->professor_id);
                if ($result) {
                    http_response_code(200);
                    echo json_encode($result);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Nenhum aluno encontrado para este professor."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar Aluno."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

}