<?php

    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

?>

<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center pb-5">
        <div class="col-lg-8 col-md-10">
            <div class="card p-4">

                <div class="row justify-content-center">
                    <div class="col-10">
                    <div class="col-12 text-center">
                        <img src="<?= IMAGE_PATH . 'logo-gira.gif'?>" class="img-fluid me-3 rounded-5" style="height: 46px;">
                        <h2><strong><?= APP_NAME ?></strong></h2>
                    </div>
                    <hr>

                    <h2 class="text-center p-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><strong>CADASTRO</strong></h2>

                        <form action="?ct=main&mt=cadastro_cliente_submit" method="post">
                        <!-- token -->
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        
                        <div class="row mb-3">
                            <div class="mb-3 col-6">
                                <label for="text_name" class="form-label ">Nome</label>
                                <input type="text" name="text_name" id="text_name" placeholder="Juca" class="form-control" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="text_email" class="form-label">Email</label>
                                <input type="email" name="text_email" id="text_email" placeholder="juca@gmail.com" class="form-control" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="text_cpf" class="form-label">CPF</label>
                                <input type="text" name="text_cpf" id="text_cpf" placeholder="512345554-12" class="form-control" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="text_cpf" class="form-label">RG</label>
                                <input type="text" name="text_RG" id="text_cpf" placeholder="512345554-1" class="form-control" required>
                            </div>

                            <div class="mb-3 col-6 mb-5">
                                <label for="text_telefone" class="form-label">Telefone</label>
                                <input type="text" name="text_telefone" id="text_telefone" placeholder="11945645658" class="form-control" required>
                            </div>

                            <div class="mb-3 col-6 mb-5">
                                <label for="text_endereco" class="form-label">Endereço</label>
                                <input type="text" name="text_endereco" id="text_endereco" placeholder="R. xpto São Paulo, SP" class="form-control" required>
                            </div>


                            <div class="mb-3 text-center">
                                <a href="?ct=main&mt=clientes" class="btn btn-secondary"><i class="fa-solid fa-xmark me-2"></i>Cancelar</a>
                                <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-floppy-disk me-2"></i>Guardar</button>
                            </div>

                            <?php if (isset($validation_errors)) : ?>
                                <div class="alert alert-danger p-2">
                                    <ul>
                                        <?php foreach ($validation_errors as $error) : ?>
                                            <li><?= $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($server_error)) : ?>
                                <div class="alert alert-danger p-2 text-center">
                                    <?= $server_error ?>
                                </div>
                            <?php endif; ?>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
