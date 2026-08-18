<?php require_once 'pagament.php' ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>| Pagamento</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png"
        type="image x-icon">
    <link rel="stylesheet"
        href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/principal.css">
    <style>
        .envio-opcao {
            border-radius: 0 !important;
        }

        .input-editavel {
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .editar-btn {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>

    <script>
        function editarEndereco() {
            // Recarrega a página com o parâmetro 'editar_endereco' na URL
            window.location.href = window.location.pathname + "?editar_endereco=1";
        }

        function cancelarEditarEndereco() {
            // Recarrega a página sem o parâmetro 'editar_endereco'
            window.location.href = window.location.pathname;
        }

        // funcao para selecionar o radio button
        function selecionarRadio(id) {
            document.getElementById(id).checked = true;
        }
    </script>
</head>

<body>
    <?php include '../header/header.php'; ?>

    <div class="main-content">
        <div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32 mt-20">
            <div class="px-4 pt-8">
                <p class="text-xl roboto">Resumo do pedido</p>
                <p class="text-gray-400">
                    Verifique seus itens e selecione um método de envio adequado.
                </p>
                <div class="sem-borda mt-8 space-y-3 border bg-white px-2 py-4 sm:px-6">
                    <?php foreach ($itens_carrinho as $item): ?>
                        <div class="flex flex-col bg-white sm:flex-row">
                            <img class="m-2 h-24 w-28 rounded-md object-cover object-center"
                                src="../../../fotos/produtos/<?php echo htmlspecialchars($item['imagem']); ?>"
                                alt="<?php echo htmlspecialchars($item['nome']); ?>" />
                            <div class="flex w-full flex-col px-4 py-4">
                                <span class="font-semibold"><?php echo htmlspecialchars($item['nome']); ?></span>
                                <p class="text-gray-500">Quantidade: <?php echo $item['quantidade']; ?></p>
                                <p class="text-lg font-bold">R$ <?php echo number_format($item['subtotal'], 2, ',', '.'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <p class="mt-8 text-xl roboto">Métodos de envio</p>
                <form class="mt-5 grid gap-6">
                    <div class="relative envio-opcao" onclick="selecionarRadio('radio_1')">
                        <div class="radio-opcao-conteudo">
                            <img class="radio-opcao-logo" src="../../../fotos/logo/correios-logo.png" alt="logo correios" />
                            <div class="radio-opcao-texto">
                                <span class="radio-opcao-nome">Correios</span>
                                <p class="radio-opcao-entrega">Entrega: 15-20 Dias</p>
                            </div>
                        </div>
                        <input type="radio" id="radio_1" name="radio" class="radio-input" checked />
                        <span class="radio-marcador"></span>
                        <label for="radio_1" class="radio-label"></label>
                    </div>
                    <div class="relative envio-opcao" onclick="selecionarRadio('radio_2')">
                        <div class="radio-opcao-conteudo">
                            <img class="radio-opcao-logo" src="../../../fotos/logo/anjun-logo.jpg" alt="logo anjun" />
                            <div class="radio-opcao-texto">
                                <span class="radio-opcao-nome">Anjun</span>
                                <p class="radio-opcao-entrega">Entrega: 10-15 Dias</p>
                            </div>
                        </div>
                        <input type="radio" id="radio_2" name="radio" class="radio-input" />
                        <span class="radio-marcador"></span>
                        <label for="radio_2" class="radio-label"></label>
                    </div>
                </form>

            </div>
            <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0">
                <p class="text-xl roboto">Detalhes do Pagamento</p>
                <p class="text-gray-400">
                    Conclua seu pedido fornecendo seus detalhes de pagamento.
                </p>
                <div class="">
                    <div class="endereco mt-8 space-y-3 px-4 py-4 sm:px-6">
                        <div class="flex justify-between items-baseline">
                            <?php if ($editando_endereco): ?>
                                <form method="POST" action="" class="w-full">
                                    <input type="hidden" name="atualizar_endereco" value="1">
                                    <input type="text" name="cep" value="<?php echo htmlspecialchars($dados_endereco['cep']); ?>" placeholder="CEP" class="w-full border-gray-200 px-2 py-2 mb-2 input-editavel">
                                    <input type="text" name="endereco" value="<?php echo htmlspecialchars($dados_endereco['endereco']); ?>" placeholder="Endereço" class="w-full border-gray-200 px-2 py-2 mb-2 input-editavel">
                                    <input type="text" name="numero" value="<?php echo htmlspecialchars($dados_endereco['numero']); ?>" placeholder="Número" class="w-full border-gray-200 px-2 py-2 mb-2 input-editavel">
                                    <input type="text" name="complemento" value="<?php echo htmlspecialchars($dados_endereco['complemento']); ?>" placeholder="Complemento" class="w-full border-gray-200 px-2 py-2 mb-2 input-editavel">
                                    <input type="text" name="bairro" value="<?php echo htmlspecialchars($dados_endereco['bairro']); ?>" placeholder="Bairro" class="w-full border-gray-200 px-2 py-2 mb-2 input-editavel">
                                    <input type="text" name="cidade" value="<?php echo htmlspecialchars($dados_endereco['cidade']); ?>" placeholder="Cidade" class="w-full border-gray-200 px-2 py-2 mb-2 input-editavel">
                                    <input type="text" name="estado" value="<?php echo htmlspecialchars($dados_endereco['estado']); ?>" placeholder="Estado" class="w-full border-gray-200 px-2 py-2 mb-2 input-editavel">
                                    <input type="text" name="informacoes" value="<?php echo htmlspecialchars($dados_endereco['informacoes']); ?>" placeholder="Informações" class="w-full border-gray-200 px-2 py-2 mb-2 input-editavel">
                                    <div class="flex justify-between">
                                        <button type="submit" class="bg-gray-300 hover:bg-gray-600 text-black px-4 py-2 ">Salvar</button>
                                        <button type="button" onclick="cancelarEditarEndereco();" class="bg-gray-300 hover:bg-gray-600 px-4 py-2 ">Cancelar</button>
                                    </div>
                                </form>
                            <?php else: ?>
                                <p class="text-gray-700"><b>Endereço de entrega cadastrado:</b><br>
                                    <?php echo htmlspecialchars($dados_cliente['nome']); ?> <br>
                                    <?php echo htmlspecialchars($dados_endereco['endereco']); ?>, <?php echo htmlspecialchars($dados_endereco['numero']); ?> - <?php echo htmlspecialchars($dados_endereco['bairro']); ?>, <?php echo htmlspecialchars($dados_endereco['cidade']); ?> - <?php echo htmlspecialchars($dados_endereco['estado']); ?>. <br>
                                    CEP: <?php echo htmlspecialchars($dados_endereco['cep']); ?> <br>
                                    Celular: <?php echo htmlspecialchars($dados_endereco['telefone']); ?> <br>
                                    Complemento: <?php echo htmlspecialchars($dados_endereco['complemento']); ?>
                                </p>
                                <button onclick="editarEndereco()" class="flex items-center space-x-2 text-black-500 hover:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16.75V19a.75.75 0 00.75.75h2.25L18.5 8.5a1.5 1.5 0 00-2.12-2.12L4 16.75z" />
                                    </svg>
                                    <span>Editar</span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-4">
                    <label for="card-holder" class="block text-sm roboto">Selecione a forma de pagamento</label>
                    <select id="payment-method"
                        class="border px-2 py-2 text-gray-700 w-full focus:outline-none focus:ring-2 focus:ring-white bg-gray-100">
                        <option value="pix">Pix</option>
                    </select>
                    <a href="pagamento-confirmado.php" class="hv-vic gap-6 finalizar-botao w-full px-6 py-3 font-medium text-white mt-4 mb-8 text-center">
                        Finalizar Compra
                    </a>
                </div>

                <!-- Total -->
                <div class="mt-6 border-b py-2">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">Subtotal</p>
                        <p class="font-semibold text-gray-900">R$ <?php echo number_format($total_geral, 2, ',', '.'); ?></p>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">Valor Total</p>
                    <p class="text-2xl font-semibold text-gray-900">R$ <?php echo number_format($total_geral, 2, ',', '.'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php include '../footer/footer.php'; ?>
</body>

</html>