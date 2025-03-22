<?php

class ClienteServiceModel extends Mysql
{
    private $id;
    private $name;
    private $email;

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $sql = "SELECT * FROM clients;";
        $request = $this->select_all($sql);
        return $request;
    }
    
    public function get(int $idproducto)
    {
        $this->id = $idproducto;
        $sql = "SELECT id,name,email FROM clients WHERE id = $this->id";
        $request = $this->select($sql);
        return $request;
    }


    public function save(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
        $return = 0;
        $sql = "SELECT id FROM clients WHERE id = '{$this->id}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert  = "INSERT INTO clients(name,email)VALUES(?,?)";
            $arrData = array(
                $this->name,
                $this->email
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function UpdateClient(int $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $return = 0;
        $sql = "SELECT id FROM clients WHERE id = '{$this->id}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE clients 
						SET name = ?,email=? WHERE id = $this->id ";
           $arrData = array(
                $this->name,
                $this->email
            );

            $request = $this->update($sql, $arrData);
            $return = $request;
        } else {
            $return = "exist";
        }
        return $return;
    }


    public function deleteClient(int $idcliente)
    {
        $this->id = $idcliente;
        $sql = "DELETE clients WHERE id = $this->id ";
        $arrData = array(0);
        $request = $this->delete($sql, $arrData);
        return $request;
    }
}
