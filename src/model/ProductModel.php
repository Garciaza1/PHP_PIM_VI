<?php

namespace PIM_VI\Models;

use PIM_VI\System\Database;

use PDO;
use Throwable;

class ProductModel extends Database
{


    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    public function cadastrar_produto($post_data)
    {

        //declaração das variaveis

        $nome = $post_data["text_nome"];
        $desc = $post_data["text_desc"];
        $fab = $post_data["text_fab"];
        $garant = $post_data["text_garant"];
        $valor = $post_data["text_valor"];
        $qntd = $post_data["text_qntd"];
        $cod = $post_data["text_cod"];
        $platafoma = $post_data["text_plat"];
        $categoria = $post_data["text_categoria"];

        // conversão de array para string
        if(count($platafoma) > 0 ){
            $plat = implode(" | ", $platafoma);
        }

        $stmt = $this->conn->prepare("INSERT INTO produtos (nome, descricao, cod, fabricante, categoria, quantidade, valor, plataforma, garantia, created_at) VALUES (:nome, :descricao, :cod, :fabricante, :categoria, :quantidade, :valor, :plataforma, :garantia, NOW())");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $desc);
        $stmt->bindParam(':cod', $cod);
        $stmt->bindParam(':fabricante', $fab);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':quantidade', $qntd);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':plataforma', $plat);
        $stmt->bindParam(':garantia', $garant);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }

    public function get_produtos()
    {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE deleted_at is null AND quantidade > 0");

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

    public function soft_delete($id)
    {

        $stmt = $this->conn->prepare("UPDATE produtos SET deleted_at = NOW() WHERE id = :id");
        $stmt->bindParam(':id', $id);

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

    // pega os dados not null deletados
    public function get_product_deleted()
    {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE DeletedAt is not null");

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function get_product_data($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = :id and deleted_at is null");
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }


    public function edit_produto($post_data, $id)
    {

        // Declaração das variáveis
        $nome = $post_data["text_nome"];
        $desc = $post_data["text_desc"];
        $fab = $post_data["text_fab"];
        $garant = $post_data["text_garant"];
        $valor = $post_data["text_valor"];
        $qntd = $post_data["text_qntd"];
        $cod = $post_data["text_cod"];
        $platafoma = $post_data["text_plat"];
        $categoria = $post_data["text_categoria"];

        if(count($platafoma) > 0 ){
            $plat = implode(" | ", $platafoma);
        }

        $stmt = $this->conn->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, cod = :cod, fabricante = :fabricante, categoria = :categoria, quantidade = :quantidade, valor = :valor, plataforma = :plataforma, garantia = :garantia, updated_at = NOW() WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $desc);
        $stmt->bindParam(':cod', $cod);
        $stmt->bindParam(':fabricante', $fab);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':quantidade', $qntd);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':plataforma', $plat);
        $stmt->bindParam(':garantia', $garant);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }
    
    public function produto_qntd_edit($id){

        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = :id and deleted_at is null");
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $qntd = $data['quantidade'];
        $nova_qntd = $qntd - 1;
        
        $stmt = $this->conn->prepare("UPDATE produtos SET quantidade = :nova_qntd, updated_at = NOW() WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nova_qntd', $nova_qntd);
        
        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

    }
}
