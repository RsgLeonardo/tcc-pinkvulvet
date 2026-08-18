<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Criar Conta</title>
    <link rel="shortcut icon" href="../../fotos/cadastro-de-conta/favicon.jpeg" type="icone">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image/x-icon">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#3b82f6',
                            /* Equivalente ao primary do Bootstrap */
                            hover: '#2563eb'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50">
    <?php include '../../header/header.php'; ?>
    <div class="main-content">

        <div class="container mx-auto px-4 py-8 mt-20 grid grid-cols-12">
            <div class="flex justify-center col-span-12">
                <form action="create_user_back.php" method="post" class="w-full max-w-4xl bg-white shadow-md p-6 col-span-8">
                    <h1 class="text-xl text-gray-800">Crie sua conta na PV</h1>
                    <hr class="my-2 border-gray-300 mb-4">

                    <div class="mb-4">
                        <label for="nome" class="block text-gray-600 text-sm mb-2">Nome *</label>
                        <input type="text" id="nome" name="nome"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            maxlength="70" placeholder="Nome completo" required>
                        <small id="mensagem-nome" class="text-sm text-gray-500"></small>
                    </div>

                    <div class="mb-4">
                        <label for="cpf" class="block text-gray-600 text-sm mb-2">CPF *</label>
                        <input type="text" id="cpf" name="cpf"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="Somente números" required onblur="validarCPF()">
                        <small id="mensagem-cpf" class="text-sm text-gray-500"></small>
                    </div>

                    <div class="mb-4">
                        <label for="data_nascimento" class="block text-gray-600 text-sm mb-2">Data de Nascimento *</label>
                        <input type="date" id="data_nascimento" name="data_nascimento"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            required>
                        <small id="mensagem-nascimento" class="text-sm text-gray-500"></small>
                    </div>

                    <div class="mb-4">
                        <label for="telefone" class="block text-gray-600 text-sm mb-2">Número de Celular</label>
                        <input type="text" id="telefone" name="telefone"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="Inclua o código do país" pattern="\d{10,13}" inputmode="numeric">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-600 text-sm mb-2">E-mail *</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="email@email.com" required>
                    </div>

                    <div class="mb-4">
                        <label for="senha" class="block text-gray-600 text-sm mb-2">Crie sua Senha *</label>
                        <div class="relative">
                            <input type="password" id="senha" name="senha"
                                class="appearance-none w-full px-3 py-2 pr-10 border border-gray-300 focus:black focus:black focus:ring-primary"
                                title="A senha deve conter de 8 a 20 caracteres, incluindo 1 letra maiúscula, 1 minúscula, 1 número e 1 caractere especial." required>
                            <button type="button" id="toggleSenha" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <svg id="eyeIconSenha" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <small id="mensagem-senha" class="text-sm text-gray-500"></small>
                    </div>

                    <div class="mb-6">
                        <label for="confirmar_senha" class="block text-gray-600 text-sm mb-2">Confirme sua Senha *</label>
                        <div class="relative">
                            <input type="password" id="confirmar_senha" name="confirmar_senha"
                                class="appearance-none w-full px-3 py-2 pr-10 border border-gray-300 focus:black focus:black focus:ring-primary"
                                required>
                            <button type="button" id="toggleConfirmarSenha" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <svg id="eyeIconConfirmarSenha" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="w-full bg-black hover:bg-gray-400 hover:text-black text-white py-2 px-4 focus:outline-none focus:shadow-outline transition duration-300"
                            value="Cadastrar">
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // funcao de ver senha
        function togglePasswordVisibility(inputId, toggleId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = document.getElementById(toggleId);
            const eyeIcon = document.getElementById(iconId);

            toggleButton.addEventListener('click', function() {
                const isPassword = passwordInput.type === 'password';

                // Alterna o tipo do input
                passwordInput.type = isPassword ? 'text' : 'password';

                // Alterna o ícone
                if (isPassword) {
                    // Ícone de olho fechado (senha visível)
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                    `;
                } else {
                    // Ícone de olho aberto (senha oculta)
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    `;
                }
            });
        }

        // Inicializar os toggles quando a página carregar
        document.addEventListener('DOMContentLoaded', function() {
            togglePasswordVisibility('senha', 'toggleSenha', 'eyeIconSenha');
            togglePasswordVisibility('confirmar_senha', 'toggleConfirmarSenha', 'eyeIconConfirmarSenha');
        });
    </script>

    <script src="funcoes.js"></script>
    <?php include '../../footer/footer.php'; ?>
</body>

</html>