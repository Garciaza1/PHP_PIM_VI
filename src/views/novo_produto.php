<?php
if ($_SESSION) {

    $_SESSION['user'] = $data['user'];
    $user_id = $data['user']['id'];
    $tipo = $data['user']['tipo'];
}
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
                            <h2 class="text-center p-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><strong>PRODUTO</strong></h2>
                            <hr>
                            <h3 class="text-center p-4 text-danger" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">PREENCHA TODOS OS CAMPOS</h3>
                        </div>


                        <form action="?ct=main&mt=produto_submit" method="post" >
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_nome" class="form-label">Nome produto</label>
                                        <input type="text" name="text_nome" id="text_nome" placeholder="metalgear - XI" class="form-control" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="text_desc" class="form-label">Descrição do produto</label>
                                        <textarea  name="text_desc" id="text_desc" placeholder="um jogo x, y, z, de xxxx personagem faz yyyy! " class="form-control" ></textarea>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_fab" class="form-label">Fabricante</label>
                                        <input type="text"  name="text_fab" id="text_fab" placeholder="90" class="form-control" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="text_garant" class="form-label">Garantia em meses</label>
                                        <input type="number" name="text_garant" id="text_garant" placeholder="56" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_valor" class="form-label">Valor</label>
                                        <input type="number" step="0.01" name="text_valor" id="text_valor" placeholder="37.50" class="form-control" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="text_qntd" class="form-label">Quantidade</label>
                                        <input type="number"  name="text_qntd" id="text_qntd" placeholder="1" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_cod" class="form-label">Codigo de barras / cod. do produto</label>
                                        <input type="text"  name="text_cod" id="text_cod" placeholder="0973thqg4gpaW84TRH" class="form-control" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="text_plat" class="form-label">Plataforma (caso não tenha colocar "N/A")</label>
                                        <input type="text"  name="text_plat" id="text_plat" placeholder="xbox-microsoft" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-6">

                                    <!-- <div class="mb-3">
                                        <label for="text_cinturaEscapular" class="form-label">Cintura Escapular / Ombros(ponta a ponta) (cm)</label>
                                        <input type="text"  name="text_cinturaEscapular" id="text_cinturaEscapular" placeholder="48" class="form-control" >
                                        <h6 class="text-danger">Apenas a metade<br>Se for 96cm divida por 2, coloque 48cm !</h6>
                                    </div> -->
                                </div>

                                <div class="col-12">
                                    <div class="mb-3 d-flex">
                                        <label class="form-label">Categoria:</label>
                                        <div class="form-check mx-4">
                                            <input class="form-check-input" type="radio" name="text_categoria" id="categoria_games" value="Games" checked>
                                            <label class="form-check-label" for="categoria_games">Games (tem haver com games)</label>
                                        </div>
                                        <div class="form-check mx-4">
                                            <input class="form-check-input" type="radio" name="text_categoria" id="categoria_geek" value="Geek">
                                            <label class="form-check-label" for="categoria_geek">Geek</label>
                                        </div>
                                        <div class="form-check mx-4">
                                            <input class="form-check-input" type="radio" name="text_categoria" id="categoria_jogo" value="Jogos" >
                                            <label class="form-check-label" for="categoria_jogo">Jogos</label>
                                        </div>
                                        <div class="form-check mx-4">
                                            <input class="form-check-input" type="radio" name="text_categoria" id="categoria_variado" value="Variados" >
                                            <label class="form-check-label" for="categoria_variado">Variado</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Já sabe o Basal ou body fat? -->
                                <section class="border border-secundary-subtle rounded-3 p-3 my-2 col-12">
                                    
                                    <h5 class="card-title pb-1">Codigo de barras automatico 
                                        <button type="reset" class="btn btn-outline-secondary btn-sm ms-2 border-0 border-bottom" style="width: 8%;" id="abreNome">
                                            ↧
                                        </button>
                                    </h5>

                                    <div class="mb-3 d-none">
                                    <!--  AQUI VAI FICAR O COD DE BARRAS AUTOMATICO -->
                                        <div>
                                            AQUI VAI FICAR O COD DE BARRAS AUTOMATICO
                                        </div>

                                    </div>

                                </section>

                                <div class="mb-3 text-center">
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