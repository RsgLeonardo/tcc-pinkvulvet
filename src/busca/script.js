// Adiciona um listener de evento para os formulários de adicionar ao carrinho
document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário (que recarregaria a página)

        const formData = new FormData(this); // Obtém os dados do formulário

        fetch('add.php', { // Envia os dados para add.php
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Espera uma resposta JSON
        .then(data => {
            if (data.success) {
                // Exibe a mensagem de sucesso personalizada
                showSuccessMessage();
            } else {
                alert('Ocorreu um erro ao adicionar o item ao carrinho.'); // Mensagem de erro genérica
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Ocorreu um erro na comunicação com o servidor.');
        });
    });
});

// Função para exibir a mensagem de sucesso
function showSuccessMessage() {
    const successMessage = document.getElementById('successMessage');
    if (successMessage) {
        successMessage.style.display = 'block';
        
        // Esconde a mensagem após 3 segundos
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 3000);
    }
}