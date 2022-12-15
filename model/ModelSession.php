<?php

require_once "Crud.php";

class ModelSession extends Crud {

    public $table = 'session';
    public $primaryKey = 'id';
    public $fillable = ['id', 'date', 'addresseIP', 'idUser'];

    public function insertSession($data){
        // print_r($data);
        // die();

        $data_keys = array_fill_keys($this->fillable, '');
        $data_map = array_intersect_key($data, $data_keys);
        $nomChamp = implode(", ",array_keys($data_map));
        $valeurChamp = ":".implode(", :", array_keys($data_map));
        $sql = "INSERT INTO `$this->table` ($nomChamp) VALUES ($valeurChamp)";
        $stmt = $this->prepare($sql);
        foreach($data_map as $key=>$value){
            $stmt->bindValue(":$key", $value);
        } 
        if(!$stmt->execute()){
            print_r("erreur insert");
            print_r($stmt->errorInfo());
        }else{
            // print_r($this->lastInsertId());
            // die();
            return $this->lastInsertId(); // no id
        }
       
    }

}

?>