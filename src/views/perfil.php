<?php

// $csrf_token = bin2hex(random_bytes(32));
// $_SESSION['csrf_token'] = $csrf_token;


$nome = $data['user']['nome'];
$email = $data['user']['email'];
$tipo = $data['user']['tipo'];





?>


<div class="container-fluid p-5 ">
    <h1 class="ps-4 pb-4">Seu Perfil</h1>
    <div class="row m-3">
        <nav class="col-3 border rounded-2 border-dark border-4 d-flex justify-content-center">
            <div class="menu-header justfy-content-between text-center mb-2">
                <div>
                    <p class="p-1">
                    <h4>Dados atuais do cliente:</h4>

                    <br>Nome:<strong><?= ' ' .  $nome ?></strong><br>
                    <br>Email:<strong><?= ' ' .  $email ?></strong><br>
                    <br>Tipo:<strong><?= ' ' . $tipo ?></strong><br>
                    <hr>
                    <a class="btn border border-2 mt-2" href="#"><i data-fa-symbol="delete" class="fa-solid fa-trash fa-fw me-2"></i>DELETAR PERFIL</a>
                    <br>
                    <br>Depois de apertar não tem volta!
                </div>
            </div>
        </nav>

        <main class="col-8 ms-4 align-items-center border rounded-5 border-dark border-4 p-4 d-grid justify-content-center">

            <div class="container text-center pe-5 me-5">

                <h2 class="pb-2 fa-user-circle-o">Dados pessoais:</h2>

                <!-- alterar nome -->
                <section class="border border-secundary-subtle rounded-3 p-3 my-2 col-12">

                    <h5 class="card-title pb-1">Alterar nome:
                        <button class="btn btn-outline-secondary btn-sm ms-2 border-0 border-bottom" style="width: 8%;" id="abreNome">
                            ↧
                        </button>
                    </h5>

                    <form method="post" action="" class="form d-block d-none">
                        <div class="form-group">
                            <input type="text" class="form-control mb-2 mt-1" name="text_mudar_nome" id="mudar_nome"></input>
                            <?php
                                $csrf_token = bin2hex(random_bytes(32));
                                $_SESSION['csrf_token'] = $csrf_token;
                            ?>
                            <input hidden name="csrf_token" value="<?= $csrf_token ?>"><!-- token -->
                        </div>
                        <button type="submit" name="update_name" class="mudar_nome btn btn-primary mt-2 btn-sm">Mudar nome</button>

                    </form>

                </section>

                <!-- alterar email -->
                <section class="border border-secundary-subtle rounded-3 p-3 my-2 col-12">
                    <h5 class="card-title pb-1">Alterar email
                        <button class="btn btn-outline-secondary btn-sm ms-2 border-0 border-bottom" style="width: 8%" id="abreEmail">
                            ↧
                        </button>
                    </h5>
                    <form method="post" action="" class="form d-block d-none">
                        <div class="form-group">

                            <label for="email_antigo">Email antigo: </label>
                            <input type="email" class="form-control" name="text_email_antigo" id="email_antigo"></input>

                            <label for="email_novo">Email novo: </label>
                            <?php
                                $csrf_token = bin2hex(random_bytes(32));
                                $_SESSION['csrf_token'] = $csrf_token;
                            ?>
                            <input type="email" class="form-control" name="text_email_novo" id="email_novo"></input>
                            <input hidden name="csrf_token" value="<?= $csrf_token ?>"><!-- token -->
                            

                        </div>
                        <button type="submit" name="update_email" class="mudar_email btn btn-primary mt-2">Mudar email</button>
                    </form>

                </section>

                <!-- alterar senha  -->
                <section class="border border-secundary-subtle rounded-3 p-3 my-2 col-12">
                    <!-- colocar link pagina de troca de  senha -->
                    <h5 class="card-title pb-1">Alterar senha <button class="btn btn-outline-secondary btn-sm ms-2 border-0 border-bottom" style="width: 8%" id="abreSenha">
                            ↧
                        </button>
                    </h5>
                   
                        <button type="" name="update_senha" class="mudar_senha btn btn-primary mt-2"><a class="text-white" href="?ct=reset&mt=pass_recover_form">Mudar senha</a></button>
                
                </section>
            </div>
        </main>
    </div>
</div>