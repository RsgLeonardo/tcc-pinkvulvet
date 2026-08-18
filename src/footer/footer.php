<!DOCTYPE html>

<head>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />

  <style>
    nav.list-none li a:hover {
      color: black !important;
    }
  </style>
</head>

<body>
  <!-- att: mandar codigo de confirmacao para whats e mensagens
   email: apenas uma msg de obrigada
   permitir apenas numeros
   validar email com @
   validar numero
   -->
  <hr style="margin-top: 50px;">
  <footer class="text-gray-600 body-font" style="background-color:rgb(255, 255, 255) !important;">
    <div
      class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
      <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left logo-container">
        <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
          <img src="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/logo-nova.svg" alt="Logo Pink Vulvet" style="margin-top: -30px !important;">
        </a>
      </div>

      <div class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center">
        <div class="lg:w-1/4 md:w-1/2 w-full px-4">
          <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">INFORMAÇÕES DA EMPRESA</h2>
          <nav class="list-none mb-10">
            <li class="links">
              <a href="http://" target="_blank" rel="noopener noreferrer">Sobre PV</a>
            </li>
            <li>
              <a href="http://" target="_blank" rel="noopener noreferrer">Política de Privacidade</a>
            </li>
          </nav>
        </div>
        <div class="lg:w-1/4 md:w-1/2 w-full px-4">
          <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">AJUDA E SUPORTE</h2>
          <nav class="list-none mb-10">
            <li>
              <a href="http://shein.com" target="_blank" rel="noopener noreferrer">Como Pedir</a>
            </li>
            <li>
              <a href="http://" target="_blank" rel="noopener noreferrer">Metódos de Pagamento</a>
            </li>
            <li>
              <a href="http://" target="_blank" rel="noopener noreferrer">Contate-Nos</a>
            </li>
          </nav>
        </div>
        <!-- <div class="lg:w-1/4 md:w-1/2 w-full px-4">
              col
            </div> -->
        <div class="lg:w-1/8 md:w-1/2 w-full px-4">
          <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CADASTRE-SE PARA RECEBER NOTÍCIA
            SOBRE PV</h2>
          <form action="https://formspree.io/f/xanolbzz" method="POST" class="space-y-4">
            <div class="flex items-center">
              <input type="email" name="email" placeholder="Seu e-mail"
                class="flex-grow px-3 py-2 border focus:outline-none" />
              <button type="submit"
                class="bg-black text-white px-4 py-2 transition duration-300 hover:bg-gray-300 hover:text-black">Enviar</button>
            </div>

            <div class="flex items-center">
              <input type="tel" placeholder="Telefone" class="flex-grow px-3 py-2 border focus:outline-none" />
              <button type="submit"
                class="bg-black text-white px-4 py-2 transition duration-300 hover:bg-gray-300 hover:text-black">Enviar</button>
            </div>
            <div class="flex items-center">
              <input type="tel" placeholder="WhatsApp" class="flex-grow px-3 py-2 border focus:outline-none" />
              <button type="submit"
                class="bg-black text-white px-4 py-2 transition duration-300 hover:bg-gray-300 hover:text-black">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="bg-gray-100" style="background-color:#D6D6D6 !important;">
      <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
        <p class="text-gray-500 text-sm text-center sm:text-left">© 2025 - Todos os Direitos Reservados PV
        </p>

        <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
          <p style="margin-right: 10px;"><b>Siga-nos nas redes socias:</b></p>
          <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
            class="text-gray-500 hover:text-blue-500 transition-colors">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
              viewBox="0 0 24 24">
              <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
            </svg>
          </a>
          <a href="https://www.x.com" target="_blank" rel="noopener noreferrer"
            class="ml-3 text-gray-500 hover:text-black transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
              <path
                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
            </svg>
          </a>
          <a href="https://instagram.com" target="_blank" rel="noopener noreferrer"
            class="ml-3 text-gray-500 hover:text-pink-500 transition-colors">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              class="w-5 h-5" viewBox="0 0 24 24">
              <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
            </svg>
          </a>
        </span>
      </div>
    </div>
  </footer>
</body>

</html>