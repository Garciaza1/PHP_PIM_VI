<?php

namespace PIM_VI\Models;

use PIM_VI\System\Database;
use PIM_VI\Models\ClientModel;
use PIM_VI\Models\ProductModel;

use PDO;
use Throwable;

class VendaModel extends Database
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function venda($post, $client_id, $product_id, $user_id)
    {


        $modelClient = new ClientModel;
        $cliente = $modelClient->get_cliente($client_id);

        $modelProduct = new ProductModel;
        $product = $modelProduct->get_product_data($product_id);
        // printData($product);

        $CPF = $cliente['CPF'];

        $cod_prod = $product['cod'];
        $valor = $product['valor'];
        $categoria = $product['categoria'];
        $quantidade = $product['quantidade'];

        $endereco = $post["text_endereco"];
        $num_residencia = $post["text_num_residencia"];
        $CEP = $post["text_CEP"];
        $mtd_pay = $post["text_mtd_pay"];

        $sts_pay = "Confirmado";
        $sts_sell = "Confirmado";


        $stmt = $this->conn->prepare("INSERT INTO venda (id_vendedor, id_produto, id_cliente, endereco, num_residencia, CEP, mtd_pay, categoria, quantidade, valor, sts_pay, sts_sell, cod_prod,CPF ,created_at) VALUES (:user_id, :product_id, :client_id, :endereco, :num_residencia, :CEP, :mtd_pay, :categoria, :quantidade, :valor, :sts_pay, :sts_sell, :cod_prod, :CPF, NOW())");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':num_residencia', $num_residencia);
        $stmt->bindParam(':CEP', $CEP);
        $stmt->bindParam(':mtd_pay', $mtd_pay);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':CPF', $CPF);
        $stmt->bindParam(':cod_prod', $cod_prod);
        $stmt->bindParam(':sts_pay', $sts_pay);
        $stmt->bindParam(':sts_sell', $sts_sell);


        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }

    public function get_vendas()
    {

        $stmt = $this->conn->prepare("SELECT * FROM venda");

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

    public function get_venda($id)
    {

        $stmt = $this->conn->prepare("SELECT * FROM venda WHERE id = :id");
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

    public function edit_venda($post_data, $id)
    {
        // Declaração das variáveis
        $cod_prod = $post_data["text_cod_prod"];
        $valor = $post_data["text_valor"];
        $id_produto = $post_data["text_id_produto"];
        $id_vendedor = $post_data["text_id_vendedor"];
        $id_cliente = $post_data["text_id_cliente"];
        $CPF = $post_data["text_CPF"];
        $categoria = $post_data["text_categoria"];
        $quantidade = $post_data["text_quantidade"];
        $sts_pay = $post_data["text_sts_pay"];
        $sts_sell = $post_data["text_sts_sell"];
        $mtd_pay = $post_data["text_mtd_pay"];
        $CEP = $post_data["text_CEP"];
        $endereco = $post_data["text_endereco"];
        $num_residencia = $post_data["text_num_residencia"];

        $stmt = $this->conn->prepare("UPDATE venda SET cod_prod = :cod_prod, id_produto = :id_produto, id_vendedor = :id_vendedor, id_cliente = :id_cliente, categoria = :categoria, quantidade = :quantidade, valor = :valor, CPF = :CPF, sts_pay = :sts_pay, sts_sell = :sts_sell, mtd_pay = :mtd_pay, CEP = :CEP, endereco = :endereco, num_residencia = :num_residencia, updated_at = NOW() WHERE id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':cod_prod', $cod_prod);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->bindParam(':id_vendedor', $id_vendedor);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':CPF', $CPF);
        $stmt->bindParam(':sts_pay', $sts_pay);
        $stmt->bindParam(':sts_sell', $sts_sell);
        $stmt->bindParam(':mtd_pay', $mtd_pay);
        $stmt->bindParam(':CEP', $CEP);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':num_residencia', $num_residencia);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }


    public function cancelar_venda($id)
    {

        $stmt = $this->conn->prepare("UPDATE venda SET  sts_pay = 'Cancelado', sts_sell = 'Cancelado', updated_at = NOW() WHERE id = :id");
        $stmt->bindParam(':id', $id);

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
