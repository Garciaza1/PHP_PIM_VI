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
<<<<<<< HEAD
                        <img src="<?= IMAGE_PATH . 'logo-gira.gif'?>" class="img-fluid me-3 rounded-5" style="height: 46px;">
=======
                        <img src="<?= IMAGE_PATH . 'KEVIN-1_vetor2.png'?>" class="img-fluid me-3" style="height: 46px;">
>>>>>>> 3d38b6a0dae6c765a0f77f1d0df78537f4dc4e44
                        <h2><strong><?= APP_NAME ?></strong></h2>
                    </div>
                    <hr>

                    <h2 class="text-center p-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><strong>CADASTRO</strong></h2>

                        <form action="?ct=main&mt=cadastro_submit" method="post" >
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>"><!-- token -->
                        
                        <div class="row mb-3">
                            <div class="mb-5">
                                <label for="text_name" class="form-label">Nome</label>
                                <input type="text" name="text_name" id="text_name" value="" class="form-control" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="text_email" class="form-label">Email</label>
                                <input type="email" name="text_email" id="text_email" value="" class="form-control" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="text_senha" class="form-label">Senha</label>
                                <input type="password" name="text_senha" id="text_senha" value="" class="form-control" required>
                            </div>

                                <div class="col-12 text-center my-5">
                                    <div>Grau / Tipo</div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio_type" id="radio_n" value="Normal" checked>
                                        <label class="form-check-label" for="radio_n">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio_type" id="radio_g" value="Gestor">
                                        <label class="form-check-label" for="radio_g">Gestor</label>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-3 text-center">
<<<<<<< HEAD
                                <a href="?ct=main&mt=index" class="btn btn-secondary"><i class="fa-solid fa-xmark me-2"></i>Cancelar</a>
=======
                                <a href="?ct=main&mt=home" class="btn btn-secondary"><i class="fa-solid fa-xmark me-2"></i>Cancelar</a>
>>>>>>> 3d38b6a0dae6c765a0f77f1d0df78537f4dc4e44
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

<script>
    flatpickr("#text_birthdate", {
        dateFormat: "d-m-Y"
    })
</script>