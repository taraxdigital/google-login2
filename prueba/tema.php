<?php

require_once 'database.php';


class Tema{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll(){
        $result = $this->db->query("SELECT id, titulo, artista, id_spotify, preview_url, tempo, id_carpeta FROM tema;");
        return $result->fetch_all(MYSQLI_ASSOC);    
    }

   
    public function create($titulo, $artista, $id_spotify, $preview_url, $tempo, $id_carpeta){
       

       

        //lanzamos la consulta
        $this->db->query("INSERT INTO tema (titulo, artista, id_spotify, preview_url, tempo, id_carpeta) VALUES(?, ?, ?, ?, ?, ?)", [$titulo, $artista, $id_spotify, $preview_url, $tempo,$id_carpeta]);

        return $this->db->query("SELECT LAST_INSERT_ID() as id")->fetch_assoc()['id'];
    }


    public function delete($id){
      
        $this->db->query("DELETE FROM tema WHERE id = ?", [$id]);
        return $this->db->query("SELECT ROW_COUNT() as affected")->fetch_assoc()['affected'];
    }
}
