<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Pagamento Confirmado</title>
    <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .confirmation-container {
            background: white;
            backdrop-filter: blur(20px);
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: black;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounceIn 1s ease-out 0.3s both;
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .checkmark {
            width: 60px;
            height: 60px;
            stroke: white;
            stroke-width: 4;
            fill: none;
            animation: checkmark 0.8s ease-out 0.8s both;
        }

        @keyframes checkmark {
            0% {
                stroke-dasharray: 0 100;
            }

            100% {
                stroke-dasharray: 100 0;
            }
        }

        .title {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 16px;
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }

        .subtitle {
            font-size: 18px;
            color: #718096;
            margin-bottom: 40px;
            line-height: 1.6;
            animation: fadeInUp 0.6s ease-out 0.7s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .payment-details {
            background: #f8fafc;
            padding: 24px;
            margin-bottom: 40px;
            border: 1px solid #e2e8f0;
            animation: fadeInUp 0.6s ease-out 0.9s both;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
            padding-top: 12px;
            border-top: 2px solid #e2e8f0;
            font-weight: 600;
            font-size: 18px;
        }

        .detail-label {
            color: #718096;
            font-size: 14px;
        }

        .detail-value {
            color: #2d3748;
            font-weight: 500;
        }

        .actions {
            display: flex;
            gap: 16px;
            flex-direction: column;
            animation: fadeInUp 0.6s ease-out 1.1s both;
        }

        .btn {
            padding: 16px 32px;
            font-weight: 400;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: black;
            color: white;
        }

        .btn-primary:hover {
            background-color: #d6d6d6;
            color: black;
        }

        .btn-secondary {
            background: transparent;
            color: black;
            border: 1px solid #000000;
        }

        .btn-secondary:hover {
            background-color: #d6d6d6;
        }

        .floating-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0;
            }

            10%,
            90% {
                opacity: 1;
            }

            50% {
                transform: translateY(-100px) rotate(180deg);
            }
        }

        .order-id {
            font-family: 'Courier New', monospace;
            background: #e2e8f0;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 14px;
            color: #4a5568;
            margin-top: 20px;
            animation: fadeInUp 0.6s ease-out 1.3s both;
        }

        @media (max-width: 480px) {
            .confirmation-container {
                padding: 40px 24px;
            }

            .title {
                font-size: 28px;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="floating-particles" id="particles"></div>

    <div class="confirmation-container">
        <div class="success-icon">
            <svg class="checkmark" viewBox="0 0 100 100">
                <path d="M20,50 L40,70 L80,30" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>

        <h1 class="title">Pagamento Confirmado!</h1>
        <p class="subtitle">Sua compra foi processada com sucesso.<br>Você receberá um e-mail de confirmação em breve.</p>

        <div class="payment-details">
            <div class="detail-row">
                <span class="detail-label">Método de Pagamento</span>
                <span class="detail-value">PIX</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Data da Transação</span>
                <span class="detail-value" id="transactionDate"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value" style="color: #4CAF50;">✓ Aprovado</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Pago</span>
                <span class="detail-value">R$ ***,**</span>
            </div>
        </div>

        <div class="actions">
            <button class="btn btn-primary" onclick="window.location.href='/pinkvulvet/index.php'">
                Continuar Comprando
            </button>
            <button class="btn btn-secondary" onclick="window.print()">
                Imprimir Comprovante
            </button>
        </div>

        <div class="order-id">
            ID do Pedido: #ORD-2024-<span id="orderId"></span>
        </div>
    </div>

    <script>
        // Definir data atual
        document.getElementById('transactionDate').textContent = new Date().toLocaleDateString('pt-BR');

        // Gerar ID do pedido aleatório
        document.getElementById('orderId').textContent = Math.random().toString(36).substr(2, 8).toUpperCase();

        // Criar partículas flutuantes
        function createParticles() {
            const particles = document.getElementById('particles');
            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 4) + 's';
                particles.appendChild(particle);
            }
        }

        createParticles();

        // Adicionar confete 
        function createConfetti() {
            const colors = ['#ff007f', '#ffcbdb', '#ff78cb', '#d8abb1', '#b86b77'];
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = '-10px';
                confetti.style.width = '10px';
                confetti.style.height = '10px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear`;
                document.body.appendChild(confetti);

                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
        }

        // Adicionar animação de queda para confete
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fall {
                to {
                    transform: translateY(100vh) rotate(360deg);
                }
            }
        `;
        document.head.appendChild(style);

        // Executar confete após 1 segundo
        setTimeout(createConfetti, 1000);
    </script>
</body>

</html>