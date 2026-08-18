fetch('localizador.php?acao=listar')
    .then(response => response.json())
    .then(produtos => {
        const produtosContainer = document.getElementById('produtos-container');
        produtos.forEach(produto => {
            const produtoDiv = document.createElement('div');
            produtoDiv.classList.add('group', 'relative');
            produtoDiv.innerHTML = `
                <a href="../exibicao/exibicao-produto.php?id=${produto.id_produto}"> 
                    <img src="../../../fotos/acessorios/${produto.imagem}" alt="${produto.nome}"> 
                </a>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm text-gray-700">
                            <a href="../exibicao/exibicao-produto.php?id=${produto.id_produto}" class="hover:underline">${produto.nome}</a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500"><b>R$ ${produto.preco}</b></p>
                    </div>
                    <form class="add-to-cart-form" method="POST">
                        <input type="hidden" name="adicionar_carrinho" value="${produto.id_produto}"> 
                        <button type="submit" class="cursor-pointer">
                            <img src="../../../fotos/produtos/carrinho.png" alt="Adicionar ao carrinho"> 
                        </button>
                    </form>
                </div>
            `;
            produtosContainer.appendChild(produtoDiv);
        });

        // Adiciona um listener de evento para os formulários de adicionar ao carrinho
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário (que recarregaria a página)

                const formData = new FormData(this); // Obtém os dados do formulário

                fetch('add.php', { // Envia os dados para add.php
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        console.log('Resposta da requisição:', response); // Log da resposta bruta
                        if (!response.ok) {
                            throw new Error(`Erro HTTP! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Dados recebidos (JSON):', data); // Log dos dados JSON
                        if (data.success) {
                            showSuccessMessage(data.message); // Usar função personalizada de sucesso
                            // *** ADD THIS LINE ***
                            if (window.updateCartCount) { // Check if the function exists
                                window.updateCartCount(); // Call the global function from header.php
                            }
                            // *** END ADDED LINE ***
                        } else {
                            showErrorMessage('Ocorreu um erro ao adicionar o item ao carrinho.'); // Usar função personalizada de erro
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        showErrorMessage('Ocorreu um erro na comunicação com o servidor.'); // Usar função personalizada de erro
                    });
            });
        });
    });

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
    successDiv.style.cssText = `
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
    `;
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
    errorDiv.style.cssText = `
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
        border: 2px solid #f44336;
    `;
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