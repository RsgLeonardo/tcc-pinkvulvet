<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>| Meu Carrinho</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="shortcut icon"
        href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image x-icon">
    <link rel="stylesheet"
        href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/principal.css">
</head>

<body>
    <?php include 'cart.php'; ?>
    <?php include '../header/header.php'; ?>

    <div class="main-content">
        <div class="max-w-4xl mx-auto bg-white shadow-md g my-8" style="margin-top: 100px">
            <!-- Cabeçalho do Carrinho -->
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h1 class="text-xl roboto">Meu Carrinho</h1>
                <span class="text-gray-500"><?php echo $totalItens; ?> itens</span>
            </div>

            <!-- Lista de Itens -->
            <div class="divide-y">
                <?php foreach ($cartItems as $item): ?>
                    <div class="flex p-6 hover:bg-gray-50 transition-colors">
                        <!-- Imagem do Produto -->
                        <div class="mr-4">
                            <a href="../exibicao/exibicao-produto.php?id=<?php echo htmlspecialchars($item['id']); ?>">
                                <!-- img src="../../../fotos/produtos/base01.jpeg" alt="" class="w-24 h-32 object-cover rounded-md" -->
                                <img src="../../../fotos/produtos/<?php echo htmlspecialchars($item['image']); ?>"
                                    alt="<?php echo htmlspecialchars($item['name']); ?>"
                                    class="w-24 h-32 object-cover">
                            </a>
                        </div>

                        <!-- Detalhes do Produto -->
                        <div class="flex-grow">
                            <h2 class="text-lg"><?php echo htmlspecialchars($item['name']); ?></h2>
                            <!--div class="text-gray-600 mt-1">
                            <span>Tamanho: <?php echo htmlspecialchars($item['size']); ?></span>
                            <span class="ml-4">Cor: <?php echo htmlspecialchars($item['color']); ?></span>
                        </div-->
                            <div class="mt-2 flex items-center">
                                <!-- Controle de Quantidade -->
                                <form method="POST" class="flex items-center border">
                                    <input type="hidden" name="action" value="update_quantity">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" name="quantidade"
                                        value="<?php echo max(1, $item['quantity'] - 1); ?>"
                                        class="px-3 py-1 text-gray-600">-</button>
                                    <span class="px-4"><?php echo $item['quantity']; ?></span>
                                    <button type="submit" name="quantidade" value="<?php echo $item['quantity'] + 1; ?>"
                                        class="px-3 py-1 text-gray-600">+</button>
                                </form>

                                <!-- Ações -->
                                <div class="ml-4 flex space-x-3">
                                    <form method="POST" class="inline">
                                        <input type="hidden" name="action" value="remove_item">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="text-gray-500 hover:text-red-500">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <!-- <button class="text-gray-500 hover:text-pink-500">
                                        <i class="bi bi-heart-fill"></i>
                                    </button> -->
                                </div>
                            </div>
                        </div>

                        <!-- Preço -->
                        <div class="text-right">
                            <p class="text-gray-700 text-lg">R$
                                <?php echo number_format($item['price'] * $item['quantity'], 2, ',', '.'); ?>
                            </p>
                            <p class="text-gray-500 text-sm">R$ <?php echo number_format($item['price'], 2, ',', '.'); ?>
                                cada</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Resumo do Pedido -->
            <div class="p-6 bg-gray-50 rounded-b-lg">
                <div class="flex justify-between mb-4">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="roboto">R$
                        <?php echo number_format(calcularTotal($cartItems), 2, ',', '.'); ?></span>
                </div>
                <div class="flex justify-between roboto text-lg border-t pt-4">
                    <span>Total</span>
                    <span class="font-bold">R$
                        <?php echo number_format(calcularTotal($cartItems), 2, ',', '.'); ?></span>
                </div>

                <a href="../pagamento/pagament_form.php" class="botao w-full bg-black text-white py-3 mt-6 transition-colors text-center block">
                    Finalizar Compra
                </a>

                <form method="POST" class="w-full mt-3">
                    <input type="hidden" name="action" value="clear_cart">
                    <button type="submit" class="continue w-full text-end text-black py-3 transition-colors text-center block">
                        Remover todos os itens
                    </button>
                </form>

                <p class="continue">
                    <a
                        href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/index.php">Continue
                        comprando
                    </a>
                </p>

            </div>
        </div>

    </div>
    <?php include '../footer/footer.php'; ?>
</body>

</html>