<?php
//tem que pegar num MT diferente do model User_data fazer a seleção do ultimo id 

// $nome = $data['user']['nome'];
$data['produto'] = $produto;
?>

<div class="container mt-5  justify-content-center">
    <?php if (empty($data['produto'])) : ?>
        <br>
        <h3>Não tem dados na tabela. Preencha agora mesmo -> <a href="?ct=main&mt=novo_produto">Aqui!</a></h3>
        <button><a href="?ct=main&mt=index">Voltar</a></button>
    <?php else : ?>

        <div class="container mt-5 text-center">
            <h1 class="text-center pb-4"><?= $produto['nome'] ?></h1>
            <!-- Link para o data_table
            <h2 class=" text-center ms-5"><a class="text-danger" href="?ct=main&mt=#">Tabela de produtos</a></h2> -->

        </div>

        <div class="row text-center justify-content-center">
            <div class="col-6 border rounded-2 border-dark border-4 mb-4 mx-4 ">
                <div class="container">
                    <p>
                    <h4>
                        <div hidden class="py-1 m-2 d-none">ID do Produto: <strong><?= $produto['id']; ?></strong></div>
                        <!-- <div class="py-1 m-2">Nome: <br><strong><?= $produto['nome'] ?></strong></div> -->
                        <div class="py-1 m-2">Descrição: <br><strong><?= $produto['descricao'] ?></strong></div>
                        <div class="py-1 m-2">Código do Produto: <br><strong><?= $produto['cod'] ?></strong></div>
                        <div class="py-1 m-2">Fabricante do Produto: <br><strong><?= $produto['fabricante'] ?></strong></div>
                        <div class="py-1 m-2">Categoria de: <br><strong><?= $produto['categoria'] ?></strong></div>
                        <div class="py-1 m-2">Quantidade do Produto: <br><strong><?= $produto['quantidade'] ?></strong></div>
                        <div class="py-1 m-2">Valor do Produto: <br><strong>R$<?= $produto['valor'] ?></strong></div>
                        <div class="py-1 m-2">Plataforma do Produto: <br><strong><?= $produto['plataforma'] ?></strong></div>
                        <div class="py-1 m-2">Garantia de: <strong><?= $produto['garantia'] ?> meses</strong></div>
                        <div class="py-1">Criado em: <strong><?= $produto['created_at'] ?></strong></div>
                        <a href="?ct=venda&mt=checkout&id=<?=$produto['id']?>">
                            <div class="py-1"><button class="btn  border p-2 mt-2 ">Vender</button></div>
                        </a>
                        <!-- link da pag do produto -->
                    </h4>
                    </p>
                    <!-- venda aqui para cada um com o id -->
                </div>
            </div>
        </div>


    <?php endif; ?>
</div>