<?php

?>

<div class="container mt-5" >
    <h1>Tabela de Dados</h1>
    <?php if (empty($data['produtos'])): ?>
        <br>
        <h3>Não tem dados na tabela. Preencha agora mesmo -> <a href="?ct=main&mt=novo_produto">Aqui!</a></h3>
        <button class="button btn-secondary" type="button"><a href="?ct=main&mt=index ">voltar</a></button>
    <?php else: ?>
        <div class="table-container border border-3 border-dark rounded-2 p-2">
            <table class="table table-bordered table-dark table-striped mx-auto my-3" id="myTable" style="width: max-content;">
                <thead style="color: white;">
                <tr>
                    <th>Excluir</th>
                    <th>Editar</th>
                    <th>Comprar</th>
                    <th hidden>Id</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Fabricante</th>
                    <th>Garantia</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>Codigo</th>
                    <th>Plataforma</th>
                    <!-- <th>Criado Em</th> -->
                    <!-- <th>Atualizado Em</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Substitua $data pelos seus dados vindos do banco de dados
                foreach ($data['produtos'] as $row) : ?>
                    <tr>
                        <td class="text-center pt-3"><a href="?ct=main&mt=produto_delete&id=<?=$row['id']?>"><i class="fas fa-solid fa-trash"></i></a></td>
                        <td class="text-center pt-3"><a href="?ct=main&mt=produto_edit&id=<?=$row['id']?>"><i class="fas fa-solid fa-pen-to-square"></i></a></td>
                        <td class="text-center pt-3"><a href="?ct=venda&mt=checkout&id=<?=$row['id']?>"><i class="fas fa-solid fa-check"></i></a></td>
                        <td hidden><?=$row['id'] ?></td>
                        <td><?=$row['nome'] ?></td>
                        <td><?=$row['descricao'] ?></td>
                        <td><?=$row['fabricante'] ?></td>
                        <td><?=$row['garantia'] ?> Meses</td>
                        <td>R$<?=$row['valor'] ?></td>
                        <td class="text-center"><?=$row['quantidade'] ?></td>
                        <td><?=$row['cod'] ?></td>
                        <td><?=$row['plataforma'] ?></td>
                        <!-- <td><?=$row['created_at'] ?></td> -->
                        <!-- <td><?=$row['updated_at'] ?></td> -->
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="container text-center mt-4">
        tabela de intens excluidos -> <a href="#"><i class="fa-solid fa-trash-can"></i></a>
    </div>
    <?php endif; ?>
</div>

<script>

// $(document).ready(function() {
//     new DataTable('#myTable',{
//         order: [[12, 'desc']]
//     });
// });


    
</script>