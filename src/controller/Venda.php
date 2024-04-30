<?php

namespace PIM_VI\Controllers;

use PIM_VI\Controllers\BaseController;
use PIM_VI\Models\Main as ModelsMain;
use PIM_VI\Models\ProductModel;
use PIM_VI\Models\ClientModel;
use PIM_VI\Models\VendaModel;
use PIM_VI\Controllers\Main;

class Venda extends BaseController
{

    public function checkout($item_id)
    {

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $main = new Main;
            $main->login();
            return;
        }

    
        $data['user'] = $_SESSION['user'];

        $model = new ProductModel();
        $data['produto'] = $model->get_product_data($item_id);

        $client = new ClientModel;
        $data['clientes'] = $client->get_clientes();

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('venda', $data);
        $this->view('shared/html_footer');
    }

    public function checkout_form($client_id)
    {

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $main = new Main;
            $main->login();
            return;
        }
        $data = [];

        if (!empty($_SESSION['validation_errors'])) {
            $data['validation_errors'] = $_SESSION['validation_errors'];
            unset($_SESSION['validation_errors']);
        }

        // check if there was an invalid login
        if (!empty($_SESSION['server_error'])) {
            $data['server_error'] = $_SESSION['server_error'];
            unset($_SESSION['server_error']);
        }

        $data['user'] = $_SESSION['user'];
        $item_id = $_GET['produto'];


        $model = new ProductModel();
        $data['produto'] = $model->get_product_data($item_id);

        $client = new ClientModel;
        $data['cliente'] = $client->get_clientes($client_id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('checkout', $data);
        $this->view('shared/html_footer');
    }


    public function processamento($client_id, $item_id, $user_id)
    {
        // vai ficar tudo que precisa que afeta no model produto e cliente e venda 

        if (!check_session()) {
            $main = new Main;
            $main->login();
            return;
        }

        // Verifica se foi feita uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->checkout_form($client_id, $item_id, $user_id);
            return;
        }

        //valida todos os campos tendo que preenchelos.
        //mudar os campos
        $campos = ['endereco', 'num_residencia', 'CEP', 'mtd_pay'];
        foreach ($campos as $campo) {
            // Verifica se o campo está vazio
            if (empty($_POST['text_' . $campo])) {
                $validation_errors[] = ucfirst($campo) . ' é obrigatório.';
            }
        }

        $model_main = new ModelsMain;
        $client = new ClientModel;
        $main_controller = new Main;
        $product = new ProductModel;
        $venda = new VendaModel;

        $product->produto_qntd_edit($item_id);
        
        $venda->venda($_POST, $client_id, $item_id, $user_id);


        $main_controller->index();
        return;
    }
}
