// funcoes.js

function validarNome() {
  const nome = document.getElementById("nome").value.trim();
  const mensagem = document.getElementById("mensagem-nome");

  if (nome.split(" ").length < 2) {
    mensagem.textContent = "Por favor, insira seu nome completo.";
    mensagem.style.color = "red";
    return false;
  }

  mensagem.textContent = "";
  return true;
}

document.getElementById("nome").addEventListener("input", validarNome);

function validarCPF() {
  const cpf = document.getElementById("cpf").value;
  const mensagem = document.getElementById("mensagem-cpf");

  // Remove caracteres não numéricos
  const cpfLimpo = cpf.replace(/\D/g, "");

  // Verifica se o CPF tem 11 dígitos
  if (cpfLimpo.length !== 11 || /^(\d)\1{10}$/.test(cpfLimpo)) {
    mensagem.textContent = "CPF inválido. Verifique e tente novamente.";
    mensagem.style.color = "red";
    return false;
  }

  // Validação dos dígitos verificadores
  let soma = 0;
  let resto;

  // Primeiro dígito verificador
  for (let i = 1; i <= 9; i++) {
    soma += parseInt(cpfLimpo.substring(i - 1, i)) * (11 - i);
  }
  resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  if (resto !== parseInt(cpfLimpo.substring(9, 10))) {
    mensagem.textContent = "CPF inválido. Verifique e tente novamente.";
    mensagem.style.color = "red";
    return false;
  }

  // Segundo dígito verificador
  soma = 0;
  for (let i = 1; i <= 10; i++) {
    soma += parseInt(cpfLimpo.substring(i - 1, i)) * (12 - i);
  }
  resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  if (resto !== parseInt(cpfLimpo.substring(10, 11))) {
    mensagem.textContent = "CPF inválido. Verifique e tente novamente.";
    mensagem.style.color = "red";
    return false;
  }

  mensagem.textContent = "";
  return true;
}

function validarSenha() {
  const senha = document.getElementById("senha").value;
  const mensagem = document.getElementById("mensagem-senha");
  let regex =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]).{8,16}$/;

  if (senha.length < 8) {
    mensagem.textContent =
      "A senha deve ter entre 8 e 16 caracteres, 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial.";
    mensagem.style.color = "red";
    return false;
  }

  if (!regex.test(senha)) {
    mensagem.textContent =
      "A senha deve ter entre 8 e 16 caracteres, 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial.";
    mensagem.style.color = "red";
    return false;
  }

  mensagem.textContent = "";
  return true;
}

document.getElementById("senha").addEventListener("input", validarSenha);

function calcularIdade(dataNascimento) {
  const hoje = new Date();
  const nascimento = new Date(dataNascimento);
  let idade = hoje.getFullYear() - nascimento.getFullYear();
  const mes = hoje.getMonth() - nascimento.getMonth();
  if (mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())) {
    idade--;
  }
  return idade;
}

function validarIdade() {
  const dataNascimento = document.getElementById("data_nascimento").value;
  const mensagem = document.getElementById("mensagem-nascimento");

  if (!dataNascimento) {
    return false; // Se a data estiver vazia, a validação já falhará no HTML
  }

  const idade = calcularIdade(dataNascimento);
  if (idade < 13) {
    mensagem.textContent =
      "Você deve ter pelo menos 13 anos para criar uma conta.";
    mensagem.style.color = "red";
    return false;
  }

  mensagem.textContent = "";
  return true;
}

document
  .getElementById("data_nascimento")
  .addEventListener("change", validarIdade);

// Função para permitir apenas números nos campos
function permitirSomenteNumeros(event) {
  event.target.value = event.target.value.replace(/\D/g, ""); // Remove não dígitos
}

// Associar a função de validação aos campos CPF e Telefone
document
  .getElementById("cpf")
  .addEventListener("input", permitirSomenteNumeros);
document
  .getElementById("telefone")
  .addEventListener("input", permitirSomenteNumeros);

// Função para buscar o endereço via CEP (integração com viacep.php)
function buscarEndereco() {
  const cep = document.getElementById("cep").value.replace(/\D/g, "");
  if (cep.length !== 8) {
    alert("CEP inválido!");
    return;
  }

  fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then((response) => response.json())
    .then((data) => {
      if (data.erro) {
        alert("CEP não encontrado!");
        return;
      }
      document.getElementById("endereco").value = data.logradouro;
      document.getElementById("bairro").value = data.bairro;
      document.getElementById("cidade").value = data.localidade;
      document.getElementById("estado").value = data.uf;
    })
    .catch((error) => console.error("Erro ao buscar endereço:", error));
}
