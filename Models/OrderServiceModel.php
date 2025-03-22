<?php

class OrderServiceModel extends Mysql
{
    private $id;
    private $client_id;
    private $created_at;
    private $quantity;
    private $idProduct;
    private $stock;
    private $total;

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $sql = "SELECT * FROM orders;";
        $request = $this->select_all($sql);
        return $request;
    }
    
    public function get(int $idOrder)
    {
        $this->id = $idOrder;
        $sql = "SELECT id,client_id,created_at FROM orders WHERE id = $this->id";
        $request = $this->select($sql);
        return $request;
    }


    public function save(int $client_id, string $created_at)
    {
        $this->client_id = $client_id;
        $this->created_at = $created_at;
        $return = 0;

            $query_insert  = "INSERT INTO orders(client_id,created_at)VALUES(?,?)";
            $arrData = array(
                $this->client_id,
                $this->created_at
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
      
        return $return;
    }

    public function saveDetail(int $idOrder, int $idProduct,int $quantity,int $total)
    {
        $this->quantity = $quantity;
        $this->id = $idOrder;
        $this->idProduct = $idProduct;
        $this->total = $total;
        $return = 0;
        $sql = "SELECT id FROM orders WHERE id = '{$this->id}'";
        $request = $this->select_all($sql);
        if (!empty($request)) {
            $query_insert  = "INSERT INTO orders_details(order_id,product_id,quantity,total)VALUES(?,?,?,?)";
            $arrData = array(
                $this->id,
                $this->idProduct,
                $this->quantity,
                $this->total
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } 
        return $return;
    }

    public function UpdateOrder(int $id, string $client_id, string $created_at)
    {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->created_at = $created_at;
        $return = 0;
        $sql = "SELECT id FROM orders WHERE id = '{$this->id}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE orders 
						SET client_id = ? WHERE id = $this->id ";
           $arrData = array(
                $this->client_id
            );

            $request = $this->update($sql, $arrData);
            $return = $request;
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function getProductById(int $idProducto){
        $this->idProduct = $idProducto;
        $sql = "SELECT * 
        FROM client_product cp 
        INNER JOIN products p ON cp.product_id = p.id
        WHERE cp.product_id = $this->idProduct";
        $request = $this->select($sql);
        return $request;
    }

    public function updateStock(int $idProduct, int $Stock){
        $this->idProduct = $idProduct;
        $this->stock = $Stock;
        $return = 0;
        $sql = "UPDATE products SET stock = ? WHERE id = $this->idProduct";
        $arrData = array(
                $this->stock
            );
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteOrder(int $idClient)
    {
        $this->id = $idClient;
        $sql = "DELETE orders WHERE id = $this->id ";
        $arrData = array([]);
        $request = $this->delete($sql, $arrData);
        return $request;
    }
}
