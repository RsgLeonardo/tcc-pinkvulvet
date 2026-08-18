<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <title>| Brasil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/style.css" class="css">
    <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image/x-icon">

    <style>
/* Seus estilos existentes... */

/* Adicione estas regras para o coração */
#heartIcon {
    cursor: pointer;
    transition: transform 0.2s ease;
}

#heartIcon:hover {
    transform: scale(1.1);
}

#heartIcon.favorited path {
    fill: black !important;
    stroke: black !important;
}

/* Estilos para mensagens de favorito */
.favorite-message {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1000;
    opacity: 0;
    transform: translateY(-20px);
    transition: all 0.3s ease;
}

.favorite-message.show {
    opacity: 1;
    transform: translateY(0);
}

.favorite-message.error {
    background: #fee;
    border-left: 4px solid #f56565;
    color: #c53030;
}
</style>
</head>

<body>
    <?php
    include 'exib.php';
    include '../header/header.php';
    include '../header/navbar.php';
    ?>

    <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
        <!-- IMAGEM -->
        <div class="aspect-w-3 aspect-h-4 rounded-lg overflow-hidden block" style="height: 500px;">
            <img src="<?php echo $caminho_imagem; ?>" alt="<?php echo $nome_produto; ?>" class="w-full h-full object-center object-cover" />
        </div>

        <!-- Informações do produto -->
        <div class="lg:col-span-1 lg:border-l lg:border-gray-200 lg:pl-8 mt-4 lg:mt-0 flex flex-col">
            <div>
                <h1 class="text-l tracking-tight text-gray-900 sm:text-2xl roboto"><?php echo ($nome_produto); ?></h1>

                <!-- Preço e compartilhamento -->
                <div class="flex justify-between items-center mt-4">
                    <p class="roboto text-xl text-gray-900">R$ <?php echo number_format($preco_produto, 2, ',', '.'); ?></p>

                    <!-- Ícones de compartilhamento -->
                    <div class="flex space-x-4">


                        <!-- Botão de favorito -->
                        <button class="focus:outline-none op" style="margin-top: -1px !important;">
                            <svg id="heartIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 <?php echo $is_favorited ? 'favorited' : ''; ?>" 
                            data-product-id="<?php echo htmlspecialchars($id_produto); ?>"
                            data-is-favorite="<?php echo $is_favorited ? 'true' : 'false'; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5" style="display: inline-block !important;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                        
                        <div id="favorite-message" class="favorite-message hidden"></div>

                        <script>
                            // Script para deixar o coração preenchido ao clicar
                            document.addEventListener("DOMContentLoaded", function() {
                                const heartIcon = document.getElementById("heartIcon");
                                const path = heartIcon.querySelector("path");

                                heartIcon.addEventListener("click", function() {
                                    const currentFill = path.getAttribute("fill");
                                    path.setAttribute("fill", currentFill === "black" ? "none" : "black");
                                });
                            });
                        </script>


                        <a href="#" class="text-gray-500 hover:text-black transition-colors duration-300"
                            onclick="copiarLink(event, '<?php echo $_SERVER['REQUEST_SCHEME'] . ':' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/exibicao/exibicao-produto.php?id=<?= $id_produto ?>')">
                            <i class="fas fa-link"></i>
                        </a>

                        <!-- Elemento de feedback visual -->
                        <div id="mensagem-copiado" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                        background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); ">
                            Link copiado com sucesso!
                        </div>

                        <script>
                            function copiarLink(event, link) {
                                event.preventDefault(); // Impede que o link seja aberto

                                navigator.clipboard.writeText(link).then(() => {
                                    // Exibir mensagem visual
                                    let mensagem = document.getElementById('mensagem-copiado');
                                    mensagem.style.display = 'block';

                                    // Esconder a mensagem após 2 segundos
                                    setTimeout(() => {
                                        mensagem.style.display = 'none';
                                    }, 2000);
                                }).catch(err => {
                                    console.error('Erro ao copiar:', err);
                                });
                            }
                        </script>

                    </div>
                </div>

                <!-- ABAS -->
                <div class="mt-8 border-b border-gray-200">
                    <div class="tabs flex space-x-8">
                        <button class="tab-btn py-2 px-1 border-b-2 border-black tab-active" data-tab="descricao">Descrição</button>
                        <button class="tab-btn py-2 px-1 border-b-2 border-transparent" data-tab="caracteristicas">Características</button>
                        <button class="tab-btn py-2 px-1 border-b-2 border-transparent" data-tab="como-usar">Como Usar</button>
                    </div>
                </div>

                <!-- Conteúdo das abas -->
                <div class="tabs-container" style="min-height: 200px;">
                    <div class="tab-content mt-6" id="descricao">
                        <p class="roboto text-base text-gray-500"><?php echo $descricao_produto; ?></p>
                        <div class="mt-20 grid grid-cols-2 gap-4">
                            <div class="text-center py-3 px-2 rounded-lg bg-gray-50">
                                <i class="fas fa-leaf text-lg mb-2 text-black-600"></i>
                                <p class="roboto text-xs font-medium">Vegano & Cruelty-free</p>
                            </div>
                            <div class="text-center py-3 px-2 rounded-lg bg-gray-50">
                                <i class="fas fa-shipping-fast text-lg mb-2 text-black"></i>
                                <p class="roboto text-xs font-medium">Frete Grátis acima de R$150</p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content mt-6 hidden" id="caracteristicas">
                        <ul class="space-y-3 roboto text-base text-gray-500">
                            <li class="flex">
                                <span class=""></span>
                                <span>Material: Cerdas sintéticas ultramacias e cabo de plástico biodegradável</span>
                            </li>
                            <li class="flex items-start">
                                <span class="inline-block"></span>
                                <span>Dimensões: 15cm de comprimento e 1cm de diâmetro na ponta</span>
                            </li>
                            <li class="flex items-start">
                                <span class="inline-block"></span>
                                <span>Formato afunilado perfeito para aplicação precisa de corretivo</span>
                            </li>
                            <li class="flex items-start">
                                <span class="inline-block"></span>
                                <span>Livre de crueldade animal (cruelty-free) e vegano</span>
                            </li>
                            <!--  w-4 h-4 rounded-full bg-black mt-1 mr-2 -->
                            <li class="flex items-start">
                                <span class="inline-block"></span>
                                <span>Ideal para todos os tipos de pele, especialmente pele sensível</span>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content mt-6 hidden" id="como-usar">
                        <ol class="space-y-3 roboto text-base text-gray-500 list-decimal list-inside">
                            <li>Aplique uma pequena quantidade de corretivo na região desejada</li>
                            <li>Com movimentos suaves, use a ponta do pincel para espalhar e esfumar o produto</li>
                            <li>Para uma cobertura mais intensa, aplique camadas finas e construa a cobertura aos poucos</li>
                            <li>Finalize com pó translúcido para fixar o produto</li>
                            <!-- <li>Lave o pincel com água morna e sabão neutro após cada uso e deixe secar na posição horizontal</li> -->
                        </ol>
                    </div>
                </div>

            </div>

            <!-- Seletor de quantidade -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#addToCartForm").submit(function(event) {
                        event.preventDefault(); // Impede o envio tradicional do formulário

                        $.ajax({
                            type: "POST",
                            url: $(this).attr("action"),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.success) {
                                    $("#successMessage").fadeIn().delay(3000).fadeOut();
                                }
                            },
                            error: function() {
                                alert("Erro ao adicionar ao carrinho. Tente novamente!");
                            }
                        });
                    });
                });
            </script>

            <form id="addToCartForm" method="post" action="exib.php?id=<?php echo htmlspecialchars($id_produto); ?>">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id_produto); ?>">
                <input type="hidden" name="adicionar_carrinho" value="1">

                <div class="flex items-center mb-6">
                    <label for="quantidade" class="roboto text-sm font-medium text-gray-700 mr-3">Quantidade</label>
                    <div class="mt-2 flex items-center">
                        <button type="button" class="qty-btn minus bg-gray-100 text-gray-600 hover:bg-gray-200 h-8 w-8 rounded-l">-</button>
                        <input type="number" id="quantidade" name="quantidade" min="1" value="1" class="h-8 w-12 text-center border-t border-b">
                        <button type="button" class="qty-btn plus bg-gray-100 text-gray-600 hover:bg-gray-200 h-8 w-8 rounded-r">+</button>
                    </div>
                </div>

                <button type="submit" class="bg-black w-full border border-transparent py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-gray-400 hover:text-black">
                    <i class="fas fa-shopping-bag mr-2"></i> Adicionar ao Carrinho
                </button>
            </form>

            <div id="successMessage" class="success-message" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
            background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center;">
                ✅ Produto adicionado ao carrinho com sucesso!
            </div>
        </div>
    </div>
    </div>


    <?php include 'avaliacoes/avaliacoes.php'; ?>
    <?php include '../footer/footer.php'; ?>

    <!-- Script para as abas -->
    <script src="script.js"></script>

</body>

</html>