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

    public function venda($post, $client_id, $product_id, $user_id){
        
        
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
}