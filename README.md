# 💄 Pink Velvet

> **Trabalho de Conclusão de Curso (TCC)** - Uma plataforma de e-commerce completa voltada para a venda de produtos de maquiagem e beleza.

O **Pink Velvet** é uma loja virtual desenvolvida com foco na experiência do usuário e na facilidade de gerenciamento de vendas. O sistema foi projetado levando em consideração atributos essenciais de qualidade de software, garantindo boa manutenibilidade e eficiência nas operações da loja.

## ✨ Funcionalidades

* **Gestão de Usuários:** Cadastro, login e autenticação para que os clientes tenham controle de seus perfis e histórico.
* **Catálogo e Pesquisa:** Sistema de busca para localizar rapidamente bases, batons, paletas e outros produtos de beleza.
* **Carrinho e Fluxo de Compras:** Processo completo de e-commerce, permitindo a adição de múltiplos produtos ao carrinho e finalização do pedido.
* **Banco de Dados Relacional:** Estrutura de dados robusta para assegurar a integridade do controle de estoque, registro de transações e dados de clientes.

## 🛠️ Tecnologias Utilizadas

* **Frontend:** HTML5, CSS3, JavaScript *(Nota: Atualize aqui se usou algum framework como React, Vue ou Bootstrap)*.
* **Backend:** *(Nota: Insira aqui a linguagem/framework utilizado, ex: Node.js, PHP, Java, Python)*.
* **Banco de Dados:** MySQL.

## 🗄️ Estrutura do Banco de Dados (MySQL)

O esquema do banco de dados foi modelado para integrar o gerenciamento de inventário e contas, baseando-se em tabelas principais como:
* `usuarios`: Armazena dados de conta, senhas e informações de contato.
* `produtos`: Gerencia as maquiagens cadastradas, preços e quantidade em estoque.
* `pedidos` / `itens_pedido`: Registra o histórico das compras finalizadas e os produtos atrelados a cada transação.

## 🚀 Como Executar o Projeto Localmente

1. Clone este repositório em sua máquina:
   ```bash
   git clone https://github.com/seu-usuario/pink-velvet.git
   ```
2. Configure o banco de dados **MySQL**:
   * Crie um banco de dados chamado `pink_velvet`.
   * Importe o script de criação das tabelas (ex: `schema.sql` ou `database.sql` incluído no projeto).
3. Configure as credenciais de conexão com o banco de dados no arquivo de configuração do backend.
4. Instale as dependências necessárias e inicie o servidor:
   ```bash
   # Exemplo genérico, ajuste de acordo com o seu backend
   npm install
   npm start
   ```

## 📝 Autoria
Projeto desenvolvido como Trabalho de Conclusão de Curso (TCC).
