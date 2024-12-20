var body = document.querySelector("body");

const form = document.getElementById('formAluno');
var btn_user = document.querySelector("#logAluno"); 

form.addEventListener('submit', (event) => {
    event.preventDefault();

    let id = sessionStorage.getItem("id"); 

    
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

   
    
    const jsonData = {
        ...data,  
        professor_id: id
       
    
    };

    fetch('http://localhost:8000/aluno/registrar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jsonData)  
    })
    .then(response => {
        if (response.ok) {
            alert('Sucesso!');
        } else {
            response.json().then(data => {
                alert(data.message);
            });
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('erro');
    });

    
    const botao = document.getElementById('save');
    botao.addEventListener('click', function() {
        window.location.href = 'http://127.0.0.1:5500/Front-and/views/TelaInicio.html';
    });
});