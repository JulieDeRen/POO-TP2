<?php

abstract class Crud extends PDO {

    public function __construct(){
        // webdev : 
        // parent::__construct('mysql:host=localhost; dbname=e2295160; port=3306; charset=utf8', 'e2295160', 'J5CXwPUvSABTdMlcGf97');
        // local
        parent::__construct('mysql:host=localhost; dbname=eTimbre; port=8889; charset=utf8', 'root', 'root');
    }

    public function select($champ='id', $order='ASC' ){
        // La requête sql ne fonctionne pas pour la table condition s'il n'y a pas l'échappé
        $sql = "SELECT * FROM `$this->table` ORDER BY $champ $order"; 
        $stmt  = $this->query($sql);
        // retourne tout ce qui correspond à la table
        return  $stmt->fetchAll();
    }

    public function selectId($value){
        $sql ="SELECT * FROM `$this->table` WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        // si le id correspond à une donnée saisie alors retourner tout ce qui correspond à cette id sinon, générer message d'erreur
        if($count == 1 ){
            return $stmt->fetchAll(); // Modification ici fonction fetchAll()**
        }else{
            header("location: ../../home/error");
        }
    }

    public function insert($data){
        // print_r($_SESSION['id']); not an array so I could treat one value session at the time and add condition is_array($data) or pass an array as a parameter
        // die();
        //print_r($data);
        //die();

        // traiter les données non obligatoires qui posent problème (date, birthday, country) si elle ne sont pas saisie dans la requête
        foreach($data as $key => $value){
            if(isset($data[$key]) && ($value=="" || $value=="-1")){
                unset($data[$key]);
            }
        }
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
            print_r($stmt->errorInfo());
        }else{
            // print_r($this->lastInsertId());
            // die();
            return $this->lastInsertId(); // no id
        }
       
    }
    
    public function update($data){
        // traiter les données non obligatoires qui posent problème si elle ne sont pas saisie dans la requête
        foreach($data as $key => $value){
            if(isset($data[$key]) && ($value=="" || $value=="-1")){
                unset($data[$key]);
            }
        }
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
           // header('Location: ' . $_SERVER['HTTP_REFERER']);
           return true;
        }
    }

    public function delete($id){

        $sql = "DELETE FROM `$this->table` WHERE $this->primaryKey = :$this->primaryKey";

        
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $id);
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }else{
            return true; 
        }
    }
}


?>