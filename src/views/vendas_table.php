<?php
$tipo_usuario = $data['user']['tipo'];
?>
<div class="container mt-5">
    <h1>Tabela de Dados</h1>
    <?php if (empty($data['vendas'])) : ?>
        <br>
        <h3>Não tem dados na tabela. Preencha agora mesmo -> <a href="?ct=main&mt=cadastro_cliente">Aqui!</a></h3>
        <button class="button btn-secondary" type="button"><a href="?ct=main&mt=index ">voltar</a></button>
    <?php else : ?>
        <div class="table-container  table-responsive border border-3 border-dark rounded-2 p-2">
            <table class="table table-bordered table-dark table-striped mx-auto my-3" id="myTable" style="width: max-content;">
                <thead style="color: white;">
                    <tr>
                        <?php if ($tipo_usuario == "Gerente") : ?>
                            <th>Cancelar</th>
                            <th>Restaurar</th>
                            <th>Editar</th>
                        <?php endif; ?>
                        <th hidden>Id</th>
                        <th>Código</th>
                        <th>Valor</th>
                        <th>Id Produto</th>
                        <th>Id Vendedor</th>
                        <th>Id Cliente</th>
                        <th>CPF</th>
                        <th>Categoria</th>
                        <th>Quantidade</th>
                        <th>Status Pagamento</th>
                        <th>Status Venda</th>
                        <th>Método de Pagamento</th>
                        <th>CEP</th>
                        <th>Endereço</th>
                        <th>Número Res.</th>
                        <th>Criado Em</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['vendas'] as $row) : ?>
                        <tr class="text-center">
                            <?php if ($tipo_usuario == "Gerente") : ?>
                                <!-- CANCELAR COMPRA -->
                                <?php if ($row['sts_pay'] == 'Confirmado') : ?>
                                    <td class="text-center"><a href="?ct=venda&mt=cancelar_venda&id=<?= $row['id'] ?>&produto=<?=$row['id_produto']?>"><i class="fas fa-trash"></i></a></td>
                                <?php else : ?>
                                    <td class="text-center"><i class="fas fa-trash"></i></td>
                                <?php endif; ?>
                                
                                <!-- RESTAURAR COMPRA -->
                                <?php if($row['sts_pay'] == 'Cancelado'):?>
                                    <td class="text-center"><a href="?ct=venda&mt=vendas_restaurar&id=<?= $row['id'] ?>"><i class="fas fa-pen-to-square"></i></a></td>
                                    <?php else : ?>
                                        <td class="text-center"><i class="fas fa-pen-to-square"></i></td>
                                    <?php endif; ?>
                                    
                                <td class="text-center"><a href="?ct=venda&mt=vendas_edit&id=<?= $row['id'] ?>"><i class="fas fa-pen"></i></a></td>
                            <?php endif; ?>
                            <td hidden><?= $row['id'] ?></td>
                            <td><?= $row['cod_prod'] ?></td>
                            <td><?= $row['valor'] ?></td>
                            <td><?= $row['id_produto'] ?></td>
                            <td><?= $row['id_vendedor'] ?></td>
                            <td><?= $row['id_cliente'] ?></td>
                            <td><?= $row['CPF'] ?></td>
                            <td><?= $row['categoria'] ?></td>
                            <td><?= $row['quantidade'] ?></td>
                            <td><?= $row['sts_pay'] ?></td>
                            <td><?= $row['sts_sell'] ?></td>
                            <td><?= $row['mtd_pay'] ?></td>
                            <td><?= $row['CEP'] ?></td>
                            <td><?= $row['endereco'] ?></td>
                            <td><?= $row['num_residencia'] ?></td>
                            <td><?= $row['created_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</div>