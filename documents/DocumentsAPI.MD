### **ESCOLA PHP**

**Professor** 

POST - Criar um no professor no DB

URL: http://localhost:8000/registrar

```json
{
  "nome": "Professor ",
  "senha": "Senha123"
  }
```
POST - Login do professor

URL: http://localhost:8000/login

```json
{
    "nome": "Professor",
    "senha": "Senha123"
}
```
PUT - Atualizar dados do professor

URL: http://localhost:8000/atualizar

```json
{
    "id": 1,
    "nome": "Professor atualizado",
    "senha": "SenhaAtualizada"
}
```
DELETE - deletar professor

URL:http://localhost:8000/deletar
```json
{
    "id": 1,
    "nome": "Professor",
    "senha": "Senha"
}
```

### ALUNO
POST - Cadastrar um novo aluno

URL:http://localhost:8000/aluno/registrar
```json
{
    "nome": "Aluno",
    "matricula": "111",
    "data_nasc": "2020-09-09",
    "professor_id": 1
}
```
PUT - Atualizar dados do aluno

URL: http://localhost:8000/aluno/atualizar
```json
{
    "id": 1,
    "nome": "Aluno Atualizado",
    "matricula": "123",
    "data_nasc": "2020-09-09",
    "primeira_nota": 9.0,
    "segunda_nota": 7.0
}
```
DELETE - Deletar aluno

URL: http://localhost:8000/aluno/deletar
```json
{
    "id": 12,
    "nome": "Aluno",
    "matricula": "123",
    "data_nasc": "2020-09-09",
    "primeira_nota": 9.0,
    "segunda_nota": 7.0
}
```





