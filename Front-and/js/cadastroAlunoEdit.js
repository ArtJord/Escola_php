var form = document.getElementById('formAluno');

form.addEventListener('submit', (event) => {
    event.preventDefault();

    let alunoId = sessionStorage.getItem("id");

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    data.id = alunoId;

    fetch('http://localhost:8000/atualizar', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(errorData => {
                throw new Error(errorData.message);
            });
        }
        return response.json();
    })
    .then(data => {
        alert('Aluno atualizado com sucesso!');
        window.location.href = 'http://127.0.0.1:5500/Front-and/views/TelaInicio.html';
    })
    .catch(error => {
        console.error('Erro ao atualizar aluno:', error);
        alert('Ocorreu um erro ao atualizar o aluno. Verifique os dados e tente novamente.');
    });
});