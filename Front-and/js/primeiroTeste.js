
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
    const botao = document.getElementById('save');

botao.addEventListener('click', function() {
    
  window.location.href = 'http://127.0.0.1:5500/Front-and/views/TelaInicio.html';
});
});




//Tela de login

const loginForm = document.getElementById('id_login');

var btn_login = document.querySelector("#btn_login");

    

loginForm.addEventListener('submit', (event) => {
  event.preventDefault();

  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  fetch('http://localhost:8000/login', { 
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },

    body: JSON.stringify({ nome: username, senha: password })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Falha na autenticação');
    }
    return response.json();
  })
  .then(data => {
    
    if (data.user_id) {

      
      sessionStorage.setItem("id", data.user_id);
      //let id = sessionStorage.getItem("id");


      window.location.href = 'http://127.0.0.1:5500/Front-and/views/TelaInicio.html'; 
    } else {
      
      alert('Usuário ou senha inválidos');
    }
  })
  .catch(error => {
    console.error('Erro:', error);
    alert('Ocorreu um erro durante o login. Tente novamente mais tarde.');
  });
});






/*const botao = document.getElementById('save');

botao.addEventListener('click', function() {
    
  window.location.href = 'http://127.0.0.1:5500/Front-and/views/TelaInicio.html';
});
*/


