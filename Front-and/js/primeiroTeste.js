// script.js
//script de interação inicial

var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");


var body = document.querySelector("body");


btnSignin.addEventListener("click", function () {
   body.className = "sign-in-js"; 
});

btnSignup.addEventListener("click", function () {
    body.className = "sign-up-js";
})

//


var body = document.querySelector("body");

const form = document.getElementById('LoginForm');

var btn_user = document.querySelector("#save");

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    fetch('http://localhost:8000/registrar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            alert('Professor cadastrado com sucesso!');
        } else {
            response.json().then(data => {
                alert(data.message);
            });
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao cadastrar o professor.');
    });
});





const botao = document.getElementById('save');

botao.addEventListener('click', function() {
  window.location.href = 'http://127.0.0.1:5500/Front-and/views/TelaInicio.html';
});



