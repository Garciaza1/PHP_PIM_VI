<?php

namespace PIM_VI\Models;

use PIM_VI\System\Database;

use PDO;
use Throwable;

class ClientModel extends Database
{


    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    public function cadastrar_cliente($post_data)
    {

        // Declaração das variáveis
        $nome = $post_data["text_name"];
        $email = $post_data["text_email"]; // Corrigido para "text_email"
        $CPF = $post_data["text_cpf"]; // Corrigido para "text_CPF"
        $RG = $post_data["text_RG"]; // Corrigido para "text_RG"
        $endereco = $post_data["text_endereco"]; // Corrigido para "text_endereco"
        $telefone = $post_data["text_telefone"]; // Corrigido para "text_telefone"

        $stmt = $this->conn->prepare("INSERT INTO clientes (nome, email, CPF, RG, endereco, telefone, created_at) VALUES (:nome, :email, :CPF, :RG, :endereco, :telefone, NOW())");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':CPF', $CPF);
        $stmt->bindParam(':RG', $RG);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':telefone', $telefone);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }

    public function get_clientes()
    {
        $stmt = $this->conn->prepare("SELECT * FROM clientes");

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }

    public function get_cliente($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }

    // public function soft_delete($id)
    // {

    //     $stmt = $this->conn->prepare("UPDATE produtos SET deleted_at = NOW() WHERE id = :id");
    //     $stmt->bindParam(':id', $id);

    //     try {
    //         $stmt->execute();
    //     } catch (Throwable $e) {
    //         echo '<pre>';
    //         print_r($stmt);
    //         echo '<br>';
    //         print_r($e);
    //     }

    //     $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     return $resultado;
    // }

    // // pega os dados not null deletados
    // public function get_product_deleted()
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE DeletedAt is not null");

    //     try {
    //         $stmt->execute();
    //     } catch (Throwable $e) {
    //         echo '<pre>';
    //         print_r($stmt);
    //         echo '<br>';
    //         print_r($e);
    //     }

    //     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     return $data;
    // }

    // public function get_product_data($id)
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = :id and deleted_at is null");
    //     $stmt->bindParam(':id', $id);

    //     try {
    //         $stmt->execute();
    //     } catch (Throwable $e) {
    //         echo '<pre>';
    //         print_r($stmt);
    //         echo '<br>';
    //         print_r($e);
    //     }

    //     $data = $stmt->fetch(PDO::FETCH_ASSOC);

    //     return $data;
    // }


    // public function edit_client($post_data, $id)
    // {

    //     // Declaração das variáveis
    //     $nome = $post_data["text_nome"];
    //     $desc = $post_data["text_desc"];
    //     $fab = $post_data["text_fab"];
    //     $garant = $post_data["text_garant"];
    //     $valor = $post_data["text_valor"];
    //     $qntd = $post_data["text_qntd"];
    //     $cod = $post_data["text_cod"];
    //     $plat = $post_data["text_plat"];
    //     $categoria = $post_data["text_categoria"];

    //     $stmt = $this->conn->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, cod = :cod, fabricante = :fabricante, categoria = :categoria, quantidade = :quantidade, valor = :valor, plataforma = :plataforma, garantia = :garantia, updated_at = NOW() WHERE id = :id");
    //     $stmt->bindParam(':id', $id);
    //     $stmt->bindParam(':nome', $nome);
    //     $stmt->bindParam(':descricao', $desc);
    //     $stmt->bindParam(':cod', $cod);
    //     $stmt->bindParam(':fabricante', $fab);
    //     $stmt->bindParam(':categoria', $categoria);
    //     $stmt->bindParam(':quantidade', $qntd);
    //     $stmt->bindParam(':valor', $valor);
    //     $stmt->bindParam(':plataforma', $plat);
    //     $stmt->bindParam(':garantia', $garant);

    //     try {
    //         $stmt->execute();
    //     } catch (Throwable $e) {
    //         echo '<pre>';
    //         print_r($stmt);
    //         echo '<br>';
    //         print_r($e);
    //     }
    // }


}
