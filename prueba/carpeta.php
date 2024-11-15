<?php

require_once 'database.php';


class Carpeta{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll(){
        $result = $this->db->query("SELECT id, name, fecha FROM carpeta  WHERE id> 5;");
        return $result->fetch_all(MYSQLI_ASSOC);    
    }

   
    public function create($name, $fecha){
       

       

        //lanzamos la consulta
        $this->db->query("INSERT INTO carpeta (name, fecha) VALUES(?, ?)", [$name, $fecha]);

        return $this->db->query("SELECT LAST_INSERT_ID() as id")->fetch_assoc()['id'];
    }


    public function delete($id){
      
        $this->db->query("DELETE FROM carpeta WHERE id = ?", [$id]);
        return $this->db->query("SELECT ROW_COUNT() as affected")->fetch_assoc()['affected'];
    }
}
