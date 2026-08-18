<?php include_once 'minha_conta.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/principal.css">
  <title>| Minha Conta</title>
  <style>
    .emai input {
      border: 1.5px solidrgb(163, 163, 163) !important;
      outline: none !important;
    }

    input[type="email"] {
      border: 1px solid #ccc;
      padding: 8px;
      background: #fff;
      color: #222;
      width: 100%;
    }

    input[type="email"]:focus {
      border: 2px solid black;
      outline: none;
    }

    input[type="submit"] {
      width: 100% !important;
    }

    /* Estilos para o modal */
    .modal {
      display: none;
      /* Inicialmente escondido */
      position: fixed;
      /* Posição fixa na tela */
      z-index: 1000;
      /* Prioridade alta */
      left: 0;
      top: 0;
      width: 100%;
      /* Largura total */
      height: 100%;
      /* Altura total */
      overflow: auto;
      /* Rolagem se necessário */
      background-color: rgba(0, 0, 0, 0.4);
      /* Fundo semi-transparente */
    }

    /* Conteúdo do modal */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      /* Centralizado na tela */
      padding: 20px;
      border: 1px solid #888;
      width: 50%;
      /* Largura desejada */
      border-radius: 5px;
      position: relative;
    }

    /* Botão de fechar */
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      position: absolute;
      top: 10px;
      right: 15px;
      cursor: pointer;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
    }

    .input-editavel {
      border: 1px solid #ccc;
      background-color: #f9f9f9;
    }

    /* Estilos para mensagens de sucesso e erro */
    .success-message, .error-message {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
        z-index: 10000;
        opacity: 1;
        transition: opacity 0.5s;
    }
    .error-message {
        border: 2px solid #f44336;
    }
  </style>
</head>

