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
        $email = $post_data["text_email"]; 
        $CPF = $post_data["text_cpf"]; 
        $RG = $post_data["text_RG"]; 
        $endereco = $post_data["text_endereco"]; 
        $telefone = $post_data["text_telefone"]; 

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

}
