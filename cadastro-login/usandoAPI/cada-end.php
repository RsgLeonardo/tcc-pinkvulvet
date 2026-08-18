<?php
// cada-end.php
$id_cliente = $_GET['id_cliente'] ?? null; // Obtém o ID do cliente da URL

if ($id_cliente === null) {
    die("Erro: ID do cliente não fornecido."); // Trate o erro adequadamente
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Cadastro de Endereço</title>
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
                <form action="save_endereco.php" method="post" class="w-full max-w-4xl bg-white shadow-md p-6 col-span-8">
                    <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">

                    <h1 class="text-xl text-gray-800">Cadastro de Endereço</h1>
                    <hr class="my-2 border-gray-300 mb-4">

                    <div class="mb-4">
                        <label for="cep" class="block text-gray-600 text-sm mb-2">CEP *</label>
                        <input type="text" id="cep" name="cep"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="Digite o CEP para encontrar o endereço automaticamente" required onblur="buscarEndereco()">
                        <small class="text-sm text-gray-500"></small>
                        <!-- <div id="resultado-cep" class="mt-2 p-2 bg-gray-100 border border-gray-300 rounded text-sm text-gray-700 hidden"></div> -->
                    </div>

                    <div class="mb-4">
                        <label for="endereco" class="block text-gray-600 text-sm mb-2">Endereço *</label>
                        <input type="text" id="endereco" name="endereco"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="Rua" required>
                    </div>

                    <div class="mb-4">
                        <label for="numero" class="block text-gray-600 text-sm mb-2">Número *</label>
                        <input type="text" id="numero" name="numero"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="Número" required>
                    </div>

                    <div class="mb-4">
                        <label for="complemento" class="block text-gray-600 text-sm mb-2">Complemento</label>
                        <input type="text" id="complemento" name="complemento"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="Complemento (opcional)">
                    </div>

                    <div class="mb-4">
                        <label for="bairro" class="block text-gray-600 text-sm mb-2">Bairro *</label>
                        <input type="text" id="bairro" name="bairro"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="Bairro" required>
                    </div>

                    <div class="mb-4">
                        <label for="cidade" class="block text-gray-600 text-sm mb-2">Cidade *</label>
                        <input type="text" id="cidade" name="cidade"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="Cidade" required>
                    </div>

                    <div class="mb-6">
                        <label for="estado" class="block text-gray-600 text-sm mb-2">Estado *</label>
                        <input type="text" id="estado" name="estado"
                            class="w-full px-3 py-2 border border-gray-300 focus:black focus:black focus:ring-primary"
                            placeholder="Estado" required>
                    </div>

                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="w-full bg-black hover:bg-gray-400 hover:text-black text-white py-2 px-4 focus:outline-none focus:shadow-outline transition duration-300"
                            value="Cadastrar Endereço">
                            Cadastrar Endereço
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../cadastro/funcoes.js"></script>
    <script>
        // Função para buscar endereço via CEP
        function buscarEndereco() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            const resultadoDiv = document.getElementById('resultado-cep');

            if (cep.length < 8) {
                resultadoDiv.innerHTML = '<span class="text-red-600">CEP deve conter 8 números</span>';
                resultadoDiv.classList.remove('hidden');
                return;
            }

            if (cep.length !== 8) {
                resultadoDiv.classList.add('hidden');
                return;
            }

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        resultadoDiv.innerHTML = '<span class="text-red-600">CEP não encontrado</span>';
                        resultadoDiv.classList.remove('hidden');
                    } else {
                        // Preenche os campos automaticamente
                        document.getElementById('endereco').value = data.logradouro || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('estado').value = data.uf || '';

                        // Mostra o resultado abaixo do CEP
                        // resultadoDiv.innerHTML = `
                        //     <strong>Endereço encontrado:</strong><br>
                        //     ${data.logradouro || 'N/A'}, ${data.bairro || 'N/A'}<br>
                        //     ${data.localidade || 'N/A'} - ${data.uf || 'N/A'}
                        // `;
                        resultadoDiv.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    resultadoDiv.innerHTML = '<span class="text-red-600">Erro ao buscar CEP</span>';
                    resultadoDiv.classList.remove('hidden');
                });
        }
    </script>
    <?php include '../../footer/footer.php'; ?>
</body>

</html>