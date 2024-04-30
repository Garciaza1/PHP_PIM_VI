<!--
    chekout e depois procurar por cpf se exitir um continuase nao faz cadastro e continua
    tem que ter procesamento de venda e tabela para poder cancelar depois 
    ao clicar na lixeira colocar um valiudation error avisdando que ja cancelou a compra e colocar na tabela o validator
    e colocar no controller tb tabela e no metodo cancelar venda
    Ao clicar no botão, processe o pedido, atualize o estoque dos produtos, 
    gere uma fatura e envie uma confirmação de pedido para o cliente.
    controller de processamento de pedido deixando a quantidade -1
    
-->
<?php
// printData($data);
$produto_id = $data['produto']['id'];
$user_id = $data['user']['id'];
// echo $user_id,"<br>", $produto_id; 
?>

<div class="main container">
    
    <div class="row my-5">
        item xpto
        confirmação do produto
    </div>


    <div class="row mt-3">

        <div class="container">
            <h1>Tabela de Clintes</h1>
            <?php if (empty($data['clientes'])) : ?>
                <br>
                <h3>Não tem dados na tabela. Preencha agora mesmo -> <a href="?ct=main&mt=cadastro_cliente">Aqui!</a></h3>
                <button class="button btn-secondary" type="button"><a href="?ct=main&mt=index ">voltar</a></button>
            <?php else : ?>
                <div class="table-container border border-3 border-dark rounded-2 p-2">
                    <table class="table table-bordered table-dark table-striped mx-auto my-3" id="myTable" style="width: max-content;">
                        <thead style="color: white;">
                            <tr>
                                <th>selecionar</th>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>RG</th>
                                <th>Telefone</th>
                                <th>Endereço</th>
                                <th>Criado Em</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['clientes'] as $row) : ?>
                                <tr>
                                    <td class="text-center pt-3"><a href="?ct=venda&mt=checkout_form&id=<?=$row['id']?>&produto=<?=$produto_id?>"><i class="fas fa-solid fa-check"></i></a></td>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['nome'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['CPF'] ?></td>
                                    <td><?= $row['RG'] ?></td>
                                    <td><?= $row['telefone'] ?></td>
                                    <td><?= $row['endereco'] ?></td>
                                    <td><?= $row['created_at'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="container text-center mt-4">
                    <!-- abrir um modal de cadastro e recarregar a pagina -->
                    Cadastrar Cliente -> <a href="?ct=main&mt="><i class="fa-solid fa-user-tag"></i></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <?php if (!empty($validation_errors)) : ?>
        <div class="alert alert-danger p-2 text-center">
            <?php foreach ($validation_errors as $error) : ?>
                <div><?= $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($server_error)) : ?>
        <div class="alert alert-danger p-2 text-center">
            <div><?= $server_error ?></div>
        </div>
    <?php endif; ?>
</div>