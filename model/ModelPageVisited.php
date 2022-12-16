<?php

class ModelPageVisited extends Crud {
    // *** IMPORTANT bons noms de variables ***
    protected $table = 'pageVisited';
    protected $primaryKey = 'idPageVisited';
    protected $foreignKey = 'idSession';

    protected $fillable = ['idPageVisited', 'url', 'idSession'];

    public function insertSessionPage($data){
        // print_r($data);
        // die();
            $data_keys = array_fill_keys($this->fillable, '');
            $data_map = array_intersect_key($data, $data_keys);
            $nomChamp = implode(", ",array_keys($data_map));
            $valeurChamp = ":".implode(", :", array_keys($data_map));
            $sql = "INSERT INTO `$this->table` ($nomChamp) VALUES ($valeurChamp)";
            $stmt = $this->prepare($sql);
            foreach($data_map as $keyB=>$valueB){
                $stmt->bindValue(":$keyB", $valueB);
            } 
            if(!$stmt->execute()){
                print_r("erreur insert pageVisited");
                print_r($stmt->errorInfo());
            }else{
                return $this->lastInsertId(); // no id
            }
        }
    
    }


?>