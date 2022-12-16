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

    public function selectSession($champ='id', $order='ASC' ){
        // La requête sql ne fonctionne pas pour la table condition s'il n'y a pas l'échappé
        $sql = "SELECT `session`.id, `session`.date, `session`.addresseIP, `session`.idUser, `pageVisited`.url, `pageVisited`.idSession FROM `$this->table` INNER JOIN `pageVisited` ON `session`.id = `pageVisited`.idSession ORDER BY $champ $order"; 
        $stmt  = $this->query($sql);
        // retourne tout ce qui correspond à la table
        return  $stmt->fetchAll();
    }

    public function updateSession($data){
        // traiter les données non obligatoires qui posent problème si elle ne sont pas saisie dans la requête
        foreach($data as $key => $value){
            if(isset($data[$key]) && ($value=="" || $value=="-1")){
                unset($data[$key]);
            }
        }

        // print_r($data);
        // die();
        $champRequete = null;
        $data_keys = array_fill_keys($this->fillable, '');
        $data_map = array_intersect_key($data, $data_keys);
        foreach($data_map as $key=>$value){
            $champRequete .= "$key = :$key, ";
        }
        $champRequete = rtrim($champRequete, ", ");

        $sql = "UPDATE $this->table SET $champRequete WHERE $this->primaryKey = :$this->primaryKey";

        $stmt = $this->prepare($sql);
        foreach($data_map as $key=>$value){
            $stmt->bindValue(":$key", $value);
        } 
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }else{
            // header("location: ../../user/create");
            return true;
        }
    }

}

?>