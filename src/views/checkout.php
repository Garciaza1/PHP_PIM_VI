<?php
// printData($data['cliente'][0]['id']);
?>

<div class="container justify-content-center col-6">
    <div class="row justify-content-center align-itens-center my-4">
        <form action="?ct=venda&mt=processamento&id=<?=$data['cliente'][0]['id']?>&produto=<?=$data['produto']['id']?>&user=<?=$data['user']['id']?>" method="post" class="form border rounded-3 justify-content-center text-center">

            <div class="container justify-content-center col-6 my-3">
                <div class="mb-3">
                    <label class="form-label" for="text_endereco">Endereço de Entrega:*</label>
                    <input type="text" name="text_endereco" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="text_num_residencia">Número:*</label>
                    <input type="number" name="text_num_residencia" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="text_CEP">CEP:*</label>
                    <input type="text" name="text_CEP" class="form-control">
                </div>
            </div>
            <div class="container justify-content-center col-6 my-3">
                <div class="mb-3">
                    <label class="form-label">Método de Pagamento:*</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="text_mtd_pay" value="Debito">
                            <label class="form-check-label" for="Debito">Débito</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="text_mtd_pay" value="Credito">
                            <label class="form-check-label" for="Credito">Crédito</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="text_mtd_pay" value="Boleto">
                            <label class="form-check-label" for="Boleto">Boleto</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="text_mtd_pay" value="Pix">
                            <label class="form-check-label" for="Pix">Pix</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn border m-2">Confirmar Compra!</button>
            </div>
        </form>
    </div>
</div>