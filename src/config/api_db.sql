CREATE TABLE Escola;

CREATE TABLE professor (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE aluno (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    matricula VARCHAR(100) NOT NULL,
    data_nasc DATE NOT NULL,
    professor_id INTEGER NOT NULL,
    primeira_nota DECIMAL(3,1),  
    segunda_nota DECIMAL(3,1),
    
);