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
          novaLinha.id = `aluno-${aluno.id}`;
          
          
          const primeiraNota = aluno.primeira_nota || 0.0;
          const segundaNota = aluno.segunda_nota || 0.0;

          
          const mediaFinal = calcularMedia(primeiraNota, segundaNota);

          novaLinha.innerHTML = `
              <td>${aluno.id}</td>
              <td class="editable" data-field="nome">${aluno.nome}</td>
              <td class="editable" data-field="data_nasc">${aluno.data_nasc}</td>
              <td class="editable" data-field="matricula">${aluno.matricula}</td>
              <!-- Editáveis: Notas -->
              <td class="editable" data-field="primeira_nota">${primeiraNota.toFixed(1)}</td>
              <td class="editable" data-field="segunda_nota">${segundaNota.toFixed(1)}</td>
              <!-- Média Final -->
              <td id="media-${aluno.id}">${mediaFinal.toFixed(1)}</td>
              <td>
                  <button class="btn btn-success btn-sm edit-btn">Editar</button>
                  <button class="btn btn-primary btn-sm save-btn" style="display:none;">Salvar</button>
                  <form action="#" method="POST" class="d-inline">
                      <button type="submit" name="delete_aluno" value="${aluno.id}" class="btn btn-danger btn-sm">Excluir</button>
                  </form>
              </td>
          `;
          tabelaBody.appendChild(novaLinha);

          
          novaLinha.querySelector('.edit-btn').addEventListener('click', () => handleEdit(aluno.id));
          novaLinha.querySelector('.save-btn').addEventListener('click', () => handleSave(aluno.id));
      });
  } catch (error) {
      console.error('Erro ao buscar alunos:', error);
  }
}



function calcularMedia(primeira_nota, segunda_nota) {
  if (primeira_nota && segunda_nota) {
    return (parseFloat(primeira_nota) + parseFloat(segunda_nota)) / 2;
  }
  return 0; 
}

function handleEdit(alunoId) {
  const row = document.getElementById(`aluno-${alunoId}`);
  const cells = row.querySelectorAll('.editable');

  
  cells.forEach(cell => {
      const field = cell.dataset.field;
      const currentValue = cell.textContent;

      
      if (field === 'primeira_nota' || field === 'segunda_nota') {
          cell.innerHTML = `<input type="number" value="${currentValue}" data-field="${field}" class="form-control" step="0.1" min="0" max="10">`;
      } else {
          
          cell.innerHTML = `<input type="text" value="${currentValue}" data-field="${field}" class="form-control">`;
      }
  });

  
  row.querySelector('.edit-btn').style.display = 'none';
  row.querySelector('.save-btn').style.display = 'inline-block';
}

async function handleSave(alunoId) {
  const row = document.getElementById(`aluno-${alunoId}`);
  const inputs = row.querySelectorAll('input');

  
  const updatedData = {};
  
  
  inputs.forEach(input => {
      updatedData[input.dataset.field] = input.value;
  });

  
  updatedData.id = alunoId;

  
  const apiUrl = `http://localhost:8000/aluno/atualizar/${alunoId}`; 
  try {
      const response = await fetch(apiUrl, {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify(updatedData)  
      });

      if (response.ok) {
          
          inputs.forEach(input => {
              const cell = input.closest('td');
              cell.textContent = input.value; 
          });

         
          const primeiraNota = parseFloat(updatedData.primeira_nota);
          const segundaNota = parseFloat(updatedData.segunda_nota);
          const mediaFinal = calcularMedia(primeiraNota, segundaNota);
          
          
          const mediaCell = row.querySelector(`#media-${alunoId}`);
          mediaCell.textContent = mediaFinal.toFixed(1);

          
          row.querySelector('.edit-btn').style.display = 'inline-block';
          row.querySelector('.save-btn').style.display = 'none';
      } else {
          console.error('Falha ao salvar alterações');
      }
  } catch (error) {
      console.error('Erro ao salvar alterações:', error);
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


   

   
    

  




