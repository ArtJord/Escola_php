

async function fetchAlunos() {

    
    const professorId = sessionStorage.getItem("id");
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

       
        const tabelaBody = document.getElementById('alunos-table');
        tabelaBody.innerHTML = '';

        
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



function preencherTela() {
    preencherProfessor();
    fetchAlunos();
}

preencherTela();

async function fetchProfessor() {

    const idProfessor = sessionStorage.getItem("id");  
    const apiUrl = "http://localhost:8000/usuario";  

    try {
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: idProfessor })  
        });

        const data = await response.json();  
        return data;  
    } catch (error) {
        console.error("Erro ao buscar professor:", error);
        return null;  
    }
}

async function preencherProfessor() {
    const data = await fetchProfessor();  

    if (data) {
        
        document.getElementById("nome_professor").textContent = data.nome;
    } else {
        
        document.getElementById("nome_professor").textContent = "Erro ao carregar o nome";
    }
}

    var btnSalvarSenha = document.getElementById("salvarSenhaNova");

     const modalElement = document.getElementById('exampleModalCenter');
     const modal = new bootstrap.Modal(modalElement);

    btnSalvarSenha.addEventListener('click', async function() {
    
    const professor = await fetchProfessor();
    const nomeProfessor = professor.nome;
    const idProfessor = professor.id;
    var senhaAntiga = document.getElementById("senhaAntiga").value;
    var senhaNova = document.getElementById("senhaNova").value;

    console.log(nomeProfessor);
    console.log(senhaAntiga);
    console.log(senhaNova);

    if ((senhaNova === "" || senhaNova.length < 3) && (senhaAntiga === "" || senhaAntiga.length < 3)) {
        
        document.getElementById("erroSenha").textContent = "Preencha os campos corretamente";
    } else {   

    
    fetch('http://localhost:8000/login', { 
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nome: nomeProfessor, senha: senhaAntiga })
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Falha na autenticação');
        }
        return response.json();
      })
      .then(data => {
        
        if (data.user_id) {
           
            fetch('http://localhost:8000/atualizar', { 
                method: 'PUT',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: idProfessor, nome: nomeProfessor, senha: senhaNova })
              })
              .then(response => {
                if (!response.ok) {
                  throw new Error('Falha ao atualizar a senha');
                }
                return response.json();  
              })
              .then(updateData => {
                
                console.log('Senha atualizada com sucesso', updateData);
                document.getElementById("erroSenha").textContent = "Senha atualizada com sucesso!";

                
                modal.hide();
              })
              .catch(error => {
                console.error('Erro ao atualizar a senha:', error);
                document.getElementById("erroSenha").textContent = "Erro ao atualizar a senha.";
              });

        } else {
          
          document.getElementById("erroSenha").textContent = "Senha atual incorreta";
        }
      })
      .catch(error => {
        console.error('Erro:', error);
        document.getElementById("erroSenha").textContent = "Senha atual incorreta";
      });
    }

});


   

   
    

  




