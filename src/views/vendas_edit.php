<?php
// printData($data['venda']);
$id = $data['venda'][0]['id'];
$cod_prod = $data['venda'][0]['cod_prod'];
$valor = $data['venda'][0]['valor'];
$id_produto = $data['venda'][0]['id_produto'];
$id_vendedor = $data['venda'][0]['id_vendedor'];
$id_cliente = $data['venda'][0]['id_cliente'];
$CPF = $data['venda'][0]['CPF'];
$categoria = $data['venda'][0]['categoria'];
$quantidade = $data['venda'][0]['quantidade'];
$sts_pay = $data['venda'][0]['sts_pay'];
$sts_sell = $data['venda'][0]['sts_sell'];
$mtd_pay = $data['venda'][0]['mtd_pay'];
$CEP = $data['venda'][0]['CEP'];
$endereco = $data['venda'][0]['endereco'];
$num_residencia = $data['venda'][0]['num_residencia'];
?>

<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center pb-5">
        <div class="col-lg-8 col-md-10">
            <div class="card p-4">

                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="col-12 text-center">
                            <!-- <h2><strong><?= APP_NAME ?></strong></h2> -->
                            <img src="<?= IMAGE_PATH . 'logo-gira.gif' ?>" class="img-fluid me-3 rounded-5" style="height: 46px;">
                            <h2 class="text-center p-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><strong>EDITAR VENDA</strong></h2>
                            <hr>
                            <h3 class="text-center p-4 text-danger" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">PREENCHA TODOS OS CAMPOS</h3>
                        </div>


                        <form action="?ct=venda&mt=venda_edit_submit&id=<?= $id ?>" method="post">
                            <div class="row my-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="valor" class="form-label">Valor</label>
                                        <input type="number" step="0.01" name="text_valor" id="valor" value="<?= $valor ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="cod_prod" class="form-label">Código</label>
                                        <input type="text" name="text_cod_prod" id="cod_prod" value="<?= $cod_prod ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_produto" class="form-label">id_produto</label>
                                        <input type="number" name="text_id_produto" id="id_produto" value="<?= $id_produto ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_vendedor" class="form-label">id_vendedor</label>
                                        <input type="number" name="text_id_vendedor" id="id_vendedor" value="<?= $id_vendedor ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_cliente" class="form-label">id_cliente</label>
                                        <input type="number" name="text_id_cliente" id="id_cliente" value="<?= $id_cliente ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="CPF" class="form-label">CPF</label>
                                        <input type="text" name="text_CPF" id="CPF" value="<?= $CPF ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="categoria" class="form-label">categoria</label>
                                        <input type="text" name="text_categoria" id="categoria" value="<?= $categoria ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="quantidade" class="form-label">Quantidade</label>
                                        <input type="text" name="text_quantidade" id="quantidade" value="<?= $quantidade ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="sts_pay" class="form-label">Status de Pagamento</label>
                                        <input type="text" name="text_sts_pay" id="sts_pay" value="<?= $sts_pay ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="sts_sell" class="form-label">Status de Venda</label>
                                        <input type="text" name="text_sts_sell" id="sts_sell" value="<?= $sts_sell ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="mtd_pay" class="form-label">Método de Pagamento</label>
                                        <input type="text" name="text_mtd_pay" id="mtd_pay" value="<?= $mtd_pay ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="CEP" class="form-label">CEP</label>
                                        <input type="text" name="text_CEP" id="CEP" value="<?= $CEP ?>" class="form-control">
                                    </div>

                                    <div class="mb-3 ">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" name="text_endereco" id="endereco" value="<?= $endereco ?>" class="form-control">
                                    </div>

                                    <div class="mb-3 ">
                                        <label for="num_residencia" class="form-label">Número da Residencia</label>
                                        <input type="text" name="text_num_residencia" id="num_residencia" value="<?= $num_residencia ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="mt-3 text-center">
                                    <a href="?ct=main&mt=index" class="btn btn-secondary"><i class="fa-solid fa-xmark me-2"></i>Cancelar</a>
                                    <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-floppy-disk me-2"></i>Guardar</button>
                                </div>
                            </div>
                            <!-- tratamento de erros -->
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

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>