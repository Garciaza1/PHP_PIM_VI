
<div class="container mt-5">
    <h1>Tabela de Dados</h1>
    <?php if (empty($data['vendas'])): ?>
        <br>
        <h3>Não tem dados na tabela. Preencha agora mesmo -> <a href="?ct=main&mt=cadastro_cliente">Aqui!</a></h3>
        <button class="button btn-secondary" type="button"><a href="?ct=main&mt=index ">voltar</a></button>
    <?php else: ?>
        <div class="table-container border border-3 border-dark rounded-2 p-2">
            <table class="table table-bordered table-dark table-striped mx-auto my-3" id="myTable" style="width: max-content;">
                <thead style="color: white;">
                    <tr>
                        <!-- <th>Excluir</th>
                        <th>Editar</th> -->
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
                            <!-- <td class="text-center pt-3"><a href="?ct=main&mt=produto_delete&id=<?=$row['id']?>"><i class="fas fa-solid fa-trash"></i></a></td>
                            <td class="text-center pt-3"><a href="?ct=main&mt=produto_edit&id=<?=$row['id']?>"><i class="fas fa-solid fa-pen-to-square"></i></a></td> -->
                            <td><?=$row['id'] ?></td>
                            <td><?=$row['nome'] ?></td>
                            <td><?=$row['email'] ?></td>
                            <td><?=$row['CPF'] ?></td>
                            <td><?=$row['RG'] ?></td>
                            <td><?=$row['telefone'] ?></td>
                            <td><?=$row['endereco'] ?></td>
                            <td><?=$row['created_at'] ?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="container text-center mt-4">
            Cadastrar Cliente -> <a href="?ct=main&mt=cadastro_cliente"><i class="fa-solid fa-user-tag"></i></a>
        </div>
    <?php endif; ?>
</div>