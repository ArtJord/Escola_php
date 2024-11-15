
/*
var body = document.querySelector("body");

const form = document.getElementById('Login');

var btn_user = document.querySelector("#btn_login");

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    fetch('http://localhost:8000/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            alert('Professor logado com sucesso!');
        } else {
            response.json().then(data => {
                alert(data.message);
            });
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Ocorreu ao logar.');
    });
});

const botao = document.getElementById('btn_login');

botao.addEventListener('click', function() {
 window.location.href = 'http://127.0.0.1:5500/Front-and/views/TelaInicio.html';
});
*/
