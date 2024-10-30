
Este repositório contém o projeto ProjetoTesteVendas, uma aplicação desenvolvida em PHP 7.4.30. Abaixo, você encontrará as instruções necessárias para clonar, configurar e executar o projeto em seu ambiente local.

Pré-requisitos
PHP: versão 7.4.30
Composer: para gerenciar as dependências do PHP
MySQL ou outro banco de dados compatível

Nota sobre a Versão do PHP
Este projeto requer a versão PHP 7.4.30. Caso você esteja usando uma versão diferente e encontre problemas, siga estas instruções para reverter para a versão 7.4.30.

Alterar a Versão do PHP no Ambiente Local
Linux (com o gerenciador de pacotes apt):

  sudo apt update
  sudo apt install php7.4
  sudo update-alternatives --set php /usr/bin/php7.4


Windows:

  Baixe a versão PHP 7.4.30 em windows.php.net.
  Extraia o arquivo e atualize o caminho do PHP nas variáveis de ambiente para apontar para o diretório extraído.


Verifique a versão do PHP com:

  php -v

  Isso deve exibir a versão correta do PHP para o projeto (PHP 7.4.30).

Configuração
  Siga as etapas abaixo para configurar e executar o projeto.

1. Clonar o Repositório
  Escolha ou crie um diretório onde deseja manter o projeto e execute o comando abaixo para clonar o repositório:

  git clone https://github.com/marcoscornelius/vendaprodutos.git
  cd nome-do-repositorio

2. Configurar o Banco de Dados
  Crie um banco de dados para o projeto no MySQL (ou outro banco compatível):

  CREATE DATABASE projetotestevendas;

3. Configurar o Arquivo .env
  Dentro da pasta do projeto, altere o arquivo .env ou renomeie o arquivo .env.example para .env:

  Em seguida, abra o arquivo .env e ajuste as seguintes configurações de banco de dados:

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=projetotestevendas
  DB_USERNAME=seu_usuario
  DB_PASSWORD=sua_senha

  Nota: Substitua seu_usuario e sua_senha pelas credenciais do seu banco de dados.

4. Instalar as Dependências do Projeto
  Para instalar todas as dependências do projeto, execute o comando:
  
  composer install

5. Executar as Migrações
  Com o banco de dados configurado, execute as migrações para criar as tabelas necessárias no terminal com o comando:

  php artisan migrate

6. Executar o Projeto Localmente
  Inicie o servidor de desenvolvimento com o comando:
 
  php artisan serve

  O projeto estará disponível no navegador no endereço http://localhost:8000.


  