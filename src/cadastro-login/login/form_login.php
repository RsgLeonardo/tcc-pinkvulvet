<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Fazer login</title>
    <link rel="shortcut icon" href="../../fotos/cadastro-de-conta/favicon.jpeg" type="icone">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image/x-icon">

</head>
<?php include '../../header/header.php'; ?>

<body>
    <div class="main-content">

        <div class="container mx-auto py-8">
            <div class="bg-white  shadow-md p-6 max-w-4xl mx-auto mt-20">

                <h1 class="text-xl text-gray-800">Entre na sua conta na PV</h1>
                <hr class="my-2 border-gray-300 mb-4">


                <form action="login.php" method="post" class="space-y-4">
                    <div>
                        <label for="email" class="block text-gray-600 text-sm  mb-2">
                            Insira seu e-mail
                        </label>
                        <input type="email" class="shadow appearance-none border w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm" name="email" id="email" placeholder="E-mail">
                    </div>
                    <div>
                        <label for="senha" class="block text-gray-600 text-sm  mb-2">
                            Senha
                        </label>
                        <div class="relative">
                            <input type="password" name="senha" id="senha" class="shadow appearance-none border w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm" placeholder="Senha deve conter de 8-20 caracteres">
                            <button type="button" id="toggleSenha" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <svg id="eyeIconSenha" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>

                        </div>

                    <button type="submit" class="w-full bg-black hover:bg-gray-400 hover:text-black text-white py-2 px-4 focus:outline-none focus:shadow-outline">
                        Próximo
                    </button>
                </form>

                <div class="mt-6 text-center text-sm text-gray-600">
                    <p class="font-bold mb-2">Desfrute de uma experiência de compra exclusiva com sua conta pessoal</p>
                    <ul class="list-disc pl-5 text-left mx-auto w-fit">
                        <li class="mb-1">Verifique os detalhes e monitore o status de seus pedidos e devoluções</li>
                        <li class="mb-1">Crie uma lista de desejos para salvar seus itens favoritos</li>
                        <li class="mb-1">Veja seus horários privados e solicitações de reparos</li>
                        <li>Receba assistência personalizada de nosso Serviço de Atendimento ao Cliente</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Função para alternar visibilidade da senha
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

        // Inicializar o toggle quando a página carregar
        document.addEventListener('DOMContentLoaded', function() {
            togglePasswordVisibility('senha', 'toggleSenha', 'eyeIconSenha');
        });
    </script>

    <?php include '../../footer/footer.php'; ?>
</body>

</html>