<body>
  <?php include '../header/header.php'; ?>

  <?php include '../header/navbar-selecionada.php'; ?>




  <div class="bordinha mx-auto max-w-2xl px-4 py-16 sm:px-6  lg:max-w-7xl lg:px-8"
    style="margin-top: 30px !important;">
    <div class="px-4 sm:px-0">
      <h3 class="text-base/7 font-semibold text-gray-900">MEUS DADOS</h3>
      <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">Dados Básicos</p>
    </div>
    <div class="mt-6 border-t border-gray-100">
      <dl class="divide-y divide-gray-100">
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">Nome Completo</dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo htmlspecialchars($dados_cliente['nome']); ?></dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">E-mail</dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
            <?php echo htmlspecialchars($dados_cliente['email']); ?>
          </dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">Telefone Celular</dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo htmlspecialchars($dados_cliente['telefone']); ?></dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">CPF</dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo htmlspecialchars($dados_cliente['cpf']); ?></dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">Data de Nascimento</dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo htmlspecialchars($dados_cliente['data_nascimento']); ?></dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">Endereço Padrão</dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
            <?php echo htmlspecialchars($dados_cliente['nome']); ?> <br>
            <?php echo htmlspecialchars($dados_endereco['endereco']); ?>, <?php echo htmlspecialchars($dados_endereco['numero']); ?> - <?php echo htmlspecialchars($dados_endereco['bairro']); ?>, <?php echo htmlspecialchars($dados_endereco['cidade']); ?> - <?php echo htmlspecialchars($dados_endereco['estado']); ?>. <br>
            CEP: <?php echo htmlspecialchars($dados_endereco['cep']); ?> <br>
            Celular: <?php echo htmlspecialchars($dados_cliente['telefone']); ?> <br>
            Complemento: <?php echo htmlspecialchars($dados_endereco['complemento']); ?>
          </dd>
        </div>
        <a href="/pinkvulvet/aplicacao/src/cadastro-login/login/logout.php" style="padding: 5px; cursor: pointer;" class="text-sm/6 font-medium text-gray-900">Sair</a>
        <div class="px-4 py-6 sm:flex sm:justify-between">
          <button onclick="document.getElementById('alterarEmailModal').style.display='block'" class="mt-5 botaun px-4 py-2 bg-black text-white">Alterar e-mail</button>
          <button onclick="document.getElementById('alterarSenhaModal').style.display='block'" class="mt-5 botaun px-4 py-2 bg-black text-white">Alterar senha</button>
        </div>
      </dl>
    </div>
  </div>

  <div id="alterarEmailModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="document.getElementById('alterarEmailModal').style.display='none'">&times;</span>
      <form method="post" action="">
        <label for="novo_email">Novo Email:</label>
        <input
          type="email"
          name="novo_email"
          required
          class="border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
          style="background-color: #fff;"><br><br>
        <input type="submit" name="alterar_email" value="Salvar Novo Email" class="botaun px-4 py-2 bg-black w-full text-white">
      </form>
    </div>
  </div>

  <div id="alterarSenhaModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="document.getElementById('alterarSenhaModal').style.display='none'">&times;</span>
      <form method="post" action="" onsubmit="return validarSenha()">
        <label for="nova_senha">Nova Senha:</label>
        <input
          type="password"
          id="senha"
          name="nova_senha"
          required
          class="border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
          style="background-color: #fff;"><br><br>
          <small id="mensagem-senha" class="text-sm text-gray-500"></small>
        <input type="submit" name="alterar_senha" value="Salvar Nova Senha" class="botaun px-4 py-2 bg-black w-full text-white">
      </form>
    </div>
  </div>

  <script>
    // Função para mostrar mensagem de sucesso
    function showSuccessMessage(message) {
        // Remove mensagem anterior se existir
        const existingMessage = document.getElementById('successMessage');
        if (existingMessage) {
            existingMessage.remove();
        }
    
        // Cria a nova mensagem
        const successDiv = document.createElement('div');
        successDiv.id = 'successMessage';
        successDiv.className = 'success-message';
        successDiv.innerHTML = '✅ ' + message;
    
        // Adiciona ao body
        document.body.appendChild(successDiv);
    
        // Remove após 3 segundos
        setTimeout(() => {
            successDiv.style.opacity = '0';
            successDiv.style.transition = 'opacity 0.5s';
            setTimeout(() => {
                if (successDiv.parentNode) {
                    successDiv.parentNode.removeChild(successDiv);
                }
            }, 500);
        }, 3000);
    }
    
    // Função para mostrar mensagem de erro
    function showErrorMessage(message) {
        // Remove mensagem anterior se existir
        const existingMessage = document.getElementById('errorMessage');
        if (existingMessage) {
            existingMessage.remove();
        }
    
        // Cria a nova mensagem
        const errorDiv = document.createElement('div');
        errorDiv.id = 'errorMessage';
        errorDiv.className = 'error-message';
        errorDiv.innerHTML = '❌ ' + message;
    
        // Adiciona ao body
        document.body.appendChild(errorDiv);
    
        // Remove após 3 segundos
        setTimeout(() => {
            errorDiv.style.opacity = '0';
            errorDiv.style.transition = 'opacity 0.5s';
            setTimeout(() => {
                if (errorDiv.parentNode) {
                    errorDiv.parentNode.removeChild(errorDiv);
                }
            }, 500);
        }, 3000);
    }

    // funcoes.js (Moved from external file for simplicity, can be kept separate if preferred)
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

    // Função para fechar modais quando clicar fora
    window.onclick = function(event) {
      var emailModal = document.getElementById('alterarEmailModal');
      var senhaModal = document.getElementById('alterarSenhaModal');

      if (event.target == emailModal) {
        emailModal.style.display = "none";
      }

      if (event.target == senhaModal) {
        senhaModal.style.display = "none";
      }
    }

    // Check for messages on page load
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const message = urlParams.get('message');

        if (status === 'success' && message) {
            showSuccessMessage(decodeURIComponent(message));
            // Remove parameters from URL to prevent message reappearing on refresh
            history.replaceState(null, '', window.location.pathname);
        } else if (status === 'error' && message) {
            showErrorMessage(decodeURIComponent(message));
            // Remove parameters from URL to prevent message reappearing on refresh
            history.replaceState(null, '', window.location.pathname);
        }
    };
  </script>

  <div class="marge"></div>
  <?php include '../footer/footer.php'; ?>
</body>

</html>
<?php
$conn->close();
?>