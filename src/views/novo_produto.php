<?php
if ($_SESSION) {

    $_SESSION['user'] = $data['user'];
    $user_id = $data['user']['id'];
    $tipo = $data['user']['tipo'];
    $random_numbers = '';
    for ($i = 0; $i < 13; $i++) {
        $random_numbers .= mt_rand(0, 9); // Gera um número aleatório de 0 a 9 e concatena à string
    }}
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


                        <form action="?ct=main&mt=produto_submit" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_nome" class="form-label">Nome produto</label>
                                        <input type="text" name="text_nome" id="text_nome" placeholder="metalgear - XI" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="text_desc" class="form-label">Descrição do produto</label>
                                        <textarea name="text_desc" id="text_desc" placeholder="um jogo x, y, z, de xxxx personagem faz yyyy! " class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_fab" class="form-label">Fabricante</label>
                                        <input type="text" name="text_fab" id="text_fab" placeholder="90" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="text_garant" class="form-label">Garantia em meses</label>
                                        <input type="number" name="text_garant" id="text_garant" placeholder="56" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_valor" class="form-label">Valor</label>
                                        <input type="number" step="0.01" name="text_valor" id="text_valor" placeholder="37.50" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="text_qntd" class="form-label">Quantidade</label>
                                        <input type="number" name="text_qntd" id="text_qntd"  class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_cod" class="form-label">Codigo de barras / cod. do produto</label>
                                        <input type="text" value="<?= $random_numbers ?>" name="text_cod" id="text_cod" class="form-control">
                                    </div>
                                    <label class="form-label">Plataforma:</label>
                                    <div class="mb-3 row">

                                        <div class="col-6">
                                            <div class="form-check mx-4">
                                                <input class="form-check-input" type="checkbox" name="text_plat[]" value="Nintendo ">
                                                <label class="form-check-label" for="text_plat">Nintendo</label>
                                            </div>
                                            <div class="form-check mx-4">
                                                <input class="form-check-input" type="checkbox" name="text_plat[]"  value="Micrsoft ">
                                                <label class="form-check-label" for="text_plat">Micrsoft</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-check mx-4">
                                                <input class="form-check-input" type="checkbox" name="text_plat[]" value="Sony ">
                                                <label class="form-check-label" for="text_plat">Sony</label>
                                            </div>
                                            <div class="form-check mx-4">
                                                <input class="form-check-input" type="checkbox" name="text_plat[]" value="Outro ">
                                                <label class="form-check-label" for="text_plat">Outro</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3 d-flex">
                                        <label class="form-label">Categoria:</label>
                                        <div class="form-check mx-4">
                                            <input class="form-check-input" type="radio" name="text_categoria" id="categoria_geek" value="Geek">
                                            <label class="form-check-label" for="categoria_geek">Geek</label>
                                        </div>
                                        <div class="form-check mx-4">
                                            <input class="form-check-input" type="radio" name="text_categoria" id="categoria_jogo" value="Jogos">
                                            <label class="form-check-label" for="categoria_jogo">Jogos</label>
                                        </div>
                                        <div class="form-check mx-4">
                                            <input class="form-check-input" type="radio" name="text_categoria" id="categoria_variado" value="Variados">
                                            <label class="form-check-label" for="categoria_variado">Variado</label>
                                        </div>

                                    </div>
                                </div>

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