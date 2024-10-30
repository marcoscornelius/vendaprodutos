@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container home-container">
    <h1 class="home-title">Bem-vindo ao Projeto de venda de produtos</h1>
    <p class="home-paragraph">Explore os recursos desenvolvidos neste projeto e suas funcionalidades! Utilize o topbar para navegação entre as páginas.</p>

    <h2 class="section-title">Objetivo do Projeto</h2>
    <p>Esta aplicação foi projetada para demonstrar meu conhecimento na criação de funcionalidades, controladores, funções, rotas, tabelas, páginas, etc., utilizando tecnologias como Laravel (PHP), JQuery (JavaScript), HTML, CSS e banco de dados SQL. Simulando um website fictício
       com intenção de ajudar a gerenciar a venda de produtos, vinculando-os com respectivos clientes e vendedores, armazenando informações como preços do produto na hora da venda e acréscimos percentuais em vendas parceladas.</p>

    <h2 class="section-title">Principais Funcionalidades</h2>
    <ul class="list-style">        
        <li class="list-item">• Cadastrar/Editar/Excluir uma nova venda informando os produtos vendidos, parcelas, forma de pagamento e cliente (opcional)</li>
        <li class="list-item">• Logar/Deslogar/Registrar/Editar usuário (neste caso, vendedor)</li>
        <li class="list-item">• Criar/Editar/Excluir clientes</li>
        <li class="list-item">• Listar vendas com filtros e clientes</li>
        <li class="list-item">• Navegação entre páginas utilizando rotas</li>
    </ul>

    <h2 class="section-title">Caracteristicas estruturais</h2>
    <ul class="list-style">             
        <li class="list-item">• Criação de tabelas utilizando migrações</li>
        <li class="list-item">• Utilização de bibliotecas externas</li>
        <li class="list-item">• Utilização da estrutura MVC Laravel</li>
        <li class="list-item">• Deleção de vendas em cascata</li>
        <li class="list-item">• Ao deletar um cliente o desvincula das vendas pelo controller</li>
        <li class="list-item">• Responsividade</li>
    </ul>

    <h2 class="section-title">Comece Agora</h2>
    <p>Pronto para explorar? <a href="{{ route('products.products') }}" class="link-style">Confira a seção de venda de produtos!</a></p>

 
    <h2 class="section-title">Observações do Desenvolvedor</h2>
        <p>Algumas funcionalidades interessantes não foram implementadas por ser um projeto fictício, como modais, labels, etc...</p>
        <p>Este projeto foi desenvolvido em menos de 48h.</p>
    
    <hr>
    <p>Em caso de dúvida ou sugestões, fique à vontade para Entrar em contato:
        <br>
        WhatsApp 55(54)999010774 ou E-mail: Marcoscornelius@hotmail.com
    </p>
</div>
@endsection