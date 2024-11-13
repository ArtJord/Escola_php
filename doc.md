POST - Criar Aluno

Cria um novo aluno no bando de dados

URL:http://localhost:8000/createAluno

"nome": "Teste Aluno",

"matricula": "12345"
"

"data_nac": 2000/12/20"


POST - Login do Professor

Cria um login com nome, email e senha

URL: http://localhost:8000/login

"nome":"Professor João"

"email": "professro@gmail.com"

"senha":"senha123"

GET - Busca aluno por id

Retorna as informações do aluno


http://localhost:8000/alunos

"id": 1


DELETE - Deletar aluno

Deleta o aluno pelo id

http://localhost:8000/aluno

"id": 1


