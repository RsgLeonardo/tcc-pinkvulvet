<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/principal.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
  <title>| Cadastrar/login</title>
</head>

<body>
  <?php include '../header/header.php'; ?>
  <div class="main-content">
    <div class="bordinha mx-auto max-w-2xl px-4 py-12 sm:px-6 lg:max-w-3xl lg:px-8  shadow-md" style="margin-top: 120px !important;">
      <div class="text-center mb-12">
        <h2 class="text-xl text-gray-800">Como deseja continuar?</h2>
      </div>

      <div class="flex flex-col items-center space-y-6">
        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/cadastro-login/login/form_login.php" class="botaun flex items-center justify-center">
          <i class="fas fa-sign-in-alt mr-3"></i>
          Já sou cliente
        </a>

        <p class="text-gray-500">ou</p>

        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/cadastro-login/cadastro/cadastro-de-conta.php" class="botaun flex items-center justify-center">
          <i class="fas fa-user-plus mr-3"></i>
          Criar nova conta
        </a>

        <div class="mt-8 text-sm text-gray-500 max-w-lg text-center">
          <p>Ao acessar ou criar uma conta, você concorda com nossos <a href="#" class="underline hover:text-black">Termos de Serviço</a> e <a href="#" class="underline hover:text-black">Política de Privacidade</a>.</p>
        </div>
      </div>
    </div>

    <div class="mt-8 max-w-2xl mx-auto px-4 text-center">
      <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-medium text-gray-900">Vantagens de criar uma conta</h3>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="flex flex-col items-center p-3">
            <div class="text-2xl mb-2 text-gray-800">
              <i class="fas fa-truck"></i>
            </div>
            <h4 class="font-medium">Acompanhe seus pedidos</h4>
            <p class="text-sm text-gray-600">Monitore seus envios em tempo real</p>
          </div>
          <div class="flex flex-col items-center p-3">
            <div class="text-2xl mb-2 text-gray-800">
              <i class="fas fa-heart"></i>
            </div>
            <h4 class="font-medium">Lista de favoritos</h4>
            <p class="text-sm text-gray-600">Salve produtos para comprar depois</p>
          </div>
          <div class="flex flex-col items-center p-3">
            <div class="text-2xl mb-2 text-gray-800">
              <i class="fas fa-percent"></i>
            </div>
            <h4 class="font-medium">Ofertas exclusivas</h4>
            <p class="text-sm text-gray-600">Receba promoções especiais para clientes</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="marge" style="margin-bottom: 80px;"></div>
  <?php include '../footer/footer.php'; ?>
</body>

</html>