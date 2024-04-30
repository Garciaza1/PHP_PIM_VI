<?php

namespace PIM_VI\Controllers;

use PIM_VI\Controllers\BaseController;
use PIM_VI\Models\Main as ModelsMain;
use PIM_VI\Models\ProductModel;
use PIM_VI\Models\ClientModel;

class Main extends BaseController
{

    public function home() //PUBLICO
    {

        // check if there is no active user in session and blocks if hasn't
        if (check_session()) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }



        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('home_page');
        $this->view('shared/html_footer');
    }

    // =======================================================     
    public function acesso_negado()
    {

        if (isset($_SESSION['erro'])) $data['erro'] = $_SESSION['erro'];
        $data['request'] = $_REQUEST;
        $data['session'] = $_SESSION;
        $data['cookie'] = $_COOKIE;
        $data['get'] = $_GET;

        $this->view('shared/html_header');
        $this->view('acesso_negado', $data);
        $this->view('shared/html_footer');
    }

    // ======================================================= 
    public function index()
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];



        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('home', $data);
        $this->view('shared/html_footer');
    }

    // ======================================================= 
    public function login()
    {
        // check if there is already a user in the session
        if (check_session()) {
            $this->index();
            return;
        }

        // check if there are errors (after login_submit)
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

        // display login form
        $this->view('shared/html_header');
        $this->view('login', $data);
        $this->view('shared/html_footer');
    }

    // ======================================================= 
    public function login_submit()
    {

        // check if there is already an active session
        if (check_session()) {
            $this->index();
            return;
        }

        // check if there was a post request
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // form validation
        $validation_errors = [];
        if (empty($_POST['text_email']) || empty($_POST['text_password'])) {
            $validation_errors[] = "Email e password são obrigatórios.";
        }

        // get form data
        $email = $_POST['text_email'];
        $password = $_POST['text_password'];

        // check if username is valid email and between 5 and 50 chars
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation_errors[] = 'O email tem que ser válido.';
        }

        // check if username is between 5 and 50 chars
        if (strlen($email) < 5 || strlen($email) > 50) {
            $validation_errors[] = 'O email deve ter entre 5 e 50 caracteres.';
        }

        // check if password is valid
        if (strlen($password) < 6 || strlen($password) > 12) {
            $validation_errors[] = 'A password deve ter entre 6 e 12 caracteres.';
        }


        // check if there are validation errors
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->login();
            return;
        }

        $model = new ModelsMain();
        $result = $model->verificar_login($email, $password);

        //LOGIN VALIDO 
        if ($result['status']) {

            //load user information to the session
            $results = $model->get_user_data($email);
            // add user to session
            if (!empty($results)) {
                $_SESSION['user'] = $results[0]; // Armazena todos os resultados na sessão 'user'
            }
            // go to main page
            $this->index();
        }

        //login invalido
        else {

            $_SESSION['server_error'] = 'Login inválido.';
            $this->login();
            return;
        }
    }

    // ======================================================= 
    public function cadastro()
    {
        // check if there is already a user in the session
        if (check_session()) {
            $this->index();
            return;
        }
        // check if there are errors
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

        // display login form
        $this->view('shared/html_header', $data);
        $this->view('cadastro', $data);
        $this->view('shared/html_footer');
    }
    // ======================================================= 
    public function cadastro_submit()
    {

        if (check_session() || $_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // form validation
        $validation_errors = [];

        // text_name
        if (empty($_POST['text_name'])) {
            $validation_errors[] = "Nome é de preenchimento obrigatório.";
        } else {
            if (strlen($_POST['text_name']) < 3 || strlen($_POST['text_name']) > 50) {
                $validation_errors[] = "O nome deve ter entre 3 e 50 caracteres.";
            }
        }

        // type
        if (empty($_POST['radio_type'])) {
            $validation_errors[] = "É obrigatório definir o tipo.";
        }

        // senha
        if (empty($_POST['text_senha'])) {
            $validation_errors[] = "senha é de preenchimento obrigatório.";
        }


        // email
        if (empty($_POST['text_email'])) {
            $validation_errors[] = "Email é de preenchimento obrigatório.";
        } else {
            if (!filter_var($_POST['text_email'], FILTER_VALIDATE_EMAIL)) {
                $validation_errors[] = "Email não é válido.";
            }
        }

        // check if there are validation errors to return to the form
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->cadastro();
            return;
        }

        // check if the client already exists with the same name
        $model = new ModelsMain();
        $results = $model->check_if_user_exists($_POST);

        if ($results['status']) {

            // a person with the same name exists for this agent. Returns a server error
            $_SESSION['server_error'] = "Já existe um cliente com este email.";
            $this->cadastro();
            return;
        } else {

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                // add new client to the database
                $model->cadastrar_usuario($_POST);

                // return to the main clients page
                $this->login();
                return;
            } else {

                // a person with the same name exists for this agent. Returns a server error
                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->cadastro();
                return;
            }
        }
    }

    // ======================================================= 
    public function logout()
    {

        $_SESSION['user'] = null;
        session_destroy();

        // go to main page
        $this->index();
        exit();
    }





    // ========================================= APP CONTROLLER AQUI =======================================





    // =============== PERFIL CONTROLLER ===================

    public function perfil()
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        // check if there are errors (after login_submit)
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
        // $id = $_SESSION['user']['id'];

        // $model = new UserModel();
        // $data['user_data'] = $model->get_last_user_data($id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('perfil', $data);
        $this->view('shared/html_footer');
    }

    public function perfil_submit()
    {
        // check if there is already an active session
        if (!check_session()) {
            $this->index();
            return;
        }

        // check if there was a post request
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->perfil();
            return;
        }

        //UPDATE DO NOME =============
        if (isset($_POST['update_name'])) {

            if (empty($_POST['text_mudar_nome'])) {
                $validation_errors[] = "o nome precisa ser preenchido";
            }
            $nome = $_POST['text_mudar_nome'];

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                $model = new ModelsMain();
                $model->change_name($nome);

                $this->perfil();
                return;
            } else {
                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->perfil();
                return;
            }
        }

        //UPDATE DO SENHA =============
        // trocar de método para pagina so de senha
        if (isset($_POST['update_senha'])) {

            // get form data
            $senha_atual = $_POST['text_senha_atual'];
            if (!password_verify($_SESSION['user']['senha'], $senha_atual)) {
                $validation_errors[] = 'A password antiga não confere.';
            }


            $password = $_POST['text_senha_nova'];
            // check if password is valid
            if (strlen($password) < 6 || strlen($password) > 12) {
                $validation_errors[] = 'A password deve ter entre 6 e 12 caracteres.';
            }

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                $model = new ModelsMain();
                $model->change_name($password);

                $this->perfil();
                return;
            } else {

                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->perfil();
                return;
            }
        }

        // VALIDAÇÃO DO EMAIL =========
        if (isset($_POST['update_email'])) {


            // get form data
            $email = $_POST['text_email'];
            // check if username is valid email and between 5 and 50 chars
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation_errors[] = 'O email tem que ser válido.';
            }

            // check if username is between 5 and 50 chars
            if (strlen($email) < 5 || strlen($email) > 50) {
                $validation_errors[] = 'O email deve ter entre 5 e 50 caracteres.';
            }

            // check if there are validation errors
            if (!empty($validation_errors)) {
                $_SESSION['validation_errors'] = $validation_errors;
                $this->perfil();
                return;
            }

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                $model = new ModelsMain();
                $model->change_name($email);

                $this->perfil();
                return;
            } else {

                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->perfil();
                return;
            }
        }
    }
    
    // =============== PRODUTOS CONTROLLERS ==============================

    public function produto($id)
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        $model = new ProductModel();
        $results = $model->get_product_data($id);
        $data['produto'] = $results;

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('produto', $data);
        $this->view('shared/html_footer');
    }

    public function produtos()
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        // $id = $_SESSION['user']['id'];

        $model = new ProductModel();
        $results = $model->get_produtos();

        $data['produtos'] = $results;
        // printData($data['produtos']);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('produtos', $data);
        $this->view('shared/html_footer');
    }


    public function novo_produto() //aponta para o calculo_submit
    {

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
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

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('novo_produto', $data);
        $this->view('shared/html_footer');
    }

    public function produto_submit() //recebe de novas_medidas
    {


        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->index();
            return;
        }


        // Verifica se foi feita uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // Inicializa o array de erros de validação
        $validation_errors = [];

        //valida todos os campos tendo que preenchelos.
        $campos = ['nome', 'desc', 'fab', 'garant', 'valor', 'qntd', 'cod', 'plat'];
        foreach ($campos as $campo) {
            // Verifica se o campo está vazio
            if (empty($_POST['text_' . $campo])) {
                $validation_errors[] = ucfirst($campo) . ' é obrigatório.';
            }
        }

        // Validação do campo de meta
        if (empty($_POST['text_categoria'])) {
            $validation_errors[] = 'A categoria é obrigatória.';
        }


        // Se houver erros de validação, redireciona de volta ao formulário com os erros
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->novo_produto(); // ou o nome da função que exibe o formulário
            return;
        }

        $model = new ProductModel();
        $model->cadastrar_produto($_POST);

        $this->index();
        return;
    }



    public function produtos_table()
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        // $id = $_SESSION['user']['id'];

        $model = new ProductModel();
        $data['produtos'] = $model->get_produtos();

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('produtos_table', $data);
        $this->view('shared/html_footer');
    }

    public function produto_delete($item_id)
    {

        // Verifique se o ID foi passado
        if (!isset($_GET['id'])) {
            $_SESSION['erro'] = "Erro no Id passado!";
            $this->index();
            return;
        }

        $item_id = $_GET['id'];


        $model = new ProductModel();
        $model->soft_delete($item_id);

        $this->produtos_table();
        return;
    }


    public function produto_edit($item_id)
    {

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
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
        $item_id = $_GET['id'];

        $model = new ProductModel();
        $data['produto'] = $model->get_product_data($item_id);

        // Verifique se o ID foi passado
        if (!isset($_GET['id'])) {
            $_SESSION['erro'] = "Erro no Id passado!";
            $this->index();
            return;
        }


        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('produto_edit', $data);
        $this->view('shared/html_footer');
    }

    public function produto_edit_submit($id)
    {

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->index();
            return;
        }


        // Verifica se foi feita uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // Inicializa o array de erros de validação
        $validation_errors = [];

        //valida todos os campos tendo que preenchelos.
        $campos = ['nome', 'desc', 'fab', 'garant', 'valor', 'qntd', 'cod', 'plat'];
        foreach ($campos as $campo) {
            // Verifica se o campo está vazio
            if (empty($_POST['text_' . $campo])) {
                $validation_errors[] = ucfirst($campo) . ' é obrigatório.';
            }
        }

        // Validação do campo de meta
        if (empty($_POST['text_categoria'])) {
            $validation_errors[] = 'A categoria é obrigatória.';
        }


        // Se houver erros de validação, redireciona de volta ao formulário com os erros
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->produto_edit($id);
            return;
        }


        $model = new ProductModel();
        $model->edit_produto($_POST, $id);

        $this->produtos_table();
        return;
    }


    // =============== ESTATISTICAS CONTROLLER  ===========================

    public function estatisticas()
    {

        $data['user'] = $_SESSION['user'];
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];

        // $model = new UserModel();
        // $data['user_data'] = $model->get_user_data($id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('estatisticas', $data);
        $this->view('shared/html_footer');
    }



    // =============== CLIENTES CONTROLLERS ===========================

    public function clientes()
    {


        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];

        $model = new ClientModel();
        $data['clientes'] = $model->get_clientes();

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('clientes', $data);
        $this->view('shared/html_footer');
    }

    public function cadastro_cliente()
    {

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        // check if there are errors
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


        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('cadastro_cliente', $data);
        $this->view('shared/html_footer');
    }

    public function cadastro_cliente_submit()
    {

        if (!check_session()) {
            $this->index();
            return;
        }


        // Verifica se foi feita uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // form validation
        $validation_errors = [];

        // text_name
        if (empty($_POST['text_name'])) {
            $validation_errors[] = "Nome é de preenchimento obrigatório.";
        
        }

        if (empty($_POST['text_cpf'])) {
            $validation_errors[] = "CPF é de preenchimento obrigatório.";
        
        }
        
        if (empty($_POST['text_RG'])) {
            $validation_errors[] = "RG é de preenchimento obrigatório.";
        
        }

        // telefone
        if (empty($_POST['text_telefone'])) {
            $validation_errors[] = "Telefone é de preenchimento obrigatório.";
        }

        // endereço
        if (empty($_POST['text_endereco'])) {
            $validation_errors[] = "Endereco é de preenchimento obrigatório.";
        }        

        // email
        if (empty($_POST['text_email'])) {
            $validation_errors[] = "Email é de preenchimento obrigatório.";
        } else {
            if (!filter_var($_POST['text_email'], FILTER_VALIDATE_EMAIL)) {
                $validation_errors[] = "Email não é válido.";
            }
        }

        // check if there are validation errors to return to the form
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->cadastro_cliente();
            return;
        }

        $model = new ClientModel();
        $model->cadastrar_cliente($_POST);

        $this->clientes();
        return;

    }





}
