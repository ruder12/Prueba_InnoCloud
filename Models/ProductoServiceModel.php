<?php

class ProductoServiceModel extends Mysql
{
    private $id;
    private $name;
    private $stock;
    private $idClient;
    private $price;

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $sql = "SELECT * FROM products;";
        $request = $this->select_all($sql);
        return $request;
    }

    public function allByClients(int $IdClient)
    {
        $this->idClient = $IdClient;
        $sql = "SELECT p.id,p.name,p.stock,p.price FROM client_product cp  
        INNER JOIN  products p 
        ON cp.product_id  = p.id 
        WHERE cp.client_id =  $this->idClient;";
        $request = $this->select_all($sql);
        return $request;
    }
    
    public function get(int $idproducto)
    {
        $this->id = $idproducto;
        $sql = "SELECT id,name,stock,price FROM products WHERE id = $this->id";
        $request = $this->select($sql);
        return $request;
    }


    public function save(string $name, int $stock, int $price)
    {
        $this->name = $name;
        $this->stock = $stock;
        $this->price = $price;
            $query_insert  = "INSERT INTO products(name,stock,price)VALUES(?,?,?)";
            $arrData = array(
                $this->name,
                $this->stock,
                $this->price
            );
            $request_insert = $this->insert($query_insert, $arrData);
    
        return $request_insert;
    }

    public function UpdateProd(int $id, string $name, int $stock, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->stock = $stock;
        $this->price = $price;
        $return = 0;
        $sql = "SELECT id FROM products WHERE id = '{$this->id}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE products 
						SET name = ?,stock=? WHERE id = $this->id ";
           $arrData = array(
                $this->name,
                $this->stock,
                $this->price
            );

            $request = $this->update($sql, $arrData);
            $return = $request;
        } else {
            $return = "exist";
        }
        return $return;
    }


    public function deleteProd(int $idproducto)
    {
        $this->id = $idproducto;
        $sql = "DELETE products WHERE id = $this->id ";
        $arrData = array(0);
        $request = $this->delete($sql, $arrData);
        return $request;
    }
}
