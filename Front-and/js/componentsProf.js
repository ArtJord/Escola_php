

async function fetchAlunos() {

    //const response = await fetch('http://localhost:8000/aluno');
    //const professorId = await response.json();
    const professorId = 45; 
    const apiUrl = 'http://localhost:8000/aluno'; 

    try {
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ professor_id: professorId })
        });

        const data = await response.json();

        // Limpa a tabela antes de adicionar novos dados
        const tabelaBody = document.getElementById('alunos-table');
        tabelaBody.innerHTML = '';

        // Cria as linhas da tabela com os dados dos alunos
        data.forEach(aluno => {
            const novaLinha = document.createElement('tr');
            novaLinha.innerHTML = `
                <td>${aluno.id}</td>
                <td>${aluno.nome}</td>
                <td>${aluno.data_nasc}</td>
                <td>${aluno.matricula}</td> 
                <td>${aluno.primeira_nota}</td>
                <td>${aluno.segunda_nota}</td>
                <td>${aluno.nota_final}</td>
                 <td>
                    
                    <a href="http://127.0.0.1:5500/Front-and/views/TelaCadastroEdit.html?id=${aluno.id}" class="btn btn-success btn-sm">Editar</a>
                    <form action="#" method="POST" class="d-inline">
                        <button type="submit" name="delete_aluno" value="${aluno.id}" class="btn btn-danger btn-sm">Excluir</button>
                    </form>

                </td>
                `;
            tabelaBody.appendChild(novaLinha);
        });
    } catch (error) {
        console.error('Erro ao buscar alunos:', error);
    }
}

// Chamar a função ao carregar a página
fetchAlunos();








async function buscarEExibirProfessor() {
    const userId = localStorage.getItem('userId');

    if (userId) {
        const apiUrl = `http://localhost:8000/usuario/${userId}`;

        try {
            // Exibir mensagem de carregamento (opcional)
            document.getElementById('nome_professor').textContent = 'Carregando...';

            const response = await fetch(apiUrl);
            const data = await response.json();

            if (data) {
                const idProfessorElement = document.getElementById('id_professor');
                const nomeProfessorElement = document.getElementById('nome_professor');
                

                if (nomeProfessorElement && idProfessorElement) {
                    idProfessorElement.textContent = data.id;
                    nomeProfessorElement.textContent = data.nome;
                } else {
                    console.error('Elementos HTML não encontrados.');
                }
            } else {
                alert('Professor não encontrado.');
            }
        } catch (error) {
            console.error('Erro ao buscar dados do professor:', error);
            alert('Ocorreu um erro ao buscar os dados do professor. Por favor, tente novamente.');
        }
    } else {
        alert('Usuário não logado.');
    }
}